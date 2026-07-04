<?php

if (!function_exists('highlightKeyword')) {
    /**
     * Highlight a keyword within a text string using <mark> tags.
     */
    function highlightKeyword(?string $text, ?string $keyword): string
    {
        if (!$text || !$keyword) {
            return e($text ?? '');
        }

        $escaped = e($text);
        $escapedKeyword = e($keyword);

        return str_ireplace(
            $escapedKeyword,
            '<mark class="bg-warning text-dark px-1 rounded">' . $escapedKeyword . '</mark>',
            $escaped
        );
    }
}
