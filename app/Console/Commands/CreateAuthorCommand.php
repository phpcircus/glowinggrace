<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Wink\WinkAuthor;

class CreateAuthorCommand extends Command
{
    /** @var string */
    protected $name = 'create:author';

    /** @var string */
    protected $description = 'Create an author account using the given options or the defaults from configuration.';

    /** @var \Wink\WinkAuthor */
    protected $authors;

    /**
     * Create a new command instance.
     *
     * @param  \Wink\WinkAuthor  $authors
     */
    public function __construct(WinkAuthor $authors)
    {
        $this->authors = $authors;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('creating author account...');

        $data = [
            'id' => (string) Str::uuid(),
            'name' => $this->option('name'),
            'slug' => Str::slug($this->option('name')),
            'bio' => 'This is me.',
            'email' => $this->option('email'),
            'password' => bcrypt($this->option('password')),
        ];

        $author = $this->authors->create($data);

        $this->comment("Author account for {$author->name} successfully created.");
    }

    /**
     * Get the options for the command.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['name', null, InputOption::VALUE_OPTIONAL, 'The name of the user.', config('auth.admin.name')],
            ['email', null, InputOption::VALUE_OPTIONAL, 'The email of the user.', config('auth.admin.email')],
            ['password', null, InputOption::VALUE_OPTIONAL, 'The password for the user.', config('auth.admin.password')],
        ];
    }
}
