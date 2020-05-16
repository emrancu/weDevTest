<?php

namespace PluginMaster\Routing\base;

use PluginMaster\Routing\base\RouteFormatter;
use PluginMaster\Routing\base\RouteOptions;

abstract class RoutingBase
{
    use RouteFormatter,RouteOptions;

    protected $args = [];

    abstract function getRoute($route, $callback, $restNamespace, $secure = false);

    abstract function postRoute($route, $callback, $restNamespace, $secure = false);



    /**
     * @return bool
     */
    protected function check_permission()
    {
        return current_user_can('manage_options');
    }


    /**
     * @param $restNamespace
     * @param $route
     * @param $options
     * @return
     */
    protected function generateRestRoute($restNamespace, $route, $options)
    {
        return register_rest_route(
            $restNamespace,
            '/' . $route,
            $options
        );
    }

}
