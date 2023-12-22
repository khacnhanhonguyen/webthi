<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add your styles and scripts as needed -->
</head>
<body>
    <div id="app">
        <div>
            <h2>Email Verification</h2>

            <div>
                @if (session('resent'))
                    <div>
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p>
                    {{ __('Trước khi tiếp tục, vui lòng kiểm tra email của bạn để lấy liên kết xác minh.') }}
                    {{ __('Nếu bạn không nhận được email.') }},
                </p>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit">{{ __('bấm vào đây để yêu cầu khác') }}</button>.
                </form>
            </div>
        </div>
    </div>

    <!-- Add your scripts as needed -->
</body>
</html>
