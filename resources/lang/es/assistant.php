<?php

return [
    'widget' => [
        'eyebrow' => 'Asistente virtual',
        'title' => 'Belleza guiada por tu catálogo',
        'subtitle' => 'Pregunta por rutinas, productos o servicios y recibe recomendaciones basadas en tu tienda.',
        'badge' => 'IA + catálogo real',
        'empty_example' => 'Escribe algo como: "Tengo piel grasa con acné" o "¿Qué rutina me recomiendas para piel seca?".',
        'question_label' => 'Tu pregunta',
        'placeholder' => 'Describe tu piel, objetivo o duda...',
        'hint' => 'Solo se guardan los mensajes de tu conversación mientras uses tu cuenta.',
        'submit' => 'Enviar pregunta',
        'clear_chat' => 'Borrar chat',
        'clear_chat_confirm' => '¿Seguro que quieres borrar todo el chat del asistente?',
        'chat_cleared' => 'Chat del asistente borrado correctamente.',
    ],
    'guest' => [
        'prompt' => 'Inicia sesión para guardar tu historial y recibir recomendaciones personalizadas.',
        'login' => 'Entrar',
        'register' => 'Crear cuenta',
    ],
    'controller' => [
        'chat_cleared' => 'Chat del asistente borrado correctamente.',
    ],
    'js' => [
        'product_label' => 'Producto',
        'you' => 'Tú',
        'assistant' => 'Asistente',
        'sending' => 'Enviando...',
        'submit' => 'Enviar pregunta',
        'fallback_error' => 'Ahora mismo no pude procesar tu pregunta. Intenta de nuevo en unos segundos.',
    ],
    'backend' => [
        'system_prompt' => 'Eres un asesor virtual de belleza para e-commerce. Responde en español claro, breve y en texto plano. No inventes productos, precios ni marcas. Usa solo los productos proporcionados en el contexto. Si faltan datos, dilo y sugiere una siguiente pregunta. Incluye una advertencia de que no reemplaza asesoría médica. No devuelvas JSON, listas estructuradas ni IDs de productos. Si recomiendas productos, menciónalos solo dentro del texto de la respuesta.',
        'user_prompt_prefix' => [
            'question' => 'Pregunta del usuario:',
            'products' => 'Productos disponibles:',
            'instructions' => 'Instrucciones: recomienda máximo 2 opciones del listado con explicación corta y termina con una pregunta de seguimiento.',
        ],
        'prompt_line' => [
            'type' => 'Tipo',
            'brand' => 'Marca',
            'price' => 'Precio',
            'category' => 'Categoría',
            'keywords' => 'Keywords',
            'description' => 'Descripción',
            'na' => 'N/A',
        ],
    ],
];
