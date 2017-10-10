<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
  
];*/


use think\Route;
Route::rule('/index/&','index/index/index');
Route::rule('/content/','index/index/content');
Route::rule('/wechat/','api/wechat/index');
Route::rule('/showtkl/','index/index/show_tkl');
Route::rule('/search/','index/dtk/search');
Route::rule('/ajaxSearch/','index/dtk/ajaxSearch');
Route::rule('/by9/','index/dtk/by9');
Route::rule('/home/ajaxNine/','index/dtk/ajaxNine');
Route::rule('/cat/','index/dtk/cat');
Route::rule('/supper_top/','index/index/supper_top');
Route::rule('/hot/','index/dtk/hot');
Route::rule('/xpkajax/','index/index/ajax_xpk');
Route::rule('/xpk_list/','index/index/xpk_list');


