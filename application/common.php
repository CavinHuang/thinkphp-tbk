<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function findNum($str=''){
  $str=trim($str);
  if(empty($str)){return '';}
  $reg='/(\d{3}(\.\d+)?)/is';//匹配数字的正则表达式
  preg_match_all($reg,$str,$result); if(is_array($result)&&!empty($result)&&!empty($result[1])&&!empty($result[1][0])){
    return $result[1][0];
  }
  return '';
}

/**
 * 返回优惠券的面额 如 满39元减20元 返回20
 * @author: slide
 *
 * @param $str
 *
 * @return mixed
 *
 */
function findCounpPrice($str){
  
  preg_match_all('/([0-9])+/',$str,$reg);
  return $reg[0][1];
}
/**
 * CURL请求
 * @param $url 请求url地址
 * @param $method 请求方法 get post
 * @param null $postfields post数据数组
 * @param array $headers 请求header信息
 * @param bool|false $debug  调试开启 默认false
 * @return mixed
 */
function httpRequest($url, $method="GET", $postfields = null, $headers = array(), $debug = false) {
  $method = strtoupper($method);
  $ci = curl_init();
  /* Curl settings */
  curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
  curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
  curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
  curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
  curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
  switch ($method) {
    case "POST":
      curl_setopt($ci, CURLOPT_POST, true);
      if (!empty($postfields)) {
        $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
        curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
      }
      break;
    default:
      curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
      break;
  }
  $ssl = preg_match('/^https:\/\//i',$url) ? TRUE : FALSE;
  curl_setopt($ci, CURLOPT_URL, $url);
  if($ssl){
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在
  }
  //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
  curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ci, CURLOPT_MAXREDIRS, 2);/*指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的*/
  curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ci, CURLINFO_HEADER_OUT, true);
  /*curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
  $response = curl_exec($ci);
  $requestinfo = curl_getinfo($ci);
  $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
  if ($debug) {
    echo "=====post data======\r\n";
    dump($postfields);
    echo "=====info===== \r\n";
    dump($requestinfo);
    echo "=====response=====\r\n";
    dump($response);
  }
  curl_close($ci);
  return $response;
  //return array($http_code, $response,$requestinfo);
}
/**
 * 简写日志写入
 * @param    [type]                   $msg  [description]
 * @param    [type]                   $type [description]
 * @Author:  slade
 * @DateTime :2017-05-16T11:22:18+080
 */
function L($msg, $type='info'){
  \Think\Log::write($msg, $type);
}

function create_rand($min, $max){
  return rand($min, $max);
}

/**
 * 创建二合一链接
 * @author: slide
 *
 *
 *        https://uland.taobao.com/coupon/edetail?activity_id=18b42914299e460fa98dfe10135fe86f&itemId=548527641045&pid=mm_112972830_29272564_110234108
 *
 */
function create_coupon_link($activity_id, $goods_id, $pid = ''){
  $url = 'https://uland.taobao.com/coupon/edetail?';
  $pid = $pid && $pid !='' ? $pid : config('site_pid');
  $url.= 'activityId='.$activity_id.'&itemId='.$goods_id.'&pid='.$pid;
  
  return $url;
}

function fixAmps(&$html, $offset) {
  $positionAmp = strpos($html, '&', $offset);
  $positionSemiColumn = strpos($html, ';', $positionAmp+1);
  
  $string = substr($html, $positionAmp, $positionSemiColumn-$positionAmp+1);
  
  if ($positionAmp !== false) { // If an '&' can be found.
    if ($positionSemiColumn === false) { // If no ';' can be found.
      $html = substr_replace($html, '&amp;', $positionAmp, 1); // Replace straight away.
    } else if (preg_match('/&(#[0-9]+|[A-Z|a-z|0-9]+);/', $string) === 0) { // If a standard escape cannot be found.
      $html = substr_replace($html, '&amp;', $positionAmp, 1); // This mean we need to escapa the '&' sign.
      fixAmps($html, $positionAmp+5); // Recursive call from the new position.
    } else {
      fixAmps($html, $positionAmp+1); // Recursive call from the new position.
    }
  }
}

function setInnerHTML($element, $html)
{
  $fragment = $element->ownerDocument->createDocumentFragment();
  $fragment->appendXML($html);
  $clone = $element->cloneNode(); // Get element copy without children
  $clone->appendChild($fragment);
  $element->parentNode->replaceChild($clone, $element);
}
