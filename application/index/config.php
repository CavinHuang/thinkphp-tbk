<?php

// $admin_config = [];

// $html_config = include_once 'html.conf.php';
// return array_merge($admin_config,$html_config);
//
return [
 	'template'=>[
	 	// 模板路径
    'view_path'    => '../thems/default/',
	],
  'view_replace_str'  =>  [
      '__PUBLIC__'=>'/public',
      '__HOME_STATIC__' => '/default/static',
      '__ROOT__'=>''
  ],
  'dispatch_success_tmpl'  =>'public/dispatch_jump.tpl',
  'dispatch_error_tmpl'    => 'public/dispatch_jump.tpl',
];
