@extends('layouts.app')

@section('title', __('assistant.widget.title'))

@section('content')
@include('components.breadcrumbs', ['breadcrumbs' => [
    ['label' => __('app.home'), 'url' => route('home.index')],
    ['label' => __('assistant.widget.title'), 'url' => '#'],
]])

@include('layouts._success_alert')

<div class="row">
    <div class="col-12">
        <section class="beauty-assistant-widget mb-5" data-beauty-assistant>
            <div class="beauty-assistant-widget__shell">
                <div class="beauty-assistant-widget__header">
                    <div>
                        <p class="beauty-assistant-widget__eyebrow mb-1">{{ __('assistant.widget.eyebrow') }}</p>
                        <h3 class="beauty-assistant-widget__title mb-2">{{ __('assistant.widget.title') }}</h3>
                        <p class="beauty-assistant-widget__subtitle mb-0">
                            {{ __('assistant.widget.subtitle') }}
                        </p>
                    </div>
                    <div class="beauty-assistant-widget__badge">{{ __('assistant.widget.badge') }}</div>
                </div>
                @auth
                    <div
                        class="beauty-assistant-widget__panel"
                        data-beauty-assistant-product-label="{{ __('assistant.js.product_label') }}"
                        data-beauty-assistant-you-label="{{ __('assistant.js.you') }}"
                        data-beauty-assistant-assistant-label="{{ __('assistant.js.assistant') }}"
                        data-beauty-assistant-sending-label="{{ __('assistant.js.sending') }}"
                        data-beauty-assistant-submit-label="{{ __('assistant.js.submit') }}"
                        data-beauty-assistant-clear-confirm="{{ __('assistant.widget.clear_chat_confirm') }}"
                        data-beauty-assistant-fallback-error="{{ __('assistant.js.fallback_error') }}"
                    >
                        <div class="beauty-assistant-widget__messages" data-beauty-assistant-messages>
                            @if (empty($messages))
                                <div class="beauty-assistant-widget__empty" data-beauty-assistant-empty>
                                    {{ __('assistant.widget.empty_example') }}
                                </div>
                            @else
                                @foreach ($messages as $message)
                                    @php
                                        $role = $message['role'] ?? 'assistant';
                                        $products = array_slice($message['products'] ?? [], 0, 2);
                                    @endphp

                                    <article class="beauty-assistant-widget__message beauty-assistant-widget__message--{{ $role }}">
                                        <div class="beauty-assistant-widget__bubble">
                                            <div class="beauty-assistant-widget__role">
                                                {{ $role === 'user' ? __('assistant.js.you') : __('assistant.js.assistant') }}
                                            </div>
                                            <div class="beauty-assistant-widget__content">{!! nl2br(e($message['content'] ?? '')) !!}</div>

                                            @if (! empty($products))
                                                <div class="beauty-assistant-widget__products">
                                                    @foreach ($products as $product)
                                                        @php
                                                            $productName = $product['name'] ?? __('assistant.js.product_label');
                                                            $productCategory = $product['category'] ?? '';
                                                        @endphp

                                                        <div class="beauty-assistant-widget__product-card">
                                                            <div class="beauty-assistant-widget__product-card-body">
                                                                <span class="beauty-assistant-widget__product-card-label">{{ __('assistant.js.product_label') }}</span>
                                                                <span class="beauty-assistant-widget__product-card-name">{{ $productName }}</span>
                                                                @if ($productCategory !== '')
                                                                    <span class="beauty-assistant-widget__product-card-meta">{{ $productCategory }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            @endif
                        </div>

                        <form class="beauty-assistant-widget__form" data-beauty-assistant-form>
                            @csrf
                            <input type="hidden" value="{{ route('api.beauty-assistant.chat') }}" data-beauty-assistant-chat-url>

                            <label class="visually-hidden" for="beauty-assistant-message">{{ __('assistant.widget.question_label') }}</label>
                            <textarea
                                id="beauty-assistant-message"
                                class="beauty-assistant-widget__input"
                                rows="3"
                                placeholder="{{ __('assistant.widget.placeholder') }}"
                                data-beauty-assistant-input
                            ></textarea>

                            <div class="beauty-assistant-widget__actions">
                                <p class="beauty-assistant-widget__hint mb-0">
                                    {{ __('assistant.widget.hint') }}
                                </p>
                                <button type="submit" class="beauty-assistant-widget__button" data-beauty-assistant-submit>
                                    {{ __('assistant.widget.submit') }}
                                </button>
                            </div>
                        </form>

                        <form action="{{ route('assistant.chat.destroy') }}" method="POST" class="d-flex justify-content-end mt-3" data-beauty-assistant-clear-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill btn-sm px-3">
                                {{ __('assistant.widget.clear_chat') }}
                            </button>
                        </form>
                    </div>
                @else
                    <div class="beauty-assistant-widget__guest">
                        <p class="mb-2">{{ __('assistant.guest.prompt') }}</p>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('login') }}" class="btn btn-lila">{{ __('assistant.guest.login') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light">{{ __('assistant.guest.register') }}</a>
                        </div>
                    </div>
                @endauth
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/beauty-assistant.js') }}" defer></script>
@endpush
