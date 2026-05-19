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
        'clear_chat' => 'Clear chat',
        'clear_chat_confirm' => 'Are you sure you want to clear the assistant chat?',
        'chat_cleared' => 'Assistant chat cleared successfully.',
    ],
    'guest' => [
        'prompt' => 'Sign in to save your history and receive personalized recommendations.',
        'login' => 'Sign in',
        'register' => 'Create account',
    ],
    'controller' => [
        'chat_cleared' => 'Assistant chat cleared successfully.',
    ],
    'js' => [
        'product_label' => 'Product',

        'you' => 'You',
        'assistant' => 'Assistant',
        'sending' => 'Sending...',
        'submit' => 'Send question',
        'fallback_error' => 'I could not process your question right now. Try again in a few seconds.',
    ],
    'backend' => [
        'system_prompt' => 'You are a virtual beauty advisor for e-commerce. Reply in clear, concise English and plain text. Do not invent products, prices, or brands. Use only the products provided in the context. If data is missing, say so and suggest a follow-up question. Include a note that this does not replace medical advice. Do not return JSON, structured lists, or product IDs. If you recommend products, mention them only in the response text.',
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
