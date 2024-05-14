@extends('authentication.layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="h-100">
  <div class="col-lg-5 col-12">
    <div id="auth-left">
      <h1 class="auth-title">Pinjamkeun</h1>
      <p class="auth-subtitle mb-5">
        Masuk untuk melanjutkan.
      </p>
      {{-- @include('utilities.alert') --}}
      <form action="{{ route('dashboard') }}">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
          <input type="email" name="email" class="form-control form-control-xl" placeholder="Email"
            {{-- value="{{ old('email') }}"  --}}
            autofocus required />
          <div class="form-control-icon">
            <i class="bi bi-person"></i>
          </div>
          {{-- @error('email', 'authentication')
          <div class="d-block invalid-feedback">
            {{ $message }}
          </div>
          @enderror --}}
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
          <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required />
          <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
          {{-- @error('password', 'authentication')
          <div class="d-block invalid-feedback">
            {{ $message }}
          </div>
          @enderror --}}
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
          Masuk
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
