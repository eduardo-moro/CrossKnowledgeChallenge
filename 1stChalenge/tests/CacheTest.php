<?php
    
    use Cache\Cache as CacheAlias;
    use PHPUnit\Framework\TestCase;
    
    include __DIR__ . "/../Cache.php";
    include __DIR__ . "/../request.php";

    class CacheTest extends TestCase {
    
        public function testCacheCanBeCreated() {
            $this->assertInstanceOf(
                CacheAlias::class,
                new CacheAlias()
            );
        }
        
        public function testConnect() {
            $this->assertTrue(
                CacheAlias::class()->ping()
            );
        }
    
        public function testSet() {
            $this->assertTrue(
                CacheAlias::class()->set(
                    'test',
                    '{saved: true}',
                    5
                )
            );
        }
        
        public function testGet() {
            $this->assertTrue(
                CacheAlias::class()->get('test') === '{saved: true}',
            );
        }

        public function testFlushAll() {
            $this->assertTrue(
                CacheAlias::class()->flushAll()
            );
        }
        
        public function testFlushed() {
            $this->assertFalse(
                CacheAlias::class()->get('test')
            );
        }
        
        public function testGetRequest() {
            $this->assertTrue(
                SimpleJsonRequest::get(
                    'http://localhost:8080',
                    ['userId' => 0]
                )->status == 200
            );
        }
        
        public function testPostRequest() {
            $this->assertTrue(
                SimpleJsonRequest::post(
                    'http://localhost:8080',
                    [],
                    ['login' => 'test', 'password' => 'pass'],
                )->status == 200
            );
        }
        
    }
