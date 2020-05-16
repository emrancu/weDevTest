<?php


namespace PluginMaster\Enqueue\base;


interface EnqueueBase
{
    public function  csrfToken($handler, $objectName);

    public function  footerScriptCdn($path, $id = '');
    public function  footerScript($path, $id = '');

    public function  headerScriptCdn($path, $id = '');
    public function  headerScript($path, $id = '');

    public function  hotScript($fileName, $port = 8080);

    public function  style($path);
    public function  styleCdn($path);
}
