<?php

namespace App\Console\Commands;

use App\Mail\SendingNews;
use App\Models\UserInput;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SendNewsEmails extends Command
{
    protected $signature = 'send:news-emails {category} {country}';
    protected $description = 'fatch data and send emails';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $category = $this->argument('category');
        $country = $this->argument('country');

        $apiKey = '56b43eddec6c46a6850a8439ba85efee';
        $response = Http::get("https://newsapi.org/v2/top-headlines", [
            'apiKey' => $apiKey,
            'country' => $country,
            'category' => $category,
            'pageSize' => 10,
        ]);


        $data = $response->json();
        $articles = collect($data['articles'])->map(function ($article) {
            return [
                'title' => $article['title'],
                'author' => $article['author'],
                'description' => $article['description'],
                'image' => $article['urlToImage'],
                'publishedDate' => $article['publishedAt'],
                'url' => $article['url'],
            ];
        })->toArray();

        $users = UserInput::where('interested_with', $category)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->queue(new SendingNews($articles));
        }

    }
}
