<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>webthi</title>
</head>

<body>

    <header class="bg-dark text-white text-center py-4">
        <h1> CHÍNH THỨC</h1>
        <!-- Add any header content you need -->
    </header>

    <main class="container mt-4">
        <h2>Đề Thi: {{ $deThi->tieu_de }}</h2>
        <div id="countdown" class="text-center mb-4"></div>
        <!-- Your main content goes here -->
        <form method="post" action="{{ route('route.thithuc.nop') }}">
            @csrf
            @foreach ($questions as $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text">Câu {{ $loop->iteration }}: {{ $question->noi_dung }}</p>
                        {{-- Display answer options --}}
                        <div class="form-check">
                            @foreach ($question->cauTraLois as $answer)
                                <input type="radio" class="form-check-input" name="answers[{{ $question->id }}]"
                                    value="{{ $answer->id }}" id="answer{{ $answer->id }}">
                                <label class="form-check-label" for="answer{{ $answer->id }}">
                                    {{ $answer->noi_dung }}
                                </label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <input type="hidden" name="start_time" value="{{ $start_time }}">
            <input type="hidden" name="de_thi_id" value="{{ $deThi->id }}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
    <!-- Bootstrap Modal for Time's Up -->
    {{-- <div class="modal fade" id="timesUpModal" tabindex="-1" role="dialog" aria-labelledby="timesUpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="timesUpModalLabel">Hết thời gian!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn đã hết thời gian làm bài. Bài thi sẽ tự động được nộp.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div> --}}

    <!-- Include Bootstrap JS and jQuery (required for Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Your existing scripts -->
    <!-- Your existing scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Countdown timer script -->
    <script>
        var countdownTime = {{ $deThi->thoi_gian_lam_bai }}; // Thời gian làm bài từ cơ sở dữ liệu

        function updateCountdown() {
            var minutes = Math.floor(countdownTime / 60);
            var seconds = countdownTime % 60;

            document.getElementById('countdown').innerHTML = 'Thời gian còn lại: ' + minutes + ' phút ' + seconds + ' giây';

            countdownTime--;

            if (countdownTime < 0) {
                $('#timesUpModal').modal('show');
                document.getElementById('quizForm').submit(); // Tự động nộp bài
                clearInterval(countdownInterval);
            }
        }

        var countdownInterval = setInterval(updateCountdown, 1000);

        // Show modal when clicking the submit button
        // $('#submitBtn').on('click', function () {
        //     $('#timesUpModal').modal('show');
        //     document.getElementById('quizForm').submit(); // Tự động nộp bài
        // });
    </script>




</body>

</html>
