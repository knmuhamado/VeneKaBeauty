{{-- Mariamny Del Valle Ramírez Telles --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <x-auth.card title="{{ __('user.login') }}">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                   <x-auth.input label="{{ __('user.email') }}" name="email" type="email" />

                   <x-auth.input label="{{ __('user.password') }}" name="password" type="password" />

                    <div class="mb-3">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label for="remember">{{ __('user.remember') }}</label>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <x-auth.button>{{ __('user.login_button') }}</x-auth.button>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('user.forgot_password') }}
                            </a>
                        @endif
                    </div>

                </form>

            </x-auth.card>

        </div>
    </div>
</div>
@endsection
