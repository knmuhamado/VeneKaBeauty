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
    ],
    'guest' => [
        'prompt' => 'Inicia sesión para guardar tu historial y recibir recomendaciones personalizadas.',
        'login' => 'Entrar',
        'register' => 'Crear cuenta',
    ],
    'js' => [
        'product_label' => 'Producto',
        'product_cta' => 'Ver producto',
        'you' => 'Tú',
        'assistant' => 'Asistente',
        'sending' => 'Enviando...',
        'submit' => 'Enviar pregunta',
        'send_error' => 'No se pudo enviar el mensaje',
        'fallback_error' => 'Ahora mismo no pude procesar tu pregunta. Intenta de nuevo en unos segundos.',
        'price_locale' => 'es-CO',
        'price_currency' => 'COP',
    ],
    'backend' => [
        'system_prompt' => 'Eres un asesor virtual de belleza para e-commerce. Responde en español claro y breve. No inventes productos, precios ni marcas. Usa solo los productos proporcionados en el contexto. Si faltan datos, dilo y sugiere una siguiente pregunta. Incluye advertencia de no reemplazar asesoría médica.',
        'user_prompt_prefix' => [
            'question' => 'Pregunta del usuario:',
            'products' => 'Productos disponibles:',
            'instructions' => 'Instrucciones: recomienda máximo 2 opciones del listado con explicación corta y termina con una pregunta de seguimiento.',
        ],
        'fallback' => [
            'context_general' => 'Puedo ayudarte con una recomendación más precisa cuando indiques categoría u objetivo.',
            'context_for_categories' => 'Según tu mensaje priorizamos el área: :categories.',
            'names_join_separator' => ' y ',
            'with_products' => 'Te sugiero revisar :names según lo que me cuentas. Si quieres, te ayudo a elegir una rutina de uso diaria y nocturna.',
            'without_products' => 'No encontré productos relevantes por ahora. Si quieres, indica categoría u objetivo para recomendarte mejor.',
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
