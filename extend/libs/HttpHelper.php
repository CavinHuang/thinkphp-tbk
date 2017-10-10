<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21 0021
 * Time: 下午 10:33
 */
namespace libs;

class HttpHelper {
  protected $appId;
  protected $key;
  protected $documentUrl;
  protected $proxyVersion;
  protected $upgradeUrl = "http://www.dataoke.com/personSetCms/index.php?r=userApply/upgrade";
  
  public $httpCode = 200;
  
  public function __construct($appId, $key, $proxyVersion, $documentUrl)
  {
    $this->appId = $appId;
    $this->key = $key;
    $this->documentUrl = $documentUrl;
    $this->proxyVersion = $proxyVersion;
  }
  
  
  /**
   * @param $url
   * @param $requestUrl
   * @param array $param
   * @param string $method
   * @param bool $isAjax
   * @param string $cookie
   * @param string $refer
   * @param null $userAgent
   * @param bool $checkNewVersion
   * @return string
   */
  public function getHtml($url, $requestUrl, $param = array(), $method = 'GET', $isAjax = null, $cookie = NULL, $refer = null, $userAgent = null, $checkNewVersion = true)
  {
    if (strpos($requestUrl, 'auth') !== false) {
      $url .= '/auth';
    }
    if($requestUrl=='/favicon.ico'){
      exit;
    }
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 1);
    empty($refer) && $refer = @$_SERVER['HTTP_REFERER'];
    $ua = $userAgent;
    empty($ua) && $ua = @$_SERVER['HTTP_USER_AGENT'];
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_REFERER, $refer);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $header = array(
      'APPID: ' . $this->appId,
      'APPKEY: ' . $this->key,
      'PROXY-VERSION: ' . $this->proxyVersion,
      'CMS-HOST: ' . @$_SERVER["HTTP_HOST"],
      'DOCUMENT-URL: ' . $this->documentUrl,
      'REQUEST-URL: ' . $requestUrl,
    );
    //debug
    global $test_env;
    if ($test_env && isset($_GET['debug']) && $_GET['debug'] == 'header') {
      echo 'CMS-HOST: ' . @$_SERVER["HTTP_HOST"] . '<br>';
      echo 'DOCUMENT-URL: ' . $this->documentUrl . '<br>';
      echo 'REQUEST-URL: ' . $requestUrl . '<br>';
      echo 'api-host: ' . $url . '<br>';
      exit;
    }
