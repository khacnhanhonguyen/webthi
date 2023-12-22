<link rel="stylesheet" href="/loginThem/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@if ($errors->any())
<div class="alert alert-warning">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session('Thongbao'))
    <div class="alert alert-success">
        {{session('Thongbao')}}
    </div>
@endif
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="{{ route('route.login.create.process') }}" method="POST">
            @csrf
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fa fa-github-alt"></i></a>
				<a href="#" class="social"><i class="fa fa-google-plus"></i></a>
				<a href="#" class="social"><i class="fa fa-twitter"></i></a>
			</div>
			<span>or use your email for registration</span>
			<input type="text" placeholder="Name" name="cname" />
			<input type="email" placeholder="Email" name="cemail" />
			<input type="password" placeholder="Password" name="cpassword" />
			<button type="submit">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('route.login.process') }}" method="POST">
            @csrf
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fa fa-github-alt"></i></a>
				<a href="#" class="social"><i class="fa fa-google-plus"></i></i></a>
				<a href="#" class="social"><i class="fa fa-twitter"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button type="submit" >Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>hi!</h1>
				<p>Để vào hãy </p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Xin chào!</h1>
				<p>Nếu bạn chưa có tài khoản hãy</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="/loginThem/login.js"></script>
