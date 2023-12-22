<h1>{{ $deThi->tieu_de }}</h1>

<form method="post" action="{{ url('/practice-test/submit') }}">
    @csrf
    @foreach ($questions as $question)
        <p>Câu {{ $loop->iteration }}{{ $question->noi_dung }}</p>
        {{-- Display answer options --}}
        @foreach ($question->cauTraLois as $answer)
            <label>
                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                {{ $answer->noi_dung }}
            </label><br>
        @endforeach
        <hr>
    @endforeach
    <button type="submit">Submit</button>
</form>
