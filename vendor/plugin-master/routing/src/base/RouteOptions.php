<?php


namespace PluginMaster\Routing\base;


trait RouteOptions
{


    /**
     * @param $callback
     * @param $method
     * @return array
     */
    protected function generateRouteOptions($callback, $method)
    {
        $controllerMethodExtract = explode('@', $callback);

        $class = "App" . "\\controller\\" . "api\\" . $controllerMethodExtract[0];
        $methodKey = $method === 'GET' ? 'method' : 'methods';
        return [
            $methodKey => $method,
            'callback' => [new $class(), $controllerMethodExtract[1]],
            'args' => $this->args
        ];
    }



}
