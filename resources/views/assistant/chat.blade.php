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
                data-beauty-assistant-product-url-template="{{ route('product.show', ['id' => '__PRODUCT_ID__']) }}"
                data-beauty-assistant-you-label="{{ __('assistant.js.you') }}"
                data-beauty-assistant-assistant-label="{{ __('assistant.js.assistant') }}"
                data-beauty-assistant-sending-label="{{ __('assistant.js.sending') }}"
                data-beauty-assistant-submit-label="{{ __('assistant.js.submit') }}"
                data-beauty-assistant-send-error="{{ __('assistant.js.send_error') }}"
                data-beauty-assistant-fallback-error="{{ __('assistant.js.fallback_error') }}"
            >
                <div class="beauty-assistant-widget__messages" data-beauty-assistant-messages>
                    <div class="beauty-assistant-widget__empty" data-beauty-assistant-empty>
                        {{ __('assistant.widget.empty_example') }}
                    </div>
                </div>

                <form class="beauty-assistant-widget__form" data-beauty-assistant-form>
                    @csrf
                    <input type="hidden" value="{{ route('api.beauty-assistant.chat') }}" data-beauty-assistant-chat-url>
                    <input type="hidden" value="{{ route('api.beauty-assistant.history') }}" data-beauty-assistant-history-url>

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
