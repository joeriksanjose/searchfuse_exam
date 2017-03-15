<?php
class Session
{
    public static function set($key, $value)
    {
        self::check();
        // multiple session setting
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                self::set($k, $v);
            }
        }
        $_SESSION[$key] = $value;
    }
    public static function get($key, $default = null, $expire_session = false)
    {
        self::check();
        if (isset($_SESSION[$key])) {
            $sess_value = $_SESSION[$key];
            if ($expire_session) {
                unset($_SESSION[$key]);
            }
            return $sess_value;
        }
        return $default;
    }
    public static function keyExist($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_destroy();
    }

    private static function check()
    {
        if (!session_id()) {
            session_start();
        }
    }
}