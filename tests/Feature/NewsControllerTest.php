<?php

namespace Tests\Feature;

use App\Mail\SendingNews;
use App\Models\UserInput;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_top_news_sends_emails_and_renders_view()
    {
        // Mock Mail
        Mail::fake();

        // Create a mock UserInput
        $user = UserInput::factory()->create([
            'email' => 'testuser@example.com',
            'interested_with' => 'general',
        ]);

        // Mock API Response
        Http::fake([
            'https://newsapi.org/v2/top-headlines*' => Http::response([
                'articles' => [
                    [
                        'title' => 'Test Title',
                        'author' => 'Test Author',
                        'description' => 'Test Description',
                        'urlToImage' => 'https://example.com/image.jpg',
                        'publishedAt' => now()->toIso8601String(),
                        'url' => 'https://example.com/article',
                    ],
                ],
            ], 200),
        ]);

        // Send a GET request to the endpoint
        $response = $this->get('/top-headlines?country=us&category=general');

        // Assert Response
        $response->assertStatus(200);
        $response->assertViewIs('news');
        $response->assertViewHas('articles');

        // Assert Mail Sent
        Mail::assertSent(SendingNews::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
