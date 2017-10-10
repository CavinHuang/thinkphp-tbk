<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/24 0024
 * Time: 上午 10:35
 */
namespace app\api\controller;

use app\common\model\Goods;
use TbkApi\top\domain\GenPwdIsvParamDto;
use TbkApi\top\domain\TbkSpreadRequest;
use TbkApi\top\request\TbkDgItemCouponGetRequest;
use TbkApi\top\request\TbkItemInfoGetRequest;
use TbkApi\top\request\TbkSpreadGetRequest;
use TbkApi\top\request\TbkUatmFavoritesGetRequest;
use TbkApi\top\request\TbkUatmFavoritesItemGetRequest;
use TbkApi\top\request\WirelessShareTpwdCreateRequest;
use TbkApi\top\TopClient;
use TbkApi\TopSdk;
use think\Config;
use think\Controller;

class Index extends Controller {
  protected $tbk;
  protected function _initialize (){
    // 初始化
    $this->tbk = new TopSdk();
    $this->tbk->index();
  }
  
  /**
   * 列表
   * @author: slide
   *
   */
  public function coupten_list($keyword = '', $pageSize=15, $page = 1){
    L('pageSize'.$pageSize.'page'.$page);
    $c = new TopClient();
    $c->appkey = Config::get('appkey');
    $c->secretKey = Config::get('secretkey');
    $req = new TbkDgItemCouponGetRequest();
    $req->setAdzoneId(Config::get('adzoneid'));
    $req->setPlatform("1");
    $req->setPageSize($pageSize);
    $req->setQ($keyword);
    $req->setPageNo($page);
    $resp = $c->execute($req);
     L('数据'.json_encode($resp, true));
    if(isset($resp->error_response)){
      return json(['code'=>4000, 'msg'=> '接口返回错误,'.$resp->sub_msg]);
    }else{
      return $resp;
    }
  }
  
  /**
   * 生成淘口令
   * @author: slide
   *
   * @param string $logo 商品logo
   * @param string $url 链接
   * @param string $text
   * @param        $ext
   *
   * @return mixed|\SimpleXMLElement|\TbkApi\top\ResultSet|\think\response\Json
   *
   */
  public function create_tkl($logo = '', $url = '', $text = '超值活动，惊喜活动多多', $ext='', $json=false){
    // 淘口令
    $c = new TopClient;
    $c->appkey = '24334432';
    $c->secretKey = '226def48abfdd4203014b6da853fa1a8';
    $req = new WirelessShareTpwdCreateRequest();
    $tpwd_param = new GenPwdIsvParamDto();
    $tpwd_param->ext=$ext;
    $tpwd_param->logo=$logo;
    $tpwd_param->url=$url;
    $tpwd_param->text=$text;
    $tpwd_param->user_id="1604410069";
    $req->setTpwdParam(json_encode($tpwd_param));
    $resp = $c->execute($req);
    if(isset($resp->error_response)){
      return $json ? json(['code'=>4000, 'msg'=> '接口返回错误,'.$resp->sub_msg]) : ['code'=>4000, 'msg'=> '接口返回错误,'.$resp->sub_msg];
    }else{
      return $json ? json($resp) : $resp;
    }
    
  }
  
  /**
   * 商品信息
   * @author: slide
   *
   * @param $id
   *
   * @return array|mixed|\SimpleXMLElement|\TbkApi\top\ResultSet
   *
   */
  public function getGoodsInfo($id){
  
    $c = new TopClient();
    $c->appkey = Config::get('appkey');
    $c->secretKey = Config::get('secretkey');
    $req = new TbkItemInfoGetRequest;
    $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url");
    $req->setPlatform("1");
    $req->setNumIids($id);
    $resp = $c->execute($req);
   
    if(isset($resp->error_response)){
      return ['code'=>4000, 'msg'=> '接口返回错误,'.$resp->sub_msg];
    }else{
      return $resp;
    }
  }
  
