<?php

namespace Tests\Unit;

use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    public function test_get_top_news_validation()
    {
        // Mock the request
        $request = Request::create('/top-headlines', 'GET', [
            'country' => 'us',
            'category' => 'general',
        ]);

        $controller = new NewsController();

        $response = $controller->getTopNews($request);

        $this->assertNotNull($response);
    }
}
