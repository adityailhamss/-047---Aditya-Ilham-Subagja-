@extends('authentication.layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="card shadow" style="width: 600px; border-radius: 10px;">
      <div class="card-body">
        <h1 class="auth-title">Pinjamkeun</h1>
        <p class="auth-subtitle mb-5">
          Masuk untuk melanjutkan.
        </p>
        @include('utilities.alert')
          <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group position-relative has-icon-left mb-4">
                <input type="email" name="email" class="form-control form-control-xl" placeholder="Email"
                  value="{{ old('email') }}" autofocus required />
                <div class="form-control-icon">
                  <i class="bi bi-person"></i>
                </div>
                @error('email', 'authentication')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required />
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
                @error('password', 'authentication')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary btn-block">Log in</button>
          </form>
      </div>
  </div>
</div>
@endsection
