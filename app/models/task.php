<?php
class Task extends AppModel
{
    const STATUS_NEW = 1;
    const STATUS_ONGOING = 2;
    const STATUS_DONE = 3;
    const STATUS_PENDING = 4;

    public static function getAllTasksByStatus($user_id, $status, $since_datetime = null)
    {
        $db = DB::conn();
        $query = "SELECT * FROM tasks WHERE assigned_user_id = ? and status = ?";
        $params = [$user_id, $status];

        if ($since_datetime) {
            $query .= " and status_updated_at <= ?";
            $params[] = $since_datetime;
        }

        return $db->rows($query, $params);

    }

    public static function getAllTasksByUserId($user_id)
    {
        $db = DB::conn();
        return $db->rows("SELECT * FROM tasks WHERE assigned_user_id = ?", [$user_id]);
    }
}