  /**
   * 大淘客全站api
   * @author: slide
   *
   */
  public function dtkList($page = 1, $json=false){
    $url = 'http://api.dataoke.com/index.php?r=goodsLink/www&type=total&appkey=utm46ycob4&v=2&page='.$page;
    $listres = httpRequest($url);
    
    // 检测并入库
    $goodMdl = new Goods();
    
    
    //dump($listres);
    return $json ? json(['status'=>0, 'data'=>json_decode($listres)->result]) : $listres;
  }
  
  /**
   * 网站api
   * @author: slide
   *
   * @param $page
   *
   */
  public function dtkWbquan($page){
    $url = 'http://api.dataoke.com/index.php?r=goodsLink/www&type=www_quan&appkey=utm46ycob4&v=2&page='.$page;
    $listres = httpRequest($url);
    
    
    
    return $listres;
  }
  
  /**
   * 大淘客单品
   * @author: slide
   *
   */
  public function dtkOnegoods($id){
    $url = 'http://api.dataoke.com/index.php?r=port/index&appkey=utm46ycob4&v=2&id='.$id;
    $listres = httpRequest($url);
  
    return $listres;
  }
  
  /**
   * top100
   * @author: slide
   *
   */
  public function dtkTop100($page){
    $url = 'http://api.dataoke.com/index.php?r=Port/index&type=paoliang&appkey=utm46ycob4&v=2&page='.$page;
    $listres = httpRequest($url);
  
    return $listres;
  }
  
  /**
   * 短连接
   * @author: slide
   *
   * @param $url
   *
   */
  public function short_url($url){
    $c = new TopClient();
    $c->appkey = Config::get('appkey');
    $c->secretKey = Config::get('secretkey');
    $req = new TbkSpreadGetRequest();
    $requests = new TbkSpreadRequest();
    $requests->url=$url;
    $req->setRequests(json_encode($requests));
    $resp = $c->execute($req);
    if(isset($resp->error_response)){
      return;
    }
    //dump($resp->results->tbk_spread[0]->content);exit;
    return $resp->results->tbk_spread[0]->content;
  }
  
  /**
   * @author: slide
   *
   * @param int $page
   * @param int $pageSize
   *
   * @return mixed|\SimpleXMLElement|\TbkApi\top\ResultSet|\think\response\Json
   *
   */
  public function xpk($favoritId, $page = 1, $pageSize=12){
//    dump($favoritId);
    $c = new TopClient;
    $c->appkey = '24334432';
    $c->secretKey = '226def48abfdd4203014b6da853fa1a8';
    $req = new TbkUatmFavoritesItemGetRequest;
    $req->setPlatform(2);
    $req->setPageSize($pageSize);
    $req->setAdzoneId("110010612");
    $req->setUnid("3456");
    $req->setFavoritesId($favoritId);
    $req->setPageNo($page);
    $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick,shop_title,zk_final_price_wap,event_start_time,event_end_time,tk_rate,status,type,coupon_click_url,coupon_end_time,coupon_info,coupon_start_time,coupon_total_count,coupon_remain_count");
    $resp = $c->execute($req);
    if(isset($resp->error_response)){
      return json(['code'=> 4000, 'msg'=>'失败']);
    }else{
//       dump($resp);
      return $resp;
    }
  }
  
  /**
   * 选聘库
   * @author: slide
   * @return mixed|\SimpleXMLElement|\TbkApi\top\ResultSet|\think\response\Json
   *
   */
  public function xpk_list(){
    $c = new TopClient;
    $c->appkey = '24334432';
    $c->secretKey = '226def48abfdd4203014b6da853fa1a8';
    $req = new TbkUatmFavoritesGetRequest();
    $req->setPageNo("1");
    $req->setPageSize("20");
    $req->setFields("favorites_title,favorites_id,type");
    $req->setType("-1");
    $resp = $c->execute($req);
  
    if(isset($resp->error_response)){
      return json(['code'=> 4000, 'msg'=>'失败']);
    }else{
       //dump($resp);
      return $resp;
    }
  }
}
