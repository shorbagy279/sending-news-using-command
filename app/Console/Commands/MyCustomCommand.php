<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserInput;

class MyCustomCommand extends Command
{
    protected $signature = 'custom:command';

    protected $description = 'A custom command to interact with the database';

    public function handle()
    {
        $users = UserInput::all();

        foreach ($users as $user) {
            $this->line('UserName: ' . $user->name);
            $this->line('Email: '.$user->email);
            $this->line('interested with: '.$user->interested_with);
            $this->line('Country: '.$user->country);
            $this->newLine();

        }
    }
}
