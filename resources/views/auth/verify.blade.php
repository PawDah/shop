@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form id="email-form" class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <a  style="text-decoration: underline;color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));cursor:pointer" onclick="event.preventDefault(); document.getElementById('email-form').submit();">{{ __('click here to request another') }}
                        </a>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
