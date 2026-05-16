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
        'product_cta' => 'View product',
        'you' => 'You',
        'assistant' => 'Assistant',
        'sending' => 'Sending...',
        'submit' => 'Send question',
        'send_error' => 'The message could not be sent',
        'fallback_error' => 'I could not process your question right now. Try again in a few seconds.',
        'price_locale' => 'en-US',
        'price_currency' => 'COP',
    ],
    'backend' => [
        'system_prompt' => 'You are a virtual beauty advisor for e-commerce. Reply in clear, concise English. Do not invent products, prices, or brands. Use only the products provided in the context. If data is missing, say so and suggest a follow-up question. Include a note that this does not replace medical advice.',
        'user_prompt_prefix' => [
            'question' => 'User question:',
            'products' => 'Available products:',
            'instructions' => 'Instructions: recommend at most 2 options from the list with a short explanation and end with a follow-up question.',
        ],
        'fallback' => [
            'context_general' => 'I can help with a more precise recommendation when you share a category or goal.',
            'context_for_categories' => 'Based on your message we are focusing on: :categories.',
            'names_join_separator' => ' and ',
            'with_products' => 'I suggest reviewing :names based on what you told me. If you want, I can help you choose a daily and nightly routine.',
            'without_products' => 'I could not find relevant products right now. If you want, share a category or goal so I can recommend better options.',
        ],
        'prompt_line' => [
            'type' => 'Type',
            'brand' => 'Brand',
            'price' => 'Price',
            'category' => 'Category',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'na' => 'N/A',
        ],
    ],
];
