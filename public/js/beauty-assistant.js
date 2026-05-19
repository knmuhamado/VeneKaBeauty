const widgets = document.querySelectorAll('[data-beauty-assistant]');

widgets.forEach((widget) => {
    const messagesEl = widget.querySelector('[data-beauty-assistant-messages]');
    const emptyEl = widget.querySelector('[data-beauty-assistant-empty]');
    const form = widget.querySelector('[data-beauty-assistant-form]');
    const input = widget.querySelector('[data-beauty-assistant-input]');
    const submitButton = widget.querySelector('[data-beauty-assistant-submit]');
    const clearForm = widget.querySelector('[data-beauty-assistant-clear-form]');
    const chatUrl = widget.querySelector('[data-beauty-assistant-chat-url]')?.value;

    if (!form || !input || !submitButton || !chatUrl) {
        return;
    }

    const labels = getLabels(widget);
    const csrfToken = form.querySelector('input[name="_token"]')?.value ?? '';

    function getLabels(container) {
        const getLabel = (selector, fallback) => container.querySelector(selector)?.dataset[selectorToDatasetKey(selector)] ?? fallback;

        return {
            product: getLabel('[data-beauty-assistant-product-label]', 'Product'),
            you: getLabel('[data-beauty-assistant-you-label]', 'You'),
            assistant: getLabel('[data-beauty-assistant-assistant-label]', 'Assistant'),
            sending: getLabel('[data-beauty-assistant-sending-label]', 'Sending...'),
            submit: getLabel('[data-beauty-assistant-submit-label]', 'Send question'),
            fallbackError: getLabel('[data-beauty-assistant-fallback-error]', 'Something went wrong. Try again in a few seconds.'),
            clearConfirm: getLabel('[data-beauty-assistant-clear-confirm]', 'Are you sure you want to clear the assistant chat?'),
        };
    }

    function selectorToDatasetKey(selector) {
        const match = selector.match(/data-(.+)]/);

        if (! match) {
            return '';
        }

        return match[1].replace(/-([a-z])/g, (_, letter) => letter.toUpperCase());
    }

    const escapeHtml = (value) => String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

    const renderMessage = (message) => {
        const wrapper = document.createElement('article');
        wrapper.className = `beauty-assistant-widget__message beauty-assistant-widget__message--${message.role}`;

        const content = escapeHtml(message.content ?? '');
        const products = Array.isArray(message.products) ? message.products : [];

        const productsHtml = renderProducts(products);

        wrapper.innerHTML = `
            <div class="beauty-assistant-widget__bubble">
                <div class="beauty-assistant-widget__role">${message.role === 'user' ? labels.you : labels.assistant}</div>
                <div class="beauty-assistant-widget__content">${content.replaceAll('\n', '<br>')}</div>
                ${productsHtml}
            </div>
        `;

        return wrapper;
    };

    function renderProducts(products) {
        if (products.length === 0) {
            return '';
        }

        const itemsHtml = products
            .slice(0, 2)
            .map((product) => {
                const name = escapeHtml(product.name ?? labels.product);
                const category = escapeHtml(product.category ?? '');

                return `
                    <div class="beauty-assistant-widget__product-card">
                        <div class="beauty-assistant-widget__product-card-body">
                            <span class="beauty-assistant-widget__product-card-label">${labels.product}</span>
                            <span class="beauty-assistant-widget__product-card-name">${name}</span>
                            ${category !== '' ? `<span class="beauty-assistant-widget__product-card-meta">${category}</span>` : ''}
                        </div>
                    </div>
                `;
            })
            .join('');

        return `<div class="beauty-assistant-widget__products">${itemsHtml}</div>`;
    }

    const scrollToBottom = () => {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    };

    const setBusy = (isBusy) => {
        submitButton.disabled = isBusy;
        submitButton.textContent = isBusy ? labels.sending : labels.submit;
        input.disabled = isBusy;
    };

    const readMessages = (payload) => (Array.isArray(payload.messages) ? payload.messages : []);

    const replaceMessages = (messages) => {
        messagesEl.innerHTML = '';
        messages.forEach((message) => {
            messagesEl.appendChild(renderMessage(message));
        });
    };

    const showFallbackMessage = () => {
        replaceMessages([
            {
                role: 'assistant',
                content: labels.fallbackError,
                products: [],
            },
        ]);
    };

    if (clearForm) {
        clearForm.addEventListener('submit', (event) => {
            const confirmed = window.confirm(labels.clearConfirm);

            if (!confirmed) {
                event.preventDefault();
            }
        });
    }

    const submitMessage = async (event) => {
        event.preventDefault();

        const message = input.value.trim();
        if (!message) {
            return;
        }

        if (emptyEl) {
            emptyEl.remove();
        }

        setBusy(true);

        try {
            const response = await fetch(chatUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                credentials: 'same-origin',
                body: JSON.stringify({ message }),
            });

            if (!response.ok) {
                throw new Error('send_failed');
            }

            const payload = await response.json();
            replaceMessages(readMessages(payload));

            input.value = '';
            scrollToBottom();
        } catch (error) {
            showFallbackMessage();
            scrollToBottom();
        } finally {
            setBusy(false);
            input.focus();
        }
    };

    form.addEventListener('submit', submitMessage);
    scrollToBottom();
});
