{{-- Mariamny Del Valle Ramírez Telles --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <x-auth.card title="Login">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <x-auth.input 
                        label="Email Address" 
                        name="email" 
                        type="email" 
                    />

                    <x-auth.input 
                        label="Password" 
                        name="password" 
                        type="password" 
                    />

                    <div class="mb-3">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label for="remember">Remember Me</label>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <x-auth.button>
                            Login
                        </x-auth.button>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        @endif
                    </div>

                </form>

            </x-auth.card>

        </div>
    </div>
</div>
@endsection
