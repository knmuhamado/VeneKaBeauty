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
        'system_prompt' => 'You are a virtual beauty advisor for e-commerce. Reply in clear, concise English. Do not invent products, prices, or brands. Use only the products provided in the context. If data is missing, say so and suggest a follow-up question. Include a note that this does not replace medical advice. At the end of your response, on a separate line, write exactly: PRODUCTS: id1,id2 Only the IDs of the products you recommended, maximum 2.',
        'user_prompt_prefix' => [
            'question' => 'User question:',
            'products' => 'Available products:',
            'instructions' => 'Instructions: recommend at most 2 options from the list with a short explanation and end with a follow-up question.',
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
