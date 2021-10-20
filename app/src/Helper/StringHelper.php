<?php


namespace App\Helper;


class StringHelper
{
    public static function slug($text): string
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text), '-'));
    }

    /**
     * Convert underscore_strings to camelCase (medial capitals).
     *
     * @param {string} $str
     *
     * @return string {string}
     */
    public static function toCamel($str, $separator = '_'): string
    {
        // Remove underscores, capitalize words, squash, lowercase first.
        return lcfirst(str_replace(' ', '', ucwords(str_replace($separator, ' ', $str))));
    }

    public static function toSnake($camel, $separator = '_'): string
    {
        $snake = preg_replace_callback('/[A-Z]/', function ($match) use ($separator) {
            return $separator . strtolower($match[0]);
        }, $camel);
        return ltrim($snake, $separator);
    }

    public static function toClassName($str): string
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $str));
        return str_replace(' ', '', $value);
    }
}
