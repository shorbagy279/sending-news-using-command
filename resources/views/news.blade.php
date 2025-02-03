
 <title>Top News</title>
<div>
    @foreach ($articles as $article)
        <h2>
            {{ $article['title'] }}
        </h2>

        <p>
            <h5>
            {{ $article['author'] }}
            </h5>
        <br>
        </br>
            {{ $article['publishedDate'] }} <br>
        </br>
            {{ $article['description'] }} <br>
        </p>

        <img src="{{ $article['image'] }}">
    @endforeach
</div>
