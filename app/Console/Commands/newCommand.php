<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class newCommand extends Command
{
    protected $signature = 'example:email {name}';

    protected $description = 'sending email to user';

    public function handle()
    {
        $name = $this->argument('name');

        $sending = "email sent to {$name}!";

        $this->info($sending);
    }
}
