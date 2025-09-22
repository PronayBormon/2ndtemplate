@extends('errors.app')

@section('title', '404 - Not Found')

@section('content')
    <div class="d-flex align-items-center justify-content-center error-container">
        <div class="text-center">
            <img src="{{asset('frontend/images/logo.png')}}" style="height: 60px;" alt="" class="img-fluid">
            <h1 class="error-code">404</h1>
            <h2 class="mb-3">Oops! Page Not Found</h2>
            <p class="text-muted mb-4">
                The page you’re looking for doesn’t exist or may have been moved.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ url('/') }}" class="btn btn-primary btn-custom">Go Home</a>
                <a href="javascript:history.back()" class="btn btn-outline-secondary btn-custom">Go Back</a>
            </div>
            <div class="mt-5">
                <img src="https://illustrations.popsy.co/gray/lost.svg" alt="Lost Illustration" class="img-fluid"
                    style="max-width: 300px;">
            </div>
        </div>
    </div>
@endsection
