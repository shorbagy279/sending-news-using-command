
    <title>User Input Form</title>
<body>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('userinput.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="interested_with">Interested With:</label>
            <input type="text" name="interested_with" id="interested_with">
        </div>
        <div>
            <label for="country">Country:</label>
            <input type="text" name="country" id="country">
        </div>
        <button type="submit">Submit</button>
    </form>
</body>

