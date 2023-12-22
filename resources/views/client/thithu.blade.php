<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Your Page Title</title>
</head>
<body>

    <header class="bg-dark text-white text-center py-4">
        <h1> THI THỬ</h1>
        <!-- Add any header content you need -->
    </header>

    <main class="container mt-4">
        <h2>Đề Thi: {{ $deThi->tieu_de }}</h2>
        <!-- Your main content goes here -->
        <form method="post" action="{{ route('route.thithu.nop') }}">
            @csrf
            @foreach ($questions as $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text">Câu {{ $loop->iteration }}: {{ $question->noi_dung }}</p>
                        {{-- Display answer options --}}
                        <div class="form-check">
                            @foreach ($question->cauTraLois as $answer)
                                <input type="radio" class="form-check-input" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" id="answer{{ $answer->id }}">
                                <label class="form-check-label" for="answer{{ $answer->id }}">
                                    {{ $answer->noi_dung }}
                                </label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2023 Your Website. All rights reserved.</p>
        <!-- Add any footer content you need -->
    </footer>

    <!-- Include Bootstrap JS and jQuery (required for Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
