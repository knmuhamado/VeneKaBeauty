const widgets = document.querySelectorAll('[data-beauty-assistant]');

widgets.forEach((widget) => {
    const messagesEl = widget.querySelector('[data-beauty-assistant-messages]');
    const emptyEl = widget.querySelector('[data-beauty-assistant-empty]');
    const form = widget.querySelector('[data-beauty-assistant-form]');
    const input = widget.querySelector('[data-beauty-assistant-input]');
    const submitButton = widget.querySelector('[data-beauty-assistant-submit]');
    const chatUrl = widget.querySelector('[data-beauty-assistant-chat-url]')?.value;
    const historyUrl = widget.querySelector('[data-beauty-assistant-history-url]')?.value;
    const productLabel = widget.querySelector('[data-beauty-assistant-product-label]')?.dataset.beautyAssistantProductLabel ?? 'Producto';
    const youLabel = widget.querySelector('[data-beauty-assistant-you-label]')?.dataset.beautyAssistantYouLabel ?? 'Tú';
    const assistantLabel = widget.querySelector('[data-beauty-assistant-assistant-label]')?.dataset.beautyAssistantAssistantLabel ?? 'Asistente';
    const sendingLabel = widget.querySelector('[data-beauty-assistant-sending-label]')?.dataset.beautyAssistantSendingLabel ?? 'Enviando...';
    const submitLabel = widget.querySelector('[data-beauty-assistant-submit-label]')?.dataset.beautyAssistantSubmitLabel ?? 'Enviar pregunta';
    const sendErrorLabel = widget.querySelector('[data-beauty-assistant-send-error]')?.dataset.beautyAssistantSendError ?? 'No se pudo enviar el mensaje';
    const fallbackErrorLabel = widget.querySelector('[data-beauty-assistant-fallback-error]')?.dataset.beautyAssistantFallbackError ?? 'Ahora mismo no pude procesar tu pregunta. Intenta de nuevo en unos segundos.';

    if (!form || !input || !submitButton || !chatUrl || !historyUrl) {
        return;
    }

    const labels = getLabels(widget);
    const csrfToken = form.querySelector('input[name="_token"]')?.value ?? '';

    function getLabels(container) {
        const getLabel = (selector, fallback) => container.querySelector(selector)?.dataset[selectorToDatasetKey(selector)] ?? fallback;

        return {
            product: getLabel('[data-beauty-assistant-product-label]', 'Producto'),
            you: getLabel('[data-beauty-assistant-you-label]', 'Tú'),
            assistant: getLabel('[data-beauty-assistant-assistant-label]', 'Asistente'),
            sending: getLabel('[data-beauty-assistant-sending-label]', 'Enviando...'),
            submit: getLabel('[data-beauty-assistant-submit-label]', 'Enviar pregunta'),
            sendError: getLabel('[data-beauty-assistant-send-error]', 'No se pudo enviar el mensaje'),
            fallbackError: getLabel('[data-beauty-assistant-fallback-error]', 'Ahora mismo no pude procesar tu pregunta. Intenta de nuevo en unos segundos.'),
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
            .map((product) => `<span class="beauty-assistant-widget__product">${escapeHtml(product.name ?? labels.product)}</span>`)
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

    const loadHistory = async () => {
        const response = await fetch(historyUrl, {
            headers: {
                Accept: 'application/json',
            },
            credentials: 'same-origin',
        });

        if (!response.ok) {
            return;
        }

        const payload = await response.json();
        const messages = readMessages(payload);

        if (messages.length === 0) {
            return;
        }

        if (emptyEl) {
            emptyEl.remove();
        }

        replaceMessages(messages);

        scrollToBottom();
    };

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
                throw new Error(labels.sendError);
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
    loadHistory().catch(() => {});
});
