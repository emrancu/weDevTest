<?php


namespace PluginMaster\Routing\base;


trait RouteFormatter
{
    /**
     * format route param for Optional Parameter or Required Parameter
     * @param $route
     * @return string|string[]
     */
    protected function formatRoute($route)
    {
        if (strpos($route, '?}') !== false) {
            $route = $this->optionalParam($route);
        } else {
            $route = $this->requiredParam($route);
        }
        return $route;
    }

    /**
     * @param $route
     * @return string|string[]
     */
    protected function optionalParam($route)
    {
        $this->args = [] ;
        preg_match_all('#\{(.*?)\}#', $route, $match);
        foreach ($match[0] as $k => $v) {
            $route = str_replace('/' . $v, '(?:/(?P<' . str_replace('?', '', $match[1][$k]) . '>\d+))?', $route);
            array_push($this->args, $match[1][$k]);
        }
        return $route;
    }



    /**
     * @param $route
     * @return string|string[]
     */
    protected function requiredParam($route)
    {
        $this->args = [] ;
        preg_match_all('#\{(.*?)\}#', $route, $match);
        foreach ($match[0] as $k => $v) {
            $route = str_replace($v, '(?P<' . $match[1][$k] . '>\d+)', $route);
            array_push($this->args, $match[1][$k]);
        }
        return $route;
    }

}