//    dump($requestUrl);exit;
//    dump($url);exit;
    $_isAjax = false;
    if ($isAjax) {
      $_isAjax = true;
    }
    if (!$_isAjax && $isAjax === null) {
      $_isAjax = $this->getIsAjaxRequest();
    }
    if ($_isAjax) {
      $header[] = 'X-Requested-With: XMLHttpRequest';
    }
    $clientIp = $this->get_real_ip();
    if (!empty($clientIp)) {
      $header[] = 'CLIENT-IP: ' . $clientIp;
      $header[] = 'X-FORWARDED-FOR: ' . $clientIp;
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    if (empty($cookie)) {
      $cookie = $_COOKIE;
    }
    if (is_array($cookie)) {
      $str = '';
      foreach ($cookie as $k => $v) {
        $str .= $k . '=' . $v . '; ';
      }
      $cookie = $str;
    }
    if (!empty($cookie)) {
      curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if (strtolower($method) == 'post') {
      curl_setopt($ch, CURLOPT_POST, TRUE);
      if ($param) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
      }
      curl_setopt($ch, CURLOPT_URL, $url);
    } else {
      curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
      if ($param) {
        $urlInfo = parse_url($url);
        
        $q = array();
        if (isset($urlInfo['query']) && !empty($urlInfo['query'])) {
          parse_str($urlInfo['query'], $q);
        }
        
        
        $q = array_merge($q, $param);
        $cUrl = sprintf('%s://%s%s%s%s',
          $urlInfo['scheme'],
          $urlInfo['host'],
          isset($urlInfo['port']) ? ':' . $urlInfo['port'] : '',
          isset($urlInfo['path']) ? $urlInfo['path'] : '',
          count($q) ? '?' . http_build_query($q) : '');
        
        curl_setopt($ch, CURLOPT_URL, $cUrl);
      } else {
        curl_setopt($ch, CURLOPT_URL, $url);
      }
    }
    
    $r = curl_exec($ch);
  
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = mb_substr($r, 0, $headerSize);
    $r = mb_substr($r, $headerSize);
    $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    unset($ch);
    $headers = explode("\r\n", $header);
    //debug
    if ($test_env && isset($_GET['debug']) && $_GET['debug'] == 'res') {
      var_dump($r);
      var_dump($this->httpCode);
      exit;
    }
    //debug
    if ($test_env && isset($_GET['debug']) && $_GET['debug'] == 'resheader') {
      var_dump($headers);
      exit;
    }
    if ($this->httpCode != 200) {
      if (function_exists('http_response_code')) {
        http_response_code($this->httpCode);
      } else {
        if ($this->httpCode !== 302) {
          $this->setHttpResponseCode($this->httpCode);
        }
      }
    }
    $expires = time() + 300;
    foreach ($headers as $h) {
      $h = trim($h);
      if (empty($h) || preg_match('/^(HTTP|Connection|EagleId|Server|X\-Powered\-By|Date|Transfer\-Encoding|Content)/i', $h)) {
        continue;
      }
      if (strpos($h, 'expires:') !== false) {
        $temp_arr = explode(':', $h);
        if (!empty($temp_arr[1]) && is_numeric(trim($temp_arr[1]))) {
          $expires = intval(trim($temp_arr[1]));
        }
      }
      if (strpos($h, 'Cookie') !== false) {
        
        $h = explode(':', $h);
        if (!empty($h[1])) {
          $h = explode('=', $h[1]);
          if (!empty($h[0]) && !empty($h[1])) {
            @setcookie(trim($h[0]), trim($h[1]), $expires);
          }
        }
      } else {
        @header($h);
      }
    }
    //debug
    if ($test_env && isset($_GET['debug']) && $_GET['debug'] == 'res1') {
      var_dump($r);
      var_dump($headers);
      exit;
    }
    
    if ($this->httpCode != 200 && $this->httpCode != 302) {
      return false;
    }
    if($this->httpCode==200 && $checkNewVersion){
      foreach ($headers as $h) {
        if ( preg_match('/pv:\s*(?P<pv>\d+)/i', $h, $regs)) {
          $pv = $regs['pv'];
          if ($pv > $this->proxyVersion) {
            $this->upgrade();
          }
        }
      }
    }
//    dump($r);exit;
//    dump($r);
    /*$p = "%<div class=\"goods-list\" data-page=\"2\">(.*?)<div  class=\"pullup-goods\">%si";
    preg_match_all($p, $r, $arr);
    if(isset($arr[1][0])){
      //$str = '<div class="goods-list" data-page="2">'.$arr[1][0];
      //dump('<div class="goods-list" data-page="2">'.$arr[1][0]);
      //require_once EXTEND_PATH.'libs/JSLikeHTMLElement.php';
  
      $dom  = new \DOMDocument();
      //$dom->registerNodeClass('DOMElement', 'JSLikeHTMLElement');
      $page = preg_replace('/\s+/', ' ', trim($r));
  
      //    $page = mb_convert_encoding($page, 'utf-8');
      //    $page = htmlspecialchars($page);?
      fixAmps($page, 0);
      $dom->encoding='utf-8';
//      $page = preg_replace('/charset=\"utf-8\"/', 'http-equiv="Content-Type" content="text/html; charset=utf-8"', $page);
  
      //dump($page);exit;
  
      $dom->loadHTML($page);
      //dump($dom);
      $dom->normalizeDocument();
      $item = $dom->getElementsByTagName('div');
      $form_ele = $dom->getElementsByTagName('form');
      isset($form_ele[0]) && $form_ele[0]->setAttribute('action','/search.html');
      $html_item=[];
//      $script = $dom->getElementsByTagName('script');
      //      foreach ($script as $sc_item){
      //        $text = $sc_item->ownerDocument->saveHTML($sc_item);
      ////        dump($text);
      //        $text_res = preg_replace('/\/\//', ' ', trim($text));
      ////        dump($text_res);
      //        //setInnerHTML($sc_item,$text_res );
      //      }
//      exit;
      foreach ($item as $item_div){
        $item_class = $item_div->getAttribute('class');
        if($item_class == 'goods-item'){
          // 取出title和img
          $item_a = $item_div->getElementsByTagName('a');
          foreach ($item_a as $item_div_a){
            $class_a = $item_div_a->getAttribute('class');
            if($class_a == 'img' || $class_a == 'title'){
              // 处理链接
              $href = $item_div_a->getAttribute('href');
              $href_arr = explode('&', $href);
              $item_div_a->setAttribute('href','/content.html?'.$href_arr[1]);
            }
          }
        }
      }
      //dump($dom->encoding);exit;
      $html = $dom->saveHTML();
    }*/
  
    //$p = "%<div class=\"goods-list\" data-page=\"2\">(.*?)<div  class=\"pullup-goods\">%si";
    //preg_match_all($p, $r, $arr);
    $page = preg_replace('/charset=\"utf-8\"/', 'http-equiv="Content-Type" content="text/html; charset=utf-8"', $r);
  
    // 替换ajax地址 var tPaht="/home"
    $page = preg_replace('/=\"\/home\"/', '="/home/ajaxNine"', $page);
  
    $doc = \phpQuery::newDocumentHTML($page, $charset = 'utf-8');
    
    
    // 处理json
    
    if(strpos($r, '"status":0')){
      $json_data = json_decode($r, true);
      $content = $json_data['data']['content'];
  
      $doc = \phpQuery::newDocumentHTML($content);
  
      $goods_item = pq("div.goods-item");
  
      if(pq('div.order-nav')->length > 0){
        // 顶部
        $li_arr = pq('div.order-nav')->find('ul')->find('li');
        foreach ($li_arr as $li_item){
          $a = pq($li_item)->find('a')->attr('href');
          $a_arr = explode('&', $a);
          unset($a_arr[0]);
          $url_query = '';
          foreach ($a_arr as $v){
            $url_query .= $v.'&';
          }
          $url_query = mb_substr($url_query, 0, strlen($url_query) -1);
          pq($li_item)->find('a')->attr('href', '/search.html?'.$url_query);
        }
      }
  
      foreach ($goods_item as $item){
        //dump($item->childNodes);
        foreach ($item->childNodes as $aa){
          if(pq($aa)->hasClass('img') || pq($aa)->hasClass('title')){
            $href = pq($aa)->attr('href');
            $href_arr = explode('&', $href);
            pq($aa)->attr('href', '/content.html?'.$href_arr[1]);
          }
        }
      }
      $json_data['data']['content'] =$doc->htmlOuter();
      return json_encode($json_data);
    }else
      if( pq("div.goods-list")->length > 0){
      $page = preg_replace('/charset=\"utf-8\"/', 'http-equiv="Content-Type" content="text/html; charset=utf-8"', $r);
      
      // 替换ajax地址 var tPaht="/home"
      $page = preg_replace('/\" href=\"\/by9\"/', '" href="/index"', $page);
      $page = preg_replace('/\" href=\"\/cat\"/', '" href="/index"', $page);
      $page = preg_replace('/\" href=\"\/hot\"/', '" href="/index"', $page);
  
        $doc = \phpQuery::newDocumentHTML($page, $charset = 'utf-8');
      
      $goods_item = pq("div.goods-item");
      
      if(pq('div.order-nav')->length > 0){
        // 顶部
        $li_arr = pq('div.order-nav')->find('ul')->find('li');
        foreach ($li_arr as $li_item){
          $a = pq($li_item)->find('a')->attr('href');
          $a_arr = explode('&', $a);
          $path = explode('?', $a_arr[0]);
          unset($a_arr[0]);
          $url_query = '';
          foreach ($a_arr as $v){
            $url_query .= $v.'&';
          }
          $url_query = mb_substr($url_query, 0, strlen($url_query) -1);
          
          pq($li_item)->find('a')->attr('href', $path[0].'.html?'.$url_query);
        }
      }
      
      foreach ($goods_item as $item){
        //dump($item->childNodes);
        foreach ($item->childNodes as $aa){
          if(pq($aa)->hasClass('img') || pq($aa)->hasClass('title')){
            $href = pq($aa)->attr('href');
            $href_arr = explode('&', $href);
            pq($aa)->attr('href', '/content.html?'.$href_arr[1]);
          }
        }
      }
      print $doc;exit;
    }
//    dump(isset($doc)?$doc:$r);exit;
    return isset($doc)?$doc:$r;
  }
  
  public function upgrade()
  {
    $php = $this->getHtml($this->upgradeUrl, '', array(), 'GET', false, null, null, null, false);
    if ($php === false || strlen($php) < 500) {
      return;
    }
    //dump($php);exit;
    $php = @json_decode($php, true);
    if (empty($php['appid']) || empty($php['appkey']) || empty($php['content']) || $php['appid'] !== $this->appId) {
      return;
    }
    $file = @$_SERVER["DOCUMENT_ROOT"] . $this->documentUrl;
    if (!defined("DTK_TYPE")) {
      @file_put_contents($file, $php['content'], LOCK_EX);
    } else {
      $file .= 'req.php';
      @file_put_contents($file, $php['content'], LOCK_EX);
    }
    $cache = new  CacheHelper(APP_ROOT . DIRECTORY_SEPARATOR . 'cache');
    $cache->clean();
  }
  
  
  function get_real_ip()
  {
    if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) {
      $ip = @$_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (@$_SERVER["HTTP_CLIENT_IP"]) {
      $ip = @$_SERVER["HTTP_CLIENT_IP"];
    } elseif (@$_SERVER["REMOTE_ADDR"]) {
      $ip = @$_SERVER["REMOTE_ADDR"];
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
      $ip = getenv("HTTP_X_FORWARDED_FOR");
    } elseif (getenv("HTTP_CLIENT_IP")) {
      $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("REMOTE_ADDR")) {
      $ip = getenv("REMOTE_ADDR");
    } else {
      $ip = "";
    }
    return $ip;
  }
  
  public function getIsAjaxRequest()
  {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }
  
  public function setHttpResponseCode($code)
  {
    switch ($code) {
      case 100:
        $text = 'Continue';
        break;
      case 101:
        $text = 'Switching Protocols';
        break;
      case 200:
        $text = 'OK';
        break;
      case 201:
        $text = 'Created';
        break;
      case 202:
        $text = 'Accepted';
        break;
      case 203:
        $text = 'Non-Authoritative Information';
        break;
      case 204:
        $text = 'No Content';
        break;
      case 205:
        $text = 'Reset Content';
        break;
      case 206:
        $text = 'Partial Content';
        break;
      case 300:
        $text = 'Multiple Choices';
        break;
      case 301:
        $text = 'Moved Permanently';
        break;
      case 302:
        $text = 'Moved Temporarily';
        break;
      case 303:
        $text = 'See Other';
        break;
      case 304:
        $text = 'Not Modified';
        break;
      case 305:
        $text = 'Use Proxy';
        break;
      case 400:
        $text = 'Bad Request';
        break;
      case 401:
        $text = 'Unauthorized';
        break;
      case 402:
        $text = 'Payment Required';
        break;
      case 403:
        $text = 'Forbidden';
        break;
      case 404:
        $text = 'Not Found';
        break;
      case 405:
        $text = 'Method Not Allowed';
        break;
      case 406:
        $text = 'Not Acceptable';
        break;
      case 407:
        $text = 'Proxy Authentication Required';
        break;
      case 408:
        $text = 'Request Time-out';
        break;
      case 409:
        $text = 'Conflict';
        break;
      case 410:
        $text = 'Gone';
        break;
      case 411:
        $text = 'Length Required';
        break;
      case 412:
        $text = 'Precondition Failed';
        break;
      case 413:
        $text = 'Request Entity Too Large';
        break;
      case 414:
        $text = 'Request-URI Too Large';
        break;
      case 415:
        $text = 'Unsupported Media Type';
        break;
      case 500:
        $text = 'Internal Server Error';
        break;
      case 501:
        $text = 'Not Implemented';
        break;
      case 502:
        $text = 'Bad Gateway';
        break;
      case 503:
        $text = 'Service Unavailable';
        break;
      case 504:
        $text = 'Gateway Time-out';
        break;
      case 505:
        $text = 'HTTP Version not supported';
        break;
      default:
        $text = '';
        break;
    }
    $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
    @header($protocol . ' ' . $code . ' ' . $text);
  }
}
