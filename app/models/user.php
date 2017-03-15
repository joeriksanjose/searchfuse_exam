<?php
class User extends AppModel
{
    public static function create($data)
    {
        $db = DB::conn();
        $db->insert('users', $data);

        return new self($data);
    }

    public static function verify($username, $password)
    {
        $db = DB::conn();
        $user = $db->row("SELECT * FROM users WHERE username = ? and password = ?", [$username, $password]);

        return $user;
    }
}