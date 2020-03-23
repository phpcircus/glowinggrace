<?php

use App\Flash\Flash;
use App\Flash\Message;

if (! function_exists('format_money')) {
    /**
     * Format the given number as money in US dollars.
     *
     * @param  int  $value
     */
    function format_money($value): string
    {
        $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

        return $fmt->format($value);
    }
}

if (! function_exists('redirect_if')) {
    /**
     * Redirect to the given route,url, or action if the given condition is true.
     *
     * @param  mixed  $condition
     * @param  string  $route
     * @param  array  $parameters
     *
     * @return mixed
     */
    function redirect_if($condition, $route, ?array $parameters = [])
    {
        if (! $condition) {
            return;
        }

        return $parameters ? redirect($route)->with($parameters) : redirect($route);
    }
}

if (! function_exists('redirect_unless')) {
    /**
     * Redirect to the given route,url, or action unless the given condition is true.
     *
     * @param  mixed  $condition
     * @param  string  $route
     * @param  array  $parameters
     *
     * @return mixed
     */
    function redirect_unless($condition, $route, ?array $parameters = [])
    {
        if ($condition) {
            return;
        }

        return $parameters ? redirect($route)->with($parameters) : redirect($route);
    }
}

if (! function_exists('flash')) {
    /**
     * @param string $text
     * @param string|array $class
     */
    function flash(string $key = 'default', string $text = null, $class = null): Flash
    {
        /** @var \App\Flash\Flash $flash */
        $flash = app(Flash::class);

        if (is_null($text)) {
            return $flash;
        }

        $message = new Message($key, $text, $class);
        $flash->flash($message);

        return $flash;
    }
}
