@extends("layouts.auth")
@section("content")
<h4 class="text-muted text-center m-t-0"><b>Create new account</b></h4>

<form method="POST" action="{{ route('register') }}" class="form-horizontal m-t-20">@csrf
	<div class="form-group">
		<div class="col-12">
			<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
		</div>
	</div>
	<div class="form-group">
		<div class="col-12">
			<input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email Address">
			@error('email')
				<span class="invalid-feedback d-block" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>
	<div class="form-group">
		<div class="col-12">
			<select class="form-control @error('gender') is-invalid @enderror" name="gender">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender') == "Male" ? 'selected' : '' }} >Male</option>
                <option value="Female" {{ old('gender') == "Female" ? 'selected' : '' }} >Female</option>
            </select>
            @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
		</div>
	</div>
	<div class="form-group">
		<div class="col-12">
		  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Enter a password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
		</div>
	</div>
	<div class="form-group">
		<div class="col-12">
			<input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Re type password">
		</div>
	</div>
	<div class="form-group text-center m-t-40">
		<div class="col-12">
			<button type="submit" class="btn btn-primary btn-block btn-lg waves-effect waves-light"> 
				{{ __('Register') }} 
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
			<a href="{{ route('login') }}" class="text-muted">Login Now</a>
		</div>
	</div>
</form>
@endsection