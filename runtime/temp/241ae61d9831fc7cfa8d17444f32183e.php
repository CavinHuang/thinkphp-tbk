<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:38:"../thems/default/index/supper_top.html";i:1498743558;}*/ ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-dns-prefetch-control" content="on"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta content="telephone=no" name="format-detection"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
	<title>超级人气榜--乐找券</title>
	<meta name="Keywords" content="乐找券,淘宝优惠券,天天打折联盟,优惠券折扣,9块9包邮,限时特卖,优品折扣,天天领券"/>
	<meta name="Description" content="乐找券-优惠券折扣直播第一站！每天更新千款，纯人工筛选验货，限时限量特卖，全场1折包邮！"/>
	<script src="__HOME_STATIC__/js/jquery.2.0.min.js?v=2017062261726" ></script>
	<link href="__HOME_STATIC__/css/wap_common.css?v=2017062261726" rel="stylesheet">
	<!-- 视频 S -->
	<link href="__HOME_STATIC__/css/wap-video.css?v=2017062261726" rel="stylesheet">
	<!-- 视频 E -->
	<link href="__HOME_STATIC__/css/wapcat.css?v=2017062261726" rel="stylesheet"/>
	<script src="__HOME_STATIC__/js/lazyload.js?v=2017062261726" ></script>
<style>
	html {
		background: none
	}
</style>
<body>
<style>
	.category{
		height: 140px !important;
		margin-top: 5px; !important;
		margin-bottom: 5px; !important;
		padding-left: 5px; !important;
		padding-right: 5px; !important;
		padding-bottom: 5px; !important;
	}
	.you-wrapper
	{
		height: 40px !important;
		padding-top: 2px; !important;
		border-bottom-width: 20px; !important;
		padding-bottom: 6px; !important;
		
	}
	.title-wrapper{
		height: 18px; !important;
		margin-top: 2px; !important;
		padding-top: 2px; !important;
		padding-bottom: 2px; !important;
		
	}
	.shoufa-wrapper{
		margin-bottom: 0px; !important;
	}
	.shoufa-list{
		height: 152px !important;
	}
	.shoufa-tit{
		height: 18px !important;
	}
	.shoufa-img{
		height: 18px !important;
		width: 55px !important;
	}
	.release-list ul{
		padding-left: 1px; !important;
	}
	.release-time li a span,
	.release-time li a p {
		height: 18px; !important;
	}
	
	
	.menu {
		width: 100%;
		position: absolute;
		position: fixed;
		bottom: 0;
		background: #fff;
		border-top: .1rem solid #F3E7E3;
		z-index: 999;
	}
	
	.menu img {
		width: 1.5rem;
		height: 1.5rem;
		margin-bottom: .2rem;
	}
	
	.menu a {
		display: inline-block;
		color: #3d0505;
	}
	
	.menu a span {
		font-size: 1.2rem;
	}
	
	:before,
	:after {
		box-sizing: content-box;
		-webkit-box-sizing: content-box;
	}
	ul,
	p {
		padding:0px;
		margin: 0px;
	}
</style>
<script type="text/javascript">
    var urlstr = location.href;
    //alert(urlstr);  
    var urlstatus = false;
    $(".menu a").each(function() {
        if ((urlstr + '/').indexOf($(this).attr('href')) > -1 && $(this).attr('href') != '') {
            $(this).find("span").addClass('am-text-danger');
            urlstatus = true;
        } else {
            $(this).find("span").removeClass('am-text-danger');
        }
    });
    if (!urlstatus) {
        $(".menu span").eq(0).addClass('am-text-danger');
    }
</script>
<div class="main-title clearfix">
	<a href="javascript:void(0)" class="main-back"></a>
	<div class="menu-detail">
		<span>超级人气榜</span>
	</div>
	<a class="mui-action-menu main-home" href="/index.html"></a>
</div>

<!-- 主界面具体展示内容 -->
<style>
	.you-wrapper {
		border: 0;
		margin-top: 50px;
		width: 100%;
		background-color: #fff;
		border-top: 1px solid #dddddd;
		border-bottom: 1px solid #dddddd;
	}
	.you-wrapper .title-wrapper {
		padding: 0.2em 0.2em 0.2em 0.7em;
	}
	.you-wrapper .title-wrapper .text {
		color: #363535;
		border-left: 0.2em solid #ed145b;
		line-height: 1.4em;
		margin: 0.4em 0;
		padding-left: 0.5em;
		font-weight: bolder;
		position: relative;
	}
	.you-wrapper .title-wrapper .text .index {
		display: block;
		padding-top: 2px;
		line-height: 24px;
	}
	.you-wrapper .title-wrapper .main-badge {
		background-color: #7ad3c1;
		font-weight: normal;
		position: absolute;
		left: 139px;
		top: 3px;
	}
</style>
<div class="you-wrapper">
	<div class="title-wrapper">
		<div class="text">TOP100销量榜&nbsp;-&nbsp;实时更新&nbsp;随时关注</div>
	</div>
</div>
<div class="goods-list">
	<?php if(is_array($list['result']) || $list['result'] instanceof \think\Collection || $list['result'] instanceof \think\Paginator): $i = 0; $__LIST__ = $list['result'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
	<div class="goods-item">
		<a href="/content.html?id=<?php echo $l['GoodsID']; ?>" class="img">
			<span class="coupon-wrapper">券 <i>￥</i><b><?php echo $l['Quan_price']; ?></b></span>                <span class="today-wrapper"><b>TOP  <?php echo $i; ?></b></span>
			<img class="lazy" src="images/rolling.gif"
			     data-original="<?php echo $l['Pic']; ?>" alt="" />
		</a>
		<a href="/content.html?id=<?php echo $l['GoodsID']; ?>" class="title">
			<div class="text" style=" color:#777777;"><?php echo $l['Title']; ?></div>
		</a>
		<div class="price-wrapper">
			<span class="text">券后</span>
			<span class="price">￥<?php echo $l['Price']; ?></span>
			<div class="sold-wrapper">
				<span class="text">近2小时销量</span>
				<span class="sold-num"><?php echo $l['Sales_num']; ?></span>
			</div>
		</div>
	</div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<div class="toTop">&#xe601;</div>
<script src="http://cmsstatic.dataoke.com/web/js/cms_common.js?v=2017062261726"></script>
<div style="display: none;">
	<script type="text/javascript">
      (function(win,doc){
          var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
          if (!win.alimamatk_show) {
              s.charset = "gbk";
              s.async = true;
              s.src = "https://alimama.alicdn.com/tkapi.js";
              h.insertBefore(s, h.firstChild);
          };
          var o = {
              pid: "mm_112972830_29272564_110234108",/*推广单元ID，用于区分不同的推广渠道*/
              appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/
              unid: "",/*自定义统计字段*/
              type: "click" /* click 组件的入口标志 （使用click组件必设）*/
          };
          win.alimamatk_onload = win.alimamatk_onload || [];
          win.alimamatk_onload.push(o);
      })(window,document);
      $("img.lazy").lazyload();
	</script>                    </div>
<script type="text/javascript" src="http://counter.dataoke.com/js/dtk.js?t=5&amp;u=662050&amp;pv=888888" id="counterJs"></script>
</body>
</html>
