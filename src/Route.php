<?php

namespace RestApi;

class Route
{
    /**
     * @return array
     */
    private static function routes()
    {
        return [
            'vehicle' => [
                'POST' => ['verb' => 'create', 'function' => 'create'],
                'GET' => ['verb' => '', 'function' => 'all'],
            ]
        ];
    }

    /**
     * @param $endpoint
     * @param $method
     * @param $verb
     *
     * @return bool
     */
    public static function validateRoutes($endpoint, $method, $verb)
    {
        if (!array_key_exists($endpoint, self::routes())) {
            return false;
        }

        if (!array_key_exists($method, self::routes()[$endpoint])) {
            return false;
        }

        if (!($verb == self::routes()[$endpoint][$method]['verb'])) {
            return false;
        }

        return true;
    }

    /**
     * @param $endpoint
     * @param $method
     * @return mixed
     */
    public static function getFunctionInRoutes($endpoint, $method)
    {
        $routes = self::routes();

        return $routes[$endpoint][$method]['function'];
    }

}