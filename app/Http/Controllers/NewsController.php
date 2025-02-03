<?php

namespace App\Http\Controllers;

use App\Mail\SendingNews;
use App\Models\UserInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    public function getTopNews(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string',
            'category' => 'required|string',
        ]);

        $country = $validated['country'];
        $category = $validated['category'];

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
            Mail::to($user->email)->send(new SendingNews($articles));
        }

        return view('news', ['articles' => $articles]);
    }
}
