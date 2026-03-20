{{-- David Alejandro Gutiérrez Leal --}}
<h2>{{ $title }}</h2>

<form method="POST" action="{{ $action }}" @if(!empty($enctype)) enctype="{{ $enctype }}" @endif>
    @csrf

    @if(!empty($method) && $method !== 'POST')
        @method($method)
    @endif

    @include($formView)

    @include('layouts._form_actions', [
        'submitText' => $submitText,
        'backRoute' => $backRoute,
        'backText' => $backText,
    ])
</form>