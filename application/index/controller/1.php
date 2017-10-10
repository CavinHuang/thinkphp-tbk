<?php
namespace app\index\controller;

use think\Config;
use think\Controller;
use libs\CacheHelper;
use libs\HttpHelper;
class Index extends Controller
{
    public function index()
    {
      $host = "http://cms3.dataoke.com";
      $test_env = strrpos(@$_SERVER['HTTP_USER_AGENT'], 'test') === false ? false : true;
      $requestMethod = strtoupper(@$_SERVER["REQUEST_METHOD"]);
      
      $requestUrl = @$_SERVER["REQUEST_URI"];
      if ($test_env) {
        ini_set("display_errors", "On");
        error_reporting(E_ALL | E_STRICT);
      }
      //debug
      if ($test_env && isset($_GET['debug']) && $_GET['debug'] == 'php') {
        header("Content-type: text/html; charset=utf-8");
        echo 'cms 版本：' . Config::get('proxyVersion') . '<br>';
        echo 'php 版本：' . PHP_VERSION . '<br>';
        if (function_exists('curl_init')) {
          echo 'curl 已经开启 ' . '<br>';
        } else {
          echo 'curl <span style="color: red">未开启,请先开启curl扩展，否则无法运行,请联系您的空间或者服务器提供商</span>' . '<br>';
        }
        if (function_exists('mb_substr')) {
          echo 'mbstring 已经开启 ' . '<br>';
        } else {
          echo 'mbstring <span style="color: red">未开启,请先开启mbstring扩展，否则无法运行</span>' . '<br>';
        }
        $test_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cache';
        $test_file = $test_dir . '/test.txt';
        if (!is_dir($test_dir)) {
          @mkdir($this->dir);
        }
        @file_put_contents($test_file, 'test');
        if (file_exists($test_file)) {
          echo 'cache：有效<br>';
        } else {
          echo 'cache <span style="color: red">无效</span>' . '<br>';
        }
        exit;
      }
     
      // ======================
      $cache = new CacheHelper();
  
      if (isset($_REQUEST['clean'])) {
        $cache->clean();
        header("Content-type: text/html; charset=utf-8");
        echo '已清除缓存';
        exit;
      }
      if (mt_rand(0, Config::get('autoCleanCache')) == 1) {
        $cache->clean();
      }
      $key = md5($requestUrl . CacheHelper::isMobile() . CacheHelper::isIPad() . CacheHelper::isIPhone() . CacheHelper::isMicroMessenger());
      if ($requestMethod == 'GET') {
        if (!$test_env) {
          $cacheData = $cache->Get($key);
          if ($cacheData !== false && !empty($cacheData)) {
            echo $cacheData;
            exit;
          }
        }
      }
  
      $documentUrl = @$_SERVER["PHP_SELF"];
      if (empty($documentUrl)) {
        $documentUrl = @$_SERVER["SCRIPT_NAME"];
      }
      if (empty($documentUrl)) {
        $documentUrl = @$_SERVER["DOCUMENT_URI"];
      }
      
      if (empty($documentUrl)) {
        $documentUrl = $requestUrl;
        $str_pos = strpos($requestUrl, '?');
        if ($str_pos !== false) {
          $documentUrl = substr($requestUrl, 0, $str_pos);
        }
      }
      
      $httpHelper = new HttpHelper(Config::get('appId'), config::get('appKey'), Config::get('proxyVersion'), $documentUrl);
      //dump($httpHelper);
      //dump(input());
      $html = $httpHelper->getHtml($host, $requestUrl, $requestMethod == 'POST' ? @$_POST : array(), $requestMethod);
      //dump($html);die;
      //exit;
      if ($requestMethod == 'GET' && $httpHelper->httpCode == 200 && !empty($html) && !$test_env) {
        $cache->Set($key, $html, 60);
      }
      if (!empty($html)) {
        //dump($html);exit;
        echo $html;
      }else{
        echo $this->create_500_html();
      }
      exit;
    }
    
    public function create_500_html () {
      $html_500=<<<html
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="x-dns-prefetch-control" content="on"/>
 <meta name="apple-mobile-web-app-capable" content="yes"/>
 <meta content="telephone=no" name="format-detection"/>
 <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
<title>500页面</title></head><body>
<div class="wrong-main">
<div class="wrong-icon"><img src="https://img.alicdn.com/imgextra/i3/97012073/TB2DHjloY4npuFjSZFmXXXl4FXa_!!97012073.png" width="100%"></div>
<div class="wrong-txt"><p>服务器开小差了，很快就好，稍后再刷新试试吧~</p></div>
</div>
</body>
<style>
		body{margin:0;padding:0;color:#817577;text-align:center;}.wrong-main{width:90%;margin: 180px auto 0}.wrong-icon{display:block;}.wrong-icon img{max-width: 300px;}.wrong-txt{margin-top: 30px;display: block;}
@media only screen and (max-width: 380px){.wrong-txt{font-size:.8rem}}
</style>
</html>
html;
      return $html_500;
    }
}
