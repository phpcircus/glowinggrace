<?php

use App\Http\Actions;
use Illuminate\Support\Facades\Route;
use Wink\Http\Middleware\Authenticate as Wink;

// Home
Route::redirect('/', '/posts')->name('home');

// About
// Route::get('about', Actions\About\Index::class)->name('about');

// Authentication and Registration
// Auth - Login
Route::group(['middleware' => ['guest'], 'as' => 'login.', 'prefix' => 'login'], function ($router) {
    $router->get('/', Actions\Auth\Login\ShowForm::class)->name('form');
    $router->post('/', Actions\Auth\Login\ProcessLogin::class)->name('attempt');
});
Route::post('/logout', Actions\Auth\Logout\ProcessLogout::class)->middleware(['auth:wink'])->name('logout');

// Password Reset
Route::group(['middleware' => ['guest'], 'as' => 'password.', 'prefix' => 'password'], function ($router) {
    $router->get('/reset', Actions\Auth\PasswordResetRequest\ShowForm::class)->name('request.form');
    $router->post('/email', Actions\Auth\PasswordResetRequest\SendEmail::class)->name('request.email');
    $router->get('/reset/{token}', Actions\Auth\PasswordReset\ShowForm::class)->name('reset');
    $router->post('/reset', Actions\Auth\PasswordReset\UpdatePassword::class)->name('update');
});

// Users
// Route::group(['middleware' => ['auth'], 'as' => 'users.', 'prefix' => 'users'], function ($router) {
//     $router->get('/', Actions\User\ListUsers::class)->middleware(['can:listUsers'])->name('list');
//     $router->get('/create', Actions\User\CreateUser::class)->middleware(['can:administerUsers'])->name('create');
//     $router->post('/', Actions\User\StoreUser::class)->middleware(['can:administerUsers'])->name('store');
//     $router->delete('/{user}', Actions\User\DeleteUser::class)->middleware(['can:administerUsers'])->name('destroy');
//     $router->get('/{user}/edit', Actions\User\EditUser::class)->middleware(['can:updateUser,user'])->name('edit');
//     $router->put('/{user}', Actions\User\UpdateUser::class)->middleware(['can:updateUser,user'])->name('update');
//     $router->put('/{user}/restore', Actions\User\RestoreUser::class)->middleware(['can:administerUsers'])->name('restore');
// });

// Admin
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function ($router) {
    $router->group(['as' => 'posts.', 'prefix' => 'posts', 'middleware' => [Wink::class]], function ($router) {
        $router->get('/', Actions\Admin\Post\Index::class)->name('index');
        $router->get('/new', Actions\Admin\Post\Edit::class)->name('create');
        $router->get('/{post}/edit', Actions\Admin\Post\Edit::class)->name('edit');
    });
    $router->group(['as' => 'news.', 'prefix' => 'news', 'middleware' => [Wink::class]], function ($router) {
        $router->get('/new', Actions\Admin\News\Create::class)->name('create');
        $router->post('/', Actions\Admin\News\Store::class)->name('store');
    });
    $router->group(['as' => 'tshirts.', 'prefix' => 'tshirts', 'middleware' => [Wink::class]], function ($router) {
        $router->get('/', Actions\Admin\Tshirt\Index::class)->name('index');
        $router->get('/{purchase}', Actions\Admin\Tshirt\Show::class)->name('show');
        $router->post('/{purchase}', Actions\Admin\Tshirt\Update::class)->name('update');
        $router->get('/orders/pdf', Actions\Admin\Tshirt\Pdf\OrdersPdf::class)->name('orders.pdf');
    });
});

// Admin Api
Route::group(['as' => 'api.', 'prefix' => 'api/admin', 'middleware' => [Wink::class]], function ($router) {
    Route::group(['as' => 'posts.', 'prefix' => 'posts'], function ($router) {
        $router->post('/', Actions\Admin\Post\Api\Store::class)->name('store');
    });
});

// Blog
Route::group(['as' => 'posts.', 'prefix' => 'posts'], function ($router) {
    $router->get('/', Actions\Post\Index::class)->name('home');
    $router->get('/{post}', Actions\Post\Show::class)->name('show');
});

// News
Route::group(['as' => 'news.', 'prefix' => 'news'], function ($router) {
    $router->get('/{news}', Actions\News\Show::class)->name('show');
});

// TShirts
Route::group(['as' => 'tshirt.', 'prefix' => 'tshirt'], function ($router) {
    $router->get('/', Actions\Tshirt\Create::class)->name('create');
    $router->post('/purchase', Actions\Tshirt\Purchase::class)->middleware('money')->name('purchase');
});
