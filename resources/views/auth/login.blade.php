@extends('layouts.login')

@section('content')
<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
          @csrf
					<span class="login100-form-title p-b-49">
						<img src="{{ asset('/dist/img/inventory-icon.png') }}" style=" width: 80px; height: 80px;">
						<span style=" color: #c51ae2; font-size: 40px;font-family: Poppins-Regular; ">e - INVENTORY</span><br/>
						<small style=" font-size: 25px; font-family: Poppins-Regular; color: #c51ae2; line-height: 1.5; ">PT. Sinergi AITIKOM</small>
					</span>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email is required">
						<span class="label-input100" style=" color: #c51ae2;">Username</span>
						<input class="input100" type="text" name="email" placeholder="Type your email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100" style=" color: #c51ae2;">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="p-t-8 p-b-31">
						<span class="label-input100" style=" color: #c51ae2;"><input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
				</form>
			</div>
@endsection
