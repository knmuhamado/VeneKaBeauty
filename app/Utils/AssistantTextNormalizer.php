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
            'de', 'la', 'el', 'los', 'las', 'para', 'con', 'sin', 'una', 'uno', 'unos',
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
        // Only transliterate special characters (accents, ñ, etc.) to ASCII.
        // Word-level canonicalization is handled separately in canonicalizeTerm.
        return Str::ascii(mb_strtolower($text));
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
        return self::canonicalizationMap()[$term] ?? $term;
    }

    /**
     * Maps synonym/variant words to their canonical form.
     * Used after ASCII normalization to unify terms before scoring.
     */
    private static function canonicalizationMap(): array
    {
        return [
            // Hair
            'pelo' => 'cabello',
            'champu' => 'cabello',
            'shampoo' => 'cabello',
            'acondicionador' => 'cabello',
            'hair' => 'cabello',
            'melena' => 'cabello',
            // Serum
            'suero' => 'serum',
            // Face
            'rostro' => 'face',
            'cara' => 'face',
            'facial' => 'face',
            'acne' => 'face',
            // Skin
            'skin' => 'piel',
            // Nails
            'unas' => 'unas',
            'unias' => 'unas',
            'mano' => 'unas',
            'manos' => 'unas',
            // Cuticles
            'cuticulas' => 'cuticula',
            'cuticles' => 'cuticula',
            'cuticle' => 'cuticula',
            // Fragrance
            'fragancias' => 'fragancia',
            'perfume' => 'fragancia',
            'perfumes' => 'fragancia',
            // Body
            'body' => 'cuerpo',
            'massage' => 'masaje',
        ];
    }
}
