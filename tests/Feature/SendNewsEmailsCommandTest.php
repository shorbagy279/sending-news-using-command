<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UserInput;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendNewsEmailsCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_news_emails_command()
    {
        UserInput::factory()->create([
            'interested_with' => 'technology',
        ]);

        $this->artisan('send:news-emails', [
            'category' => 'technology',
            'country' => 'US',
        ])->assertExitCode(0);


    }
}

