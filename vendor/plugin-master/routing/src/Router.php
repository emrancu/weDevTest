<?php
namespace PluginMaster\Routing;

use PluginMaster\Routing\base\RoutingBase;

class Router extends RoutingBase
{
    /**
     * @param $route
     * @param $callback
     * @param bool $secure
     * @return
     */
    public function getRoute($route, $callback, $restNamespace, $secure = false)
    {
        $formattedRoute = $this->formatRoute($route);
        $options = $this->generateRouteOptions($callback, 'GET');
        if ($secure) {
            $options['permission_callback'] = array($this, 'check_permission');
        }
        return $this->generateRestRoute($restNamespace, $formattedRoute, $options);

    }


    /**
     * @param $route
     * @param $callback
     * @param $restNamespace
     * @param bool $secure
     * @return
     */
    public function postRoute($route, $callback, $restNamespace, $secure = false)
    {
        $formattedRoute = $this->formatRoute($route);
        $options = $this->generateRouteOptions($callback, 'POST');

        if ($secure) {
            $options['permission_callback'] = array($this, 'check_permission');
        }

        return $this->generateRestRoute($restNamespace, $formattedRoute, $options);

    }

}
