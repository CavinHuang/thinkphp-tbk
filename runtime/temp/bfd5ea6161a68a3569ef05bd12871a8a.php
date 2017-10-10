<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:35:"../thems/default/index/content.html";i:1498744868;}*/ ?>


<html><head>
	<meta charset="utf-8">
	<meta http-equiv="x-dns-prefetch-control" content="on">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta content="telephone=no" name="format-detection">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<title><?php echo $detail['Title']; ?>-乐找券</title>
	<meta name="Keywords" content="乐找券,优惠券折扣,9块9包邮,限时特卖,优品折扣,大话福利">
	<meta name="Description" content="优惠券折扣直播第一站！每天更新千款，纯人工筛选验货，限时限量特卖，全场1折包邮！">
	<script src="__HOME_STATIC__/js/jquery.2.0.min.js?v=201704271010"></script>
	<link href="__HOME_STATIC__/css/wap_common.css?v=201704271010" rel="stylesheet">
	<link href="__HOME_STATIC__/css/wapshow.css?v=201704271010" rel="stylesheet">
</head>
<body>
<div class="main-title clearfix" style="position: fixed; top: 0px;">
	<a href="javascript:void(0)" class="main-back"></a>
	<!--    <div class="menu-detail">商品详情</div>-->
	<a class="mui-action-menu main-more" href="javascript:void(0)" id="mui-action-menu"></a>
</div>
<nav id="detail-top-menu">
	<div class="arrow"></div>
	<div class="mask show" id="menu-mask"></div>
	<div class="detail-menu-content">
		<ul class="main-detail">
			<li>
				<a href="/index.html?u=">首页</a>
			</li>
			<li>
				<a href="/index/index/search_goods.html?u=">搜索/分类</a>
			</li>
			<li>
				<a href="/index/index/customService.html?u=">客服</a>
			</li>
			<!--<li>-->
			<!--<a href="#">分享</a>-->
			<!--</li>-->
		</ul>
	</div>
</nav>
<!-- 主界面具体展示内容 -->
<div class="detail-wrapper img">
	<a href="<?php echo $detail['Quan_link']; ?>" class="ui-link">
		
		<div class="img">
			
			<img src="<?php echo $detail['Pic']; ?>">
		</div>
		<div class="title-wrapper clearfix">
			<!-- 咚咚抢 -->
			<span class="taobao"></span>
			<?php echo $detail['Title']; ?></div>
	</a>
	
	<div class="recommend-wrapper">
		<div class="text">
			<span>小编推荐：</span><?php echo $detail['Introduce']; ?>             </div>
	</div>
	
	<!-- 咚咚抢 -->
	
	<div class="goods-jq clearfix">
		<div style="margin-right: 6px;"><b>原价<i>￥</i><span style="text-decoration:line-through"><?php echo $detail['Org_Price']; ?></span></b></div>
		<div class="goods-price fl"><b><i>￥</i><?php echo $detail['Price']; ?> </b>券后价</div>
		<div class="goods-quan shoufa-quan fl"><span>券</span><b><i>￥</i><?php echo $detail['Quan_price']; ?></b></div>
		<div class="goods-num fr">
			<i></i><b><?php echo $detail['Sales_num']; ?></b> 人已买
		</div>
	
	</div>
	
	<eq class="goods-tag" style="clear:both;">
		<eq name="detail.IsTmall" value="1"><span>天猫</span></eq>
		<!--<span>新品</span>-->
		<!--<span>包邮</span>-->
		<!-- 咚咚抢 -->
	
	</div>
</div>

<div class="tuwen-tkl">
	<!-- $this->isIOS==2 表示微信端-->
	<script src="http://cmsstatic.dataoke.com//web/js/clipboard.min.js?v=201704271010"></script>
	<div class="tkl" style="display: block;">
		<div class="tkl-code">
			<div class="code"><span id="code1_ios" style="display: inline;"><?php echo $tkl; ?></span></div>
			<textarea onfocus="iptNum(this, true);" oninput="iptNum(this, false);" style="display: none;"><?php echo $tkl; ?></textarea>
		</div>
		<p class="tkl-desp">长按复制上方淘口令，打开手机淘宝购买</p>
	</div>
	
	<div class="pic-detail">
		<div class="pic-detail-btn" data-goodsid="<?php echo $detail['GoodsID']; ?>">
			<span class="pic-detail-btn-span">查看图文详情<i></i></span>
		</div>
		<div class="pic-detail-show"></div>
		<span class="loadding-lab">加载中，请稍后……</span>
	</div>

</div>

<div class="weixin-tip" style="display: none;">
	<div class="wechat-line"></div>
	<div class="wechat-brow iosChat"></div>
	<div class="tkl-layer">
		<div class="mid-txt"><span>或</span></div>
		<div class="tkl-code">
			<div class="code"><span id="code2_ios" style="display: inline;"><?php echo $tkl; ?></span></div>
			<textarea onfocus="iptNum(this, true);" oninput="iptNum(this, false);" style="display: none;"><?php echo $tkl; ?></textarea>
		</div>
		<p>长按复制上方淘口令，打开手机淘宝购买</p>
	</div>
