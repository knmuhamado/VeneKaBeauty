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
        'fallback_error' => 'Ahora mismo no pude procesar tu pregunta. Intenta de nuevo en unos segundos.',
    ],
    'backend' => [
        'system_prompt' => 'Eres un asesor virtual de belleza para e-commerce. Responde en español claro y breve. No inventes productos, precios ni marcas. Usa solo los productos proporcionados en el contexto. Si faltan datos, dilo y sugiere una siguiente pregunta. Incluye advertencia de no reemplazar asesoría médica. Al final de tu respuesta, en una línea separada, escribe exactamente: PRODUCTOS: id1,id2 Solo los IDs de los productos que recomendaste, máximo 2.',
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
