<?php

return [
    'widget' => [
        'eyebrow' => 'Virtual assistant',
        'title' => 'Beauty guided by your catalog',
        'subtitle' => 'Ask about routines, products, or services and get recommendations based on your store.',
        'badge' => 'AI + real catalog',
        'empty_example' => 'Type something like: "I have oily skin with acne" or "What routine do you recommend for dry skin?".',
        'question_label' => 'Your question',
        'placeholder' => 'Describe your skin, goal, or question...',
        'hint' => 'Only the messages in your conversation are saved while you use your account.',
        'submit' => 'Send question',
    ],
    'guest' => [
        'prompt' => 'Sign in to save your history and receive personalized recommendations.',
        'login' => 'Sign in',
        'register' => 'Create account',
    ],
    'js' => [
        'product_label' => 'Product',
        'you' => 'You',
        'assistant' => 'Assistant',
        'sending' => 'Sending...',
        'submit' => 'Send question',
        'send_error' => 'The message could not be sent',
        'fallback_error' => 'I could not process your question right now. Try again in a few seconds.',
    ],
    'backend' => [
        'system_prompt' => 'You are a virtual beauty advisor for e-commerce. Reply in clear, concise English. Do not invent products, prices, or brands. Use only the products provided in the context. If data is missing, say so and suggest a follow-up question. Include a note that this does not replace medical advice.',
        'user_prompt_prefix' => [
            'question' => 'User question:',
            'products' => 'Available products:',
            'instructions' => 'Instructions: recommend at most 2 options from the list with a short explanation and end with a follow-up question.',
        ],
        'fallback' => [
            'context' => [
                'face' => 'If your question is about your face or skin, I can guide you with a more precise recommendation.',
                'hair' => 'If your question is about hair, I can help you choose more suitable care.',
                'nails' => 'If your question is about nails or cuticles, I can guide you with more specific options.',
                'fragrance' => 'If your question is about fragrances, I can help you choose a better option.',
                'body' => 'If your question is about body care or massage, I can help you choose a suitable alternative.',
                'general' => 'I can help you with a more precise recommendation.',
            ],
            'with_products' => 'I suggest reviewing :names based on what you told me. If you want, I can help you choose a daily and nightly routine.',
            'without_products' => 'I could not find relevant products right now. If you want, tell me your skin type and goal so I can recommend better options.',
        ],
    ],
];
