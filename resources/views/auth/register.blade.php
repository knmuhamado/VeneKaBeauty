{{-- Mariamny Del Valle Ramírez Telles --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <x-auth.card title="Register">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <x-auth.input label="Name" name="name" type="text" />
                    <x-auth.input label="Email" name="email" type="email" />
                    <x-auth.input label="Password" name="password" type="password" />
                    <x-auth.input label="Confirm Password" name="password_confirmation" type="password" />
                    <x-auth.input label="Address" name="address" type="text" />
                    <x-auth.input label="Phone Number" name="phoneNumber" type="text" />

                    <div class="mt-3">
                        <x-auth.button>
                            Register
                        </x-auth.button>
                    </div>

                </form>

            </x-auth.card>

        </div>
    </div>
</div>
@endsection