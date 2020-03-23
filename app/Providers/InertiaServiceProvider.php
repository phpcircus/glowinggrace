<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Wink\Wink;
use Wink\WinkAuthor;
use Wink\WinkTag;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->shareWithInertia();
    }

    /**
     * Configure and share data with Inertia.
     */
    protected function shareWithInertia()
    {
        $this->shareVersion();
        $this->shareAuthenticatedUser();
        $this->shareWinkAuthor();
        $this->shareAppData();
        $this->shareFlashMessages();
        $this->shareNews();
        $this->shareErrors();
    }

    /**
     * Share asset version.
     */
    private function shareVersion(): void
    {
        Inertia::version(static function () {
            return md5_file(public_path('mix-manifest.json'));
        });
    }

    /**
     * Share the authenticated user.
     */
    private function shareAuthenticatedUser(): void
    {
        Inertia::share([
            'auth' => function () {
                $user = Auth::user();

                return [
                    'user' => $user ? [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'is_admin' => $user->is_admin,
                        'deleted_at' => $user->deleted_at,
                    ] : null,
                ];
            },
        ]);
    }

    /**
     * Share the Wink author.
     */
    private function shareWinkAuthor(): void
    {
        Inertia::share([
            'wink' => function () {
                $author = auth('wink')->user();

                return [
                    'author' => $author ? [
                        'id' => $author->id,
                        'name' => $author->name,
                        'email' => $author->email,
                        'bio' => $author->bio,
                        'avatar' => $author->avatar,
                    ] : null,
                    'supplementals' => Wink::scriptVariables() ?? (object) [],
                    'tags' => WinkTag::all() ?? (object) [],
                    'authors' => WinkAuthor::all() ?? (object) [],
                ];
            },
        ]);
    }

    /**
     * Share app data.
     */
    private function shareAppData(): void
    {
        Inertia::share([
            'app' => static function () {
                return [
                    'name' => Config::get('app.name'),
                    'sizes' => Size::available()->get(),
                ];
            },
        ]);
    }

    private function shareFlashMessages(): void
    {
        Inertia::share([
            'success' => static function () {
                $success = Session::get('flash_message')['success'] ?? null;

                return [
                    'message' => $success ? $success['message'] : null,
                    'class' => $success ? $success['class'] : null,
                ];
            },
            'warning' => static function () {
                $warning = Session::get('flash_message')['warning'] ?? null;

                return [
                    'message' => $warning ? $warning['message'] : null,
                    'class' => $warning ? $warning['class'] : null,
                ];
            },
            'wink_success' => static function () {
                $winkSuccess = Session::get('flash_message')['wink_success'] ?? null;

                return [
                    'message' => $winkSuccess ? $winkSuccess['message'] : null,
                    'class' => $winkSuccess ? $winkSuccess['class'] : null,
                ];
            },
            'wink_warning' => static function () {
                $winkWarning = Session::get('flash_message')['wink_warning'] ?? null;

                return [
                    'message' => $winkWarning ? $winkWarning['message'] : null,
                    'class' => $winkWarning ? $winkWarning['class'] : null,
                ];
            },
            'info' => static function () {
                $info = Session::get('flash_message')['info'] ?? null;

                return [
                    'message' => $info ? $info['message'] : null,
                    'class' => $info ? $info['class'] : null,
                ];
            },
        ]);
    }

    /**
     * Share news.
     */
    private function shareNews(): void
    {
        Inertia::share([
            'news' => function () {
                if ($news = News::latest()->limit(5)->get()) {
                    return $news;
                }

                return (object) [];
            },
        ]);
    }

    /**
     * Share errors.
     */
    private function shareErrors(): void
    {
        Inertia::share([
            'errors' => function () {
                if ($errors = Session::get('errors')) {
                    $bags = $errors->getBags();

                    return collect($bags)->map(function ($bag, $key) {
                        return $bag->getMessages();
                    });
                }

                return (object) [];
            },
        ]);
    }
}
