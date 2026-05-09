<?php

namespace App\Utils;

use Illuminate\Support\Str;

class AssistantTextNormalizer
{
    public static function extractTerms(string $message): array
    {
        $normalized = self::normalize($message);
        $parts = preg_split('/[^\p{L}\p{N}]+/u', $normalized) ?: [];

        $stopwords = [
            'de', 'la', 'el', 'los', 'las', 'para', 'con', 'sin', 'una', 'uno', 'unos', 'unas',
            'que', 'quiero', 'necesito', 'recomiendas', 'recomendacion', 'recomendaciones', 'me',
            'mi', 'mis', 'por', 'favor', 'y', 'o', 'en', 'del', 'al', 'un', 'mucho', 'muy',
            'tengo', 'tiene', 'tener', 'estoy', 'esta', 'hay', 'algo', 'mas',
        ];

        $terms = [];
        foreach ($parts as $part) {
            if ($part === '' || mb_strlen($part) < 3 || in_array($part, $stopwords, true)) {
                continue;
            }

            $terms[] = self::canonicalizeTerm($part);
        }

        return array_values(array_unique($terms));
    }

    public static function normalize(string $text): string
    {
        return strtr(Str::ascii(mb_strtolower($text)), self::normalizationMap());
    }

    public static function detectTheme(string $message): string
    {
        $terms = self::extractTerms($message);

        if (array_intersect($terms, ['face', 'piel'])) {
            return 'face';
        }

        if (in_array('cabello', $terms, true) || in_array('shampoo', $terms, true) || in_array('tinte', $terms, true)) {
            return 'hair';
        }

        if (in_array('unas', $terms, true) || in_array('cuticula', $terms, true)) {
            return 'nails';
        }

        if (in_array('fragancia', $terms, true)) {
            return 'fragrance';
        }

        if (in_array('cuerpo', $terms, true) || in_array('masaje', $terms, true)) {
            return 'body';
        }

        return 'general';
    }

    private static function canonicalizeTerm(string $term): string
    {
        return self::normalizationMap()[$term] ?? $term;
    }

    private static function normalizationMap(): array
    {
        return [
            'pelo' => 'cabello',
            'champu' => 'cabello',
            'acondicionador' => 'cabello',
            'serum' => 'serum',
            'suero' => 'serum',
            'rostro' => 'face',
            'cara' => 'face',
            'facial' => 'face',
            'skin' => 'piel',
            'cabello' => 'cabello',
            'hair' => 'cabello',
            'melena' => 'cabello',
            'unas' => 'unas',
            'unias' => 'unas',
            'cuticula' => 'cuticula',
            'cuticulas' => 'cuticula',
            'cuticles' => 'cuticula',
            'cuticle' => 'cuticula',
            'fragancias' => 'fragancia',
            'fragancia' => 'fragancia',
            'perfume' => 'fragancia',
            'perfumes' => 'fragancia',
            'massage' => 'masaje',
            'body' => 'cuerpo',
            'acne' => 'face',
        ];
    }
}
