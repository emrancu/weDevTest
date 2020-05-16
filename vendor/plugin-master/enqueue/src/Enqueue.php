<?php

namespace PluginMaster\Enqueue;

use PluginMaster\Enqueue\base\EnqueueBase;

class Enqueue implements EnqueueBase
{


    public $plugin;
    public $pluginRoot;

    public function __construct()
    {

    }

    /**
     * @param $handler
     * @param $objectName
     */
    public function csrfToken($handler, $objectName)
    {
        wp_localize_script($handler, $objectName, array(
            'root' => esc_url_raw(rest_url()),
            'security' => wp_create_nonce('wp_rest')
        ));
    }

    /**
     * @param $path
     * @param string $id
     */
    public function footerScriptCdn($path, $id = '')
    {
        $handler = $id ? $id : uniqid();
        wp_enqueue_script($handler, $path, array(), false, true);
    }

    /**
     * @param $path
     * @param string $id
     */
    public function footerScript($path, $id = '')
    {
        $handler = $id ? $id : uniqid();
        $path = plugins_url($this->pluginRoot) . $path;
        wp_enqueue_script($handler, $path, array(), config("enqueue_version"), true);
    }

    /**
     * @param $fileName
     * @param int $port
     */
    public function hotScript($fileName, $port = 8080)
    {
        $handler = uniqid();
        $path = 'http://localhost:' . $port . '/assets/' . $fileName;
        wp_enqueue_script($handler, $path, array(), false, true);
    }

    /**
     * @param $path
     * @param string $id
     */
    public function headerScriptCdn($path, $id = '')
    {
        $handler = $id ? $id : uniqid();
        wp_enqueue_script($handler, $path, array(), false, false);
    }

    /**
     * @param $path
     * @param string $id
     */
    public function headerScript($path, $id = '')
    {
        $handler = $id ? $id : uniqid();
        $path = plugins_url($this->pluginRoot) . $path;
        wp_enqueue_script($handler, $path, array(), config("enqueue_version"), false);
    }

    /**
     * @param $path
     */
    public function style($path)
    {
        $path = plugins_url($this->pluginRoot) . $path;
        wp_enqueue_style(uniqid(), $path, array(), config("enqueue_version"), 'all');
    }

    /**
     * @param $path
     */
    public function styleCdn($path)
    {
        wp_enqueue_style(uniqid(), $path, array(), false, 'all');
    }

}
