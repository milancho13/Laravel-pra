@extends('layouts.layout')

@section('content')
<div class="loginPage">
  <div class="container">
    <div class="loginPage_contents">
      <h1 class="h3 loginPage_contents_title">let's start</h1>
      <div class="btn loginPage_contents_btn">
        <a class="text-white" href="{{ route('login') }}">Login/Register</a>
      </div>
      <div class="col-md-8 offset-md-4" style="margin-top:50px;margin-left:186px;">
        <a class="btn btn-secondary" style="width:180px;" href="google/login/redirect" role="button">
          <i class="fab fa-google"></i>
          Sign in with Google</a><br>

        <a class="btn btn-secondary" style="width:180px;margin-top:20px;background-color:cornflowerblue;border-color:cornflowerblue"
          href="auth/facebook" role="button">
          <i class="fab fa-facebook-f"></i>
          Sign in with FB</a><br>

        <a class="btn btn-secondary" style="width:180px;margin-top:20px;background-color:deepskyblue;border-color:deepskyblue"
          href="facebook" role="button">
          <i class="fab fa-twitter"></i>
          Sign in with Twitter</a>

      </div>
    </div>
  </div>
</div>
</div>
@endsection