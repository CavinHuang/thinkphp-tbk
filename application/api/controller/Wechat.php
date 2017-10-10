<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/24 0024
 * Time: 上午 11:55
 */

namespace app\api\controller;


use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\News;
use think\Config;
use think\Controller;
use think\Log;

class Wechat extends Controller {
  protected  $easy_app;
  protected  $options;
  protected function _initialize(){
    $this->options = Config::get('weichat_config');
    $this->easy_app     = new Application( $this->options );
  }
  
  /**
   * 微信介入
   *
   * @return   [type]                   [description]
   * @Author   :  slade
   * @DateTime :2017-04-29T16:35:52+080
   */
  public function index () {
    \Think\Log::write('wechat begin', 'error');
    //获得参数 signature nonce token timestamp echostr
    $nonce     = isset($_GET[ 'nonce' ]) ? $_GET[ 'nonce' ] : '';
    $token     = $this->options[ 'token' ];
    $timestamp = isset($_GET[ 'timestamp' ])? $_GET[ 'timestamp' ] : '';
    $echostr   = isset( $_GET[ 'echostr' ] ) ? $_GET[ 'echostr' ] : "";
    $signature = isset($_GET[ 'signature' ]) ? $_GET[ 'signature' ] : '';
    //形成数组，然后按字典序排序
    $array = [];
    $array = [ $nonce, $timestamp, $token ];
    sort( $array );
    //拼接成字符串,sha1加密 ，然后与signature进行校验
    $str = sha1( implode( $array ) );
    if ( $str == $signature && $echostr ) {
      //第一次接入weixin api接口的时候
      echo $echostr;
      exit;
    } else {
      \Think\Log::write('wechat begin', 'error');
      $this->getMsgFromWechat();
    }
  }
  
  /**
   * 接受微信的消息
   *
   * @return   [type]                   [description]
   * @Author   :  slade
   * @DateTime :2017-04-29T17:20:21+080
   */
  public function getMsgFromWechat () {
    // 从项目实例中得到服务端应用实例。
    $server = $this->easy_app->server;
    $server->setMessageHandler( function ( $message ) {
      Log::write('消息'.$message);
      switch ( $message->MsgType ) {
        case 'event':
          $msg = $this->sendEventMsg( $message );
          break;
        case 'text':
          $msg = $this->sendTextMsg( $message->Content );
          //$msg = "亲，公众号正在紧张开发中...敬请期待！";
          break;
        case 'news':
          $msg = $this->sendNewsMsg( $message->Content );
          break;
        case 'image':
          return '收到图片消息';
          break;
        case 'voice':
          return '收到语音消息';
          break;
        case 'video':
          return '收到视频消息';
          break;
        case 'location':
          return '收到坐标消息';
          break;
        case 'link':
          return '收到链接消息';
          break;
        // ... 其它消息
        default:
          return '收到其它消息';
          break;
      }
      \Think\Log::write( '消息' . json_encode( $msg ), 'info' );
      
      return $msg ? $msg : '没有为您找到内容呢';
    } );
    
    $response = $server->serve();
    return $response->send(); // Laravel 里请使用：return $response;
  }
  
  /**
   * 微信事件消息
   * @param    [type]                   $event [description]
   * @return   [type]                   [description]
   * @Author   :  slade
   * @DateTime :2017-05-05T15:04:16+080
   */
  public function sendEventMsg ( $message ) {
    if ( $message->Event == 'subscribe' ) {
      $msg = '欢迎关注乐找券公众号，这里每天聚集最新淘宝优惠券信息！';
    } else if ( strtolower( $message->Event ) == 'click' ) {
      $key = $message->EventKey;
      $msg = $this->sendTextMsg( $key );
    }
    $msg = $msg ? $msg : '没有您要的服务';
    return $msg;
  }
  
  /**
   * 微信文本消息回复
   *
   * @param    [type]                   $content [description]
   *
   * @return   [type]                   [description]
   * @Author   :  slade
   * @DateTime :2017-05-05T15:04:52+080
   */
  public function sendTextMsg ( $content ) {
    $tbkApi = new Index();
    $res = $tbkApi->coupten_list( $content,6,1 );
    Log::write('返回'.json_encode($res, true));
    if(!isset($res->results)){
      return '没有找到您要的内容，请到乐找券官网\n'.WEB_DOMAIN.'查找更多优惠！';
    }
    $list_result = $res->results->tbk_coupon;
    
    $article_news = [];
    foreach ($list_result as $k => $v){
      if($k > 6) break;
      $short_url = $tbkApi->short_url($v->coupon_click_url.'&pid='.Config::get('site_pid'));
      $news = new News([
        'title'       => '[券'.findCounpPrice($v->coupon_info).'元·券后价'.($v->zk_final_price - findCounpPrice($v->coupon_info)).'元]'.$v->title,
        'description' => $v->item_description,
        'url'         => WEB_DOMAIN.'/showtkl.html?title='.$v->title.'&picurl='.$v->pict_url.'&quan='.$short_url.'&numiid='.$v->num_iid,
        'image'       => $v->pict_url,
      ]);
      $article_news[] = $news;
    }
    $article_news[] = new news([
      'title'       => '更多商品点击这里',
      'description' => '',
      'url'         => WEB_DOMAIN,
      'image'       => WEB_DOMAIN.'/static/quan.png',
    ]);
    L('查看发送数据'.json_encode($article_news));
    return empty($article_news) ? '没有找到您要的内容，请到乐找券官网/n'.WEB_DOMAIN : $article_news;
  }
  
  /**
   * 图文回复
   *
   * @param    [type]                   $content [description]
   *
   * @return   [type]                   [description]
   * @Author   :  slade
   * @DateTime :2017-05-05T15:29:03+080
   */
  public function sendNewsMsg ( $content ) {
    $msg = '';
    return $msg ? $msg : '找不到你要的内容！';
  }
  
}
