<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Individual;
use App\Models\User;
use Illuminate\Console\Command;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make:admin {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = bcrypt($this->secret('Enter password'));

        $props = compact('name', 'email', 'password');

        \DB::transaction(function () use ($props) {
            $user = User::create($props);
            Individual::create(['user_id' => $user->id]);
            Admin::create($props);
        });

        $this->info('your account is successfully created.');
    }
}
