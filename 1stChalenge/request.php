<?php

use Cache\Cache as Cache;

class SimpleJsonRequest
{
    private static function makeRequest(string $method, string $url, array $parameters = null, array $data = null)
    {
        $opts = [
            'http' => [
                'method'  => $method,
                'header'  => 'Content-type: application/json',
                'content' => $data ? json_encode($data) : null
            ]
        ];

        
        $url .= ($parameters ? '?' . http_build_query($parameters) : '');
        
        if(!Cache::class()->get($url.json_encode($data))) {
            $return = file_get_contents($url, false, stream_context_create($opts));
            Cache::class()->set($url, $return, 10*60);
        }
        
        
        if(!json_decode(Cache::class()->get($url))){
            return(json_encode(Cache::class()->get($url)));
        } else {
            return(Cache::class()->get($url));
        }
    }

    public static function get(string $url, array $parameters = null)
    {
        return json_decode(self::makeRequest('GET', $url, $parameters));
    }

    public static function post(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('POST', $url, $parameters, $data));
    }

    public static function put(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('PUT', $url, $parameters, $data));
    }

    public static function patch(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('PATCH', $url, $parameters, $data));
    }

    public static function delete(string $url, array $parameters = null, array $data = null)
    {
        return json_decode(self::makeRequest('DELETE', $url, $parameters, $data));
    }
}
