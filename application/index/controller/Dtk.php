<?php
namespace app\index\controller;

use think\Config;
use think\Controller;
use libs\HttpHelper;
use libs\CacheHelper;
class Dtk extends Controller
{
    protected  $appId;
    protected  $appKey;
    protected  $proxyVersion;
    protected  $autoCleanCache;
    protected  $host;
    protected function _initialize(){
      $this->appId = '662050';  // 站点的APPID （请勿修改和泄漏）
      $this->appKey = '1849B5465DE45F47E24CC974AF86B332';// 站点的APP KEY（请勿修改和泄漏）
      $this->proxyVersion = 8;
      $this->autoCleanCache = 200;
      $this->host = "http://cms3.dataoke.com";
    }
    public function index()
    {
      $require_arr = $this->create_url();
      $html = $this->http_get($require_arr[0], $require_arr[1],'GET');
  
      if (!empty($html)) {
        echo $html;
      }else{
        echo $this->create_500_html();
      }
      exit;
    }
  
  /**
   * 首页
   * @author: slide
   *
   */
    public function wapIndex(){
      echo '首页';
    }
  
  
    
    public function http_get($documentUrl, $requestUrl, $requestMethod='GET', $param = []){
      $test_env = strrpos(@$_SERVER['HTTP_USER_AGENT'], 'test') === false ? false : true;
      if ($test_env) {
        ini_set("display_errors", "On");
        error_reporting(E_ALL | E_STRICT);
      }
      //debug
      if ($test_env && isset($_GET['debug']) && $_GET['debug'] == 'php') {
        header("Content-type: text/html; charset=utf-8");
        echo 'cms 版本：' . $this->proxyVersion . '<br>';
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
  
      //dump($r_arr);exit;
  
      $cache = new CacheHelper();
  
      if (isset($_REQUEST['clean'])) {
        $cache->clean();
        header("Content-type: text/html; charset=utf-8");
        echo '已清除缓存';
        exit;
      }
      if (mt_rand(0, $this->autoCleanCache) == 1) {
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
      
      $httpHelper = new HttpHelper($this->appId, $this->appKey, $this->proxyVersion, $documentUrl);
  
      $html = $httpHelper->getHtml($this->host, $requestUrl, $param, $requestMethod);
      if ($requestMethod == 'GET' && $httpHelper->httpCode == 200 && !empty($html) && !$test_env) {
        $cache->Set($key, $html, 60);
      }
      return $html;
    }
    
    public function create_url(){
      $requestMethod = strtoupper(@$_SERVER["REQUEST_METHOD"]);
  
      $requestUrl = @$_SERVER["REQUEST_URI"];
  
  
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
      return [$documentUrl, $requestUrl, $requestMethod];
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
  
    public function by9(){
      if($this->request->isAjax()){
        return $this->ajaxNine();
      }else{
        $html = $this->http_get('/by9', 'search?r=index/9','GET');
  
        if (!empty($html)) {
          echo $html;
        }else{
          echo $this->create_500_html();
        }
        exit;
      }
    }
    
    public function ajaxNine(){
      $require_arr = $this->create_url();
      $data = input();
      $html = $this->http_get($require_arr[0], $require_arr[1], 'POST', $data);
  
      return json_decode($html);
    }
  /**
   * 搜索
   * @author: slide
   *
   */
  public function search(){
    $px = input('px') ? input('px') : 't';
    $html = $this->http_get('/ajaxSearch', 'search?r=index/search&kw='.input('kw').'&px='.$px,'GET');
    
    if (!empty($html)) {
      echo $html;
    }else{
      echo $this->create_500_html();
    }
    exit;
  }
  
  public function ajaxSearch(){
    $require_arr = $this->create_url();
    $data = input();
    $html = $this->http_get($require_arr[0], $require_arr[1], 'POST', $data);
  
    return json_decode($html);
  }
  
  public function cat(){
    if($this->request->isAjax()){
      return $this->ajaxCat();
    }else{
      $px = input('px') ? input('px') : 't';
      $html = $this->http_get('/cat', 'cat?r=index/cat&cid='.input('cid').'&px='.$px,'GET');
  
      if (!empty($html)) {
        echo $html;
      }else{
        echo $this->create_500_html();
      }
      exit;
    }
    
  }
  
  public function ajaxCat(){
    $require_arr = $this->create_url();
    $data = input();
    $html = $this->http_get($require_arr[0], $require_arr[1], 'POST', $data);
  
    return json_decode($html);
  }
  
  public function hot(){
    if($this->request->isAjax()){
      return $this->ajaxCat();
    }else{
      $px = input('px') ? input('px') : 't';
      $html = $this->http_get('/hot', 'hot?r=index/r','GET');
      
      if (!empty($html)) {
        echo $html;
      }else{
        echo $this->create_500_html();
      }
      exit;
    }
    
  }
  
  public function ajaxHot(){
    $require_arr = $this->create_url();
    $data = input();
    $html = $this->http_get($require_arr[0], $require_arr[1], 'POST', $data);
    
    return json_decode($html);
  }
}
