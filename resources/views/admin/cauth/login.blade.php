@extends("layouts.auth")
@section("content")
<h4 class="text-muted text-center m-t-0"><b>Sign In</b></h4>

<form method="POST" action="{{ route('login') }}" class="form-horizontal m-t-20">@csrf
	<div class="form-group">
		<div class="col-12">
			<input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">
			@error('email')
				<span class="invalid-feedback d-block" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>
	<div class="form-group">
		<div class="col-12">
			<input class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" type="password">
			@error('password')
				<span class="invalid-feedback d-block" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>
	<div class="form-group">
		<div class="col-12">
			<div class="checkbox checkbox-primary">
				<input id="checkbox-signup" type="checkbox">
				<label for="checkbox-signup">
					Remember me
				</label>
			</div>
		</div>
	</div>
	<div class="form-group text-center m-t-40">
		<div class="col-12">
			<button type="submit" class="btn btn-primary btn-block btn-lg waves-effect waves-light"> 
				{{ __('Login') }} 
			</button>
		</div>
	</div>
	<div class="form-group row m-t-30 m-b-0">
		<div class="col-sm-7">
			@if(Route::has('password.request'))
			<a class="btn btn-link text-muted" href="{{ route('password.request') }}">
				{{ __('Forgot Your Password?') }}
			</a>
			@endif
		</div>
		<div class="col-sm-5 text-right">
			<a href="{{ route('register') }}" class="text-muted">Create an account</a>
		</div>
	</div>
</form>
@endsection