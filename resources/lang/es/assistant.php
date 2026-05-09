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
        'you' => 'Tú',
        'assistant' => 'Asistente',
        'sending' => 'Enviando...',
        'submit' => 'Enviar pregunta',
        'send_error' => 'No se pudo enviar el mensaje',
        'fallback_error' => 'Ahora mismo no pude procesar tu pregunta. Intenta de nuevo en unos segundos.',
    ],
    'backend' => [
        'system_prompt' => 'Eres un asesor virtual de belleza para e-commerce. Responde en español claro y breve. No inventes productos, precios ni marcas. Usa solo los productos proporcionados en el contexto. Si faltan datos, dilo y sugiere una siguiente pregunta. Incluye advertencia de no reemplazar asesoría médica.',
        'user_prompt_prefix' => [
            'question' => 'Pregunta del usuario:',
            'products' => 'Productos disponibles:',
            'instructions' => 'Instrucciones: recomienda máximo 2 opciones del listado con explicación corta y termina con una pregunta de seguimiento.',
        ],
        'fallback' => [
            'context' => [
                'face' => 'Si tu consulta es sobre rostro o piel, puedo orientarte con una recomendación más precisa.',
                'hair' => 'Si tu consulta es sobre cabello, puedo ayudarte a elegir un cuidado más adecuado.',
                'nails' => 'Si tu consulta es sobre uñas o cutículas, puedo orientarte con opciones más concretas.',
                'fragrance' => 'Si tu consulta es sobre fragancias, puedo ayudarte a elegir una opción más acertada.',
                'body' => 'Si tu consulta es sobre cuerpo o masaje, puedo ayudarte a elegir una alternativa adecuada.',
                'general' => 'Puedo ayudarte con una recomendación más precisa.',
            ],
            'with_products' => 'Te sugiero revisar :names según lo que me cuentas. Si quieres, te ayudo a elegir una rutina de uso diaria y nocturna.',
            'without_products' => 'No encontré productos relevantes por ahora. Si quieres, dime tu tipo de piel y objetivo para recomendarte mejor.',
        ],
    ],
];
