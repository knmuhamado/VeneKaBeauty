{{-- Mariamny Del Valle Ramírez Telles --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <x-auth.card title="{{ __('user.register') }}">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <x-auth.input label="{{ __('user.name') }}" name="name" type="text" />
                    <x-auth.input label="{{ __('user.email') }}" name="email" type="email" />
                    <x-auth.input label="{{ __('user.password') }}" name="password" type="password" />
                    <x-auth.input label="{{ __('user.confirm_password') }}" name="password_confirmation" type="password" />
                    <x-auth.input label="{{ __('user.address') }}" name="address" type="text" />
                    <x-auth.input label="{{ __('user.phone') }}" name="phoneNumber" type="text" />

                    <div class="mt-3">
                        <x-auth.button>{{ __('user.register_button') }}</x-auth.button>
                    </div>

                </form>

            </x-auth.card>

        </div>
    </div>
</div>
@endsection