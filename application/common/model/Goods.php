<?php

namespace app\common\model;

use think\Model;

class Goods extends Model
{
  protected $createTime = 'createtime';
  protected $insert = ['createtime'];
  
  //自定义初始化
  protected function initialize()
  {
    //需要调用`Model`的`initialize`方法
    parent::initialize();
  }
  
  /**
   * 创建时间
   * @return bool|string
   */
  protected function setCreatetimeAttr() {
    return time();
  }
 
  
}
