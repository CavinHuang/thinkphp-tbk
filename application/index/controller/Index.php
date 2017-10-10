<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22 0022
 * Time: 下午 4:21
 */

namespace app\index\controller;

use TbkApi\top\domain\GenPwdIsvParamDto;
use TbkApi\top\request\WirelessShareTpwdCreateRequest;
use TbkApi\top\TopClient;
use TbkApi\TopSdk;
use think\Controller;
use app\api\controller\Index as ApiIndex;

class Index extends Controller {
  protected $xpk_id = 0;
  protected $xpk_arr = [];
  protected function _initialize(){
    $this->xpk_id = '6469442';
  }
  public function index () {
    $tbk = new ApiIndex();
    $listres = $tbk->dtkList(1);
    //dump($listres);
    $result = json_decode($listres, true);
//    print_r($result['data']);
    $res = $result['result'];
//    dump($res);exit;
    // banner
    $banner = $tbk->dtkWbquan(1);
    $banner_res = json_decode($banner, true)['data']['result'];
    $banner_arr = [];
    foreach ($banner_res as $key => $v){
      if($key > create_rand(2, 6)) break;
      $banner_arr[]= $v;
    }
    //dump($banner_arr);exit;
    $this->assign('banner',$banner_arr);
    $this->assign('total', $result['data']['total_num']);
    $this->assign('result', $res);
    return $this->fetch();
  }
  
  public function content(){
    $id = input('id');
    $url = 'http://api.dataoke.com/index.php?r=port/index&appkey=utm46ycob4&v=2&id='.$id;
    $detail_res = httpRequest($url);
    $detail_res = json_decode($detail_res, true);
    //dump($detail_res);
    $detail_res = $detail_res['result'];
    
    // 淘口令
    $tbk = new TopSdk();
    $tbk->index();
    $c = new TopClient;
    $c->appkey = '24334432';
    $c->secretKey = '226def48abfdd4203014b6da853fa1a8';
    $req = new WirelessShareTpwdCreateRequest();
    $tpwd_param = new GenPwdIsvParamDto();
    $tpwd_param->ext="{\"test\":\"test\"}";
    $tpwd_param->logo=$detail_res['Pic'];
    $tpwd_param->url=create_coupon_link($detail_res['Quan_id'],$detail_res['GoodsID'],config('site_pid'));
    $tpwd_param->text=$detail_res['Title'];
    $tpwd_param->user_id="1604410069";
    $req->setTpwdParam(json_encode($tpwd_param));
    $resp = $c->execute($req);
//    dump($resp);exit;
    // 精品
    $jinpin_url = 'http://api.dataoke.com/index.php?r=Port/index&type=top100&appkey=utm46ycob4&v=2';
    $j_detail_res = httpRequest($jinpin_url);
    $j_detail_res = json_decode($j_detail_res, true)['result'];
    
    $list = [];
    $start = create_rand(1, 94);
    for($i=$start; $i< $start + 6; $i++){
      $list[] = $j_detail_res[$i];
    }
    $this->assign('list', $list);
    $this->assign('detail', $detail_res);
    $this->assign('tkl', $resp->model);
    return $this->fetch();
  }
  
  /**
   * 展示套口林
   * @author: slide
   *
   */
  public function show_tkl(){
    // 精品
    $jinpin_url = 'http://api.dataoke.com/index.php?r=Port/index&type=top100&appkey=utm46ycob4&v=2';
    $j_detail_res = httpRequest($jinpin_url);
    $j_detail_res = json_decode($j_detail_res, true)['result'];
    //dump($j_detail_res);exit;
    $list = [];
    $start = create_rand(1, 94);
    for($i=$start; $i< $start + 6; $i++){
      $list[] = $j_detail_res[$i];
    }
//    // 部分详情 不包括 优惠券信息
    $resp = new \app\api\controller\Index();
//    $goods_id = input('gid');
//
//    $goods_detail = $resp->dtkOnegoods($goods_id);
//    $result = json_decode($goods_detail)->result;
//
//    //dump(create_coupon_link($result->Quan_link,$result->GoodsID, Config::get('site_pid')));
//    //dump($result);exit;
//
//    $logo = $result->Pic;
//    $url = create_coupon_link($result->Quan_link,$result->GoodsID, Config::get('site_pid'));
//    $text = $result->Title;
    $res = $resp->create_tkl(input('picurl'), input('quan'),input('title'));
    if(isset($res->code)){
      $kl = '淘口令制作失败';
    }else{
      $kl = $res->model;
    }
    $this->assign('list', $list);
    $this->assign('title', input('title'));
    $this->assign('goods_id', input('numiid'));
    $this->assign('tkl', $kl);
    return $this->fetch();
  }
  
  /**
   * 搜索
   * @author: slide
   *
   */
  public function search_goods(){
    
    return $this->fetch();
  }
  
  /**
   * top 100
   * @author: slide
   *
   */
  public function supper_top($page = 1){
    $tbk = new \app\api\controller\Index();
    $res = $tbk->dtkTop100($page);
//    dump(json_decode($res, true));
    
    return $this->fetch('supper_top', ['list'=>json_decode($res, true)]);
  }
  
  public function customService(){
    return $this->fetch();
  }
  
  public function xpk_list(){
    $tbk = new \app\api\controller\Index();
    $xpk_id = input('xpk_id') ? input('xpk_id') : $this->xpk_id;
      $res = $tbk->xpk($xpk_id);
     if(isset($res->code)) {
       $result = false;
     }else{
       $result = $res->results->uatm_tbk_item;
     };
    
    // xpk
    $xpk = $tbk->xpk_list();
    $this->assign('list', $result);
    $this->assign('xpk',$xpk->results->tbk_favorites );
    $this->assign('xpk_id',$xpk_id);
    return $this->fetch();
  }
  
  public function ajax_xpk(){
    $tbk = new \app\api\controller\Index();
    $page = input('page') ? input('page') : 2;
    $pageSize = 15;
    // xpk
    $res = $tbk->xpk(input('xpk_id'), $page = $page, $pageSize=$pageSize);
    
    if(isset($res->code)) {
      $data = [
        'status' => 1,
        'msg' => '出错了'
      ];
    } else {
      $data = [
        'status' => 0,
        'data' => json_decode(json_encode($result = $res->results->uatm_tbk_item), true)
      ];
    }
    return json($data);
  }
}
