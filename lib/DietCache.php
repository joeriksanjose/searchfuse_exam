<?php

class DietCache
{
    private $memcached = null;
    private $memcached_servers = array(
        array('host' => '127.0.0.1', 'port' => '11211')
    );

    public function __construct($servers = null)
    {
        if ($servers === null) {
            $servers = $this->memcached_servers;
        }

        if (class_exists('Memcached')) {
            $this->memcached = new Memcached();
        } else {
            throw new Exception('No suitable cache library available');
        }

        $this->connect($servers);
    }

    /**
     * @param array $servers An array of servers for Memcached. Keys are host and port
     */
    private function connect(array $servers)
    {
        foreach($servers as $server) {

            $weight = 1;

            if(isset($server['weight'])) {
                $weight = $server['weight'];
            }

            $this->memcached->addServer($server['host'], $server['port'], $weight);
        }
    }

    /**
     * @return Memcached|null The memcached initiated class
     */
    public function getCache()
    {
        return $this->memcached;
    }

    /**
     * Store a new entry in the cache, if the already exists replace it with a new value
     *
     * @param $key
     * @param $value
     * @param null $expire
     * @return bool
     */
    public static function add($key, $value, $expire = null)
    {
        $cache = new self();
        $result = $cache->memcached->add($key, $value, $expire);

        if($cache->memcached->getResultCode() === Memcached::RES_NOTSTORED) {
            $result = $cache->memcached->replace($key, $value, $expire);
        }

        return $result;
    }

    /**
     * @param String $key The key stored in cache to be retrieved
     * @return mixed The value of stored key
     */
    public static function get($key)
    {
        $cache = new self();
        return $cache->memcached->get($key);
    }

    /**
     * @param String|array $key The key stored in cache to be deleted
     * @return bool Returns if success or failed
     */
    public static function delete($key)
    {
        $cache = new self();
        if (is_array($key)) {
            foreach ($key as $val) {
                $cache->delete($val);
            }
        } else {
            return $cache->memcached->delete($key);
        }
    }

    /**
     * Update a key in stored in cache if it already exists
     * or create a new key value pair if otherwise
     *
     * @param $key
     * @param $value
     * @param $expire
     * @return bool
     */
    public static function set($key, $value, $expire = null)
    {
        $cache = new self();
        return $cache->memcached->set($key, $value, $expire);
    }

    /**
     * Get all keys by specified prefix (eg. "users_")
     * @param string $prefix
     * @return array $filtered_keys
     */
    public static function getMemcacheKeysByPrefix($prefix) {

        $cache = new self();
        $keys = $cache->memcached->getAllKeys();

        $filtered_keys = array();
        foreach ($keys as $key) {
            if (strpos($key, $prefix) === 0) {
                $filtered_keys[] = $key;
            }
        }

        return $filtered_keys;
    }
}