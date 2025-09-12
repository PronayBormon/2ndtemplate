{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('auth.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4 mt-2">
                <a href="{{ url('/') }}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <img src="/frontend/images/logo.png" alt="" class="img-fluid">
                    </span>
                    <span class="app-brand-text demo text-body fw-bold ms-1">{{ config('app.name') }}</span>
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-1 pt-2 text-start">Forget Password </h4>
            <p class="mb-4 text-start">Forgot your password? No problem. Just let us know your email address and we will
                email you a password reset link that will allow you to choose a new one</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 " style="color: #08c892" :status="session('status')" />
            <form class="mb-3" method="POST" action="{{ route('password.email') }}" enctype="multipart/form-data">
                @csrf
                {{-- @method('put') --}}

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Enter your email" value="{{ old('email') }}" autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Email Password Reset Link</button>
                </div>
            </form>

        </div>
    </div>
@endsection
