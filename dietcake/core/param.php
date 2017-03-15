<?php
class Param
{
    public static function get($name = null, $default = null)
    {
        // get all $_GET values.
        if ($name === null) {
            return $_GET;
        }

        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

    public static function post($name = null, $default = null)
    {
        // get all $_POST values.
        if ($name === null) {
            return $_POST;
        }

        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }

    public static function request($name = null, $default = null)
    {
        // get all $_REQUEST values.
        if ($name === null) {
            return self::params();
        }

        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }

    public static function params()
    {
        return $_REQUEST;
    }

    public static function isMethodPost()
    {
        return ($_SERVER["REQUEST_METHOD"] === "POST");
    }

    public static function isMethodGet()
    {
        return ($_SERVER["REQUEST_METHOD"] === "GET");
    }
}
