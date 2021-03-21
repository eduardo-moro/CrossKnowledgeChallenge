<?php
    
    
    namespace Cache {
        
        use Redis;
        use RedisException;
    
        class Cache
        {
            /**
             * @var Redis
             */
            private $redis;
    
            /**
             * DataBase constructor.
             * @throws RedisException
             */
            public function __construct() {
                require ('Config/db.php');
                $this->redis = new Redis();
                
                $this->connect();
            }
    
            /**
             * @return bool
             * @throws RedisException
             */
            public function connect(): bool {
                $this->redis->connect(HOST, PORT);
                $this->redis->auth(PASSWORD);
                
                return $this->ping();
            }
    
            public static function class(): Cache {
                return new Cache();
            }
            
            /**
             * @return bool
             * @throws RedisException
             */
            public function ping(): bool {
                if(!$this->redis->ping())
                    return false;
                return true;
            }
    
            /**
             * @return bool
             */
            public function flushAll(): bool {
                return $this->redis->flushAll();
            }
            
            /**
             * @param string $key
             * @param string $value
             * @param int $expires
             * @return bool
             */
            public function set(string $key, string $value, $expires=0):bool {
                if(!$this->redis->set($key, $value)){
                    echo ('Failed to set '.$key.' value'. PHP_EOL);
                    if($expires > 0) $this->redis->expire($key, $expires);
                    return false;
                }
                return true;
            }
    
            /**
             * @param $key
             * @return false|mixed
             */
            public function get($key){
                return $this->redis->get($key);
            }
            
        }
    }

    
    
