<?php
class DietRedis
{
    /**
     * Sets the default connection for redis
     * @var array $default_redis_connection
     */
    private $default_redis_connection = array(
        'host' => '127.0.0.1',
        'port' => '6379'
    );

    /**
     * Initializes Redis Class
     * @param array $conn - array of host and port of redis server to be used
     * @throws Exception
     */
    function __construct($conn = null) {
        if (class_exists('Redis')) {
            $this->redis = new Redis();
        } else {
            throw new Exception("Redis class does not exist");
        }

        if ($conn === null) {
            $conn = $this->default_redis_connection;
        }

        $this->redis->pconnect($conn['host'], $conn['port']);
    }

    /**
     * Stores a key-pair
     * Returns true if successful, false if adding fails.
     * Redis::set([key], [value])
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function add($key, $value)
    {
        return $this->redis->set($key, $value);
    }

    /**
     * Retrieves value from redis using key.
     * Returns false if key didn't exist.
     * Redis::get([key])
     *
     * @param $key
     * @return string|bool
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }

    /**
     * Removes the specified redis key.
     * Redis::delete([key])
     *
     * @param $key
     * @return int - number of keys deleted
     */
    public function delete($key)
    {
        return $this->redis->delete($key);
    }

    /**
     * Checks if a redis key already exists.
     * Redis::exists([key])
     *
     * @param $key
     * @return bool
     */
    public function isKeyExist($key)
    {
        return $this->redis->exists($key);
    }

    /**
     * Increase a redis value by $incr_by variable (default 1)
     * If key is not existing, it will automatically creates the key with value of 0
     * before the increment
     * Redis::incr([key], [incr_by(optional) = 1])
     *
     * @param string $key
     * @param int $incr_by - value to be added
     * @return int - new value after adding/increment
     */
    public function increase($key, $incr_by = 1)
    {
        return $this->redis->incr($key, $incr_by);
    }

    /**
     * Decrease a redis value by $decr_by variable (default 1)
     * If key is not existing, it will automatically creates the key with value of 0
     * before the decrement.
     *
     * @param $key
     * @param int $decr_by - value to be subtracted
     * @param bool $allow_negative - trigger to allow negative return value (default false)
     * @return int - new value after subtracting/decrement
     */
    public function decrease($key, $decr_by = 1, $allow_negative = false)
    {
        $val = $this->redis->decr($key, $decr_by);

        // if $allow_negative is === false and value returned after decrease is negative
        // set the value to 0
        if (!$allow_negative && $val < 0) {
            $this->add($key, 0);
            $val = 0;
        }

        return $val;
    }
}