</div>
<script>
    //判断是安卓还是苹果
    function isIOS() {
        var ua = navigator.userAgent.toLowerCase();
        if (/iphone|ipad|ipod/.test(ua)) {
            return true;
        } else if (/android/.test(ua)) {
            return false;
        }
    }

    //文字输入
    function iptNum(ths, sta) {
        if (sta) {
            taoKeyNum = ths.value;
        }
        if (ths.value != taoKeyNum) {
            ths.value = taoKeyNum;
        }
    }

    if (isIOS()) {
        $(".detail-mask-command-ios").show();
        $('.tkl-code .code').show();
        $('.tkl-code textarea').hide();
    } else {
        $(".detail-mask-command-android").hide();
        $('.tkl-code .code').hide();
        $('.tkl-code textarea').show();
    }
    document.addEventListener("selectionchange", function (e) {
        if (window.getSelection().anchorNode.parentNode.id == 'code1_ios' && document.getElementById('code1_ios').innerText != window.getSelection()) {
            var key = document.getElementById('code1_ios');
            window.getSelection().selectAllChildren(key);
        }
        if (window.getSelection().anchorNode.parentNode.id == 'code2_ios' && document.getElementById('code2_ios').innerText != window.getSelection()) {
            var key = document.getElementById('code2_ios');
            window.getSelection().selectAllChildren(key);
        }
    }, false);

    //苹果安卓复制文案
    document.addEventListener("selectionchange", function (e) {
        if (window.getSelection().anchorNode.parentNode.id == 'code1_ios' && document.getElementById('code1_ios').innerText != window.getSelection()) {
            var key = document.getElementById('code1_ios');
            window.getSelection().selectAllChildren(key);
        }
        if (window.getSelection().anchorNode.parentNode.id == 'code2_ios' && document.getElementById('code2_ios').innerText != window.getSelection()) {
            var key = document.getElementById('code2_ios');
            window.getSelection().selectAllChildren(key);
        }
    }, false);
</script>
<div class="pos-box clearfix">
	<div class="pos-title">
		<p><i></i>精品推荐<b></b></p>
	</div>
	<div class="ads-list" data-page="0">
		
		<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
		<!--goods item start-->
		<div class="goods-item">
			<a href="content.html?u=&id=<?php echo $l['GoodsID']; ?>" class="img" >
            <span class="today-wrapper">
            <span>小编</span><span>精选</span>
            </span>
				<span class="coupon-wrapper">
            <span class="coupon" style="color: #EDFF00;">独家券</span>
            <span class="price"><?php echo $l['Quan_price']; ?>元</span>
        </span>
				<img src="<?php echo $l['Pic']; ?>" alt="">
			</a>
			<a href="content.html?u=&id=<?php echo $l['GoodsID']; ?>" class="title">
				<div class="text" style=" color:#777777;"><?php echo $l['Title']; ?></div>
			</a>
			<div class="price-wrapper">
				<span class="text">券后</span>
				<span class="price">￥<?php echo $l['Price']; ?></span>
				<div class="sold-wrapper">
					<span class="sold-num"><?php echo $l['Sales_num']; ?></span>
					<span class="text">人已买</span>
				</div>
			</div>
		</div>
		<!--goods item end-->
		<?php endforeach; endif; else: echo "" ;endif; ?>
	
	</div>

</div>

<div class="buy-wrapper img" style="padding-right: 0px; display: block;">
	<span class="price">券后价：<i>¥<b style="font-size:22px;"><?php echo $detail['Price']; ?></b></i></span>
	<a href="<?php echo create_coupon_link($detail['Quan_id'], $detail['GoodsID'], config('site_pid')); ?>" class="buy-2he1 ui-link">领券购买&nbsp;&gt;</a>
	<a href="<?php echo create_coupon_link($detail['Quan_id'], $detail['GoodsID'], config('site_pid')); ?>" class="quan-2he1 ui-link">
		优惠券<br><span style="font-size: 15px;color: #ffffff; "><?php echo $detail['Quan_price']; ?>元</span>
	</a>

</div>
<div class="buy-wrapper img" style="padding-right: 0px; display: block;">
	<span class="price">券后价：<i>¥<b style="font-size:22px;"><?php echo $detail['Price']; ?></b></i></span>
	<a href="<?php echo create_coupon_link($detail['Quan_id'], $detail['GoodsID'], config('site_pid')); ?>" class="buy-2he1 ui-link">领券购买&nbsp;&gt;</a>
	<a href="<?php echo create_coupon_link($detail['Quan_id'], $detail['GoodsID'], config('site_pid')); ?>" class="quan-2he1 ui-link">
		优惠券<br><span style="font-size: 15px;color: #ffffff; "><?php echo $detail['Quan_price']; ?>元</span>
	</a>

</div>


<div class="toTop"></div>
<div style="display: none;">
</div>
<script src="__HOME_STATIC__/js/cms_detail.js"></script>
<script src="__HOME_STATIC__/js/cms_common.js?v=201704271010"></script>
<script type="text/javascript" src="__HOME_STATIC__/js/dtk.js?t=5&amp;u=525577&amp;pv=7" id="counterJs"></script>
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
</script>

</body></html>
