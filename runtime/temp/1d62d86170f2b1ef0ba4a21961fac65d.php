<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:33:"../thems/default/index/index.html";i:1500110379;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-dns-prefetch-control" content="on"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta content="telephone=no" name="format-detection"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
	<link rel="apple-touch-icon" href="/apple-touch-icon.png"/>
	<link href="/favicon.ico" rel="shortcut icon"/>
	<link href="/favicon.ico" rel="icon">
	<link href="/favicon.ico" rel="Bookmark"/>
	<title>乐找券-我们的愿望是：带你占尽世界的便宜！</title>
	<meta name="Keywords" content="乐找券,优惠券折扣,9块9包邮,限时特卖,优品折扣"/>
	<meta name="Description" content="乐找券-优惠券折扣直播第一站！每天更新千款，纯人工筛选验货，限时限量特卖，全场1折包邮！"/>
	<link href="__HOME_STATIC__/css/swiper.min.css?v=201704271010" rel="stylesheet">
	<link href="__HOME_STATIC__/css/wap_common.css?v=201704271010" rel="stylesheet">
	<link href="__HOME_STATIC__/css/wapindex.css?v=201704271010" rel="stylesheet"/>
	<script src="__HOME_STATIC__/js/jquery.2.0.min.js?v=201704271010"></script>
	<script src="__HOME_STATIC__/js/swiper.jquery.min.js?v=201704271010"></script>
	<script src="__HOME_STATIC__/js/lazyload.js?v=201704271010"></script>
</head>
<body>
<div class="main-title clearfix">
	<a href="/index.html?u=" class="main-logo fl">
		<!--优先显示图片，图片没有在显示名字-->
		乐找券 </a>
	<div class="search fl">
		<form action="/search.html?u=" method="get">
			<input type="hidden" name="u" value="" style="width: 1688px;">
			<button class="search_submit background"></button>
			<input type="text" placeholder="好宝贝 等你搜" name="kw" class="search_area" autocomplete="off"/>
		</form>
	</div>
	
	
	<a id="mui-action-menu" class="mui-action-menu mui-pull-left main-icon fr" href="javascript:void(0)">
		<span></span>
	</a>
</div>
<!-- 主界面具体展示内容 -->
<div class="index-wrapper">
	<div class="swiper-container" style="width: 100%;">
		<div class="swiper-wrapper">
			<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?>
			<div class="swiper-slide">
				<a href="/content.html?u=&id=<?php echo $b['GoodsID']; ?>">
					<img style="width: 100%;" src="<?php echo $b['Pic']; ?>"/>
				</a>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="swiper-pagination"></div>
	</div>
	<script>
      (function () {
          window.onresize = function () {
              $('.swiper-slide').height($('.swiper-container').width() / 414 * 173);
              $('.swiper-container').height($('.swiper-container').width() / 414 * 173);
          }
          $('.swiper-slide').height($('.swiper-container').width() / 414 * 173);
          $('.swiper-container').height($('.swiper-container').width() / 414 * 173);

      })()
	</script>
	<style>
		.swiper-pagination {
			position: absolute;
			text-align: center;
			-webkit-transition: .3s;
			-moz-transition: .3s;
			-o-transition: .3s;
			transition: .3s;
			-webkit-transform: translate3d(0, 0, 0);
			-ms-transform: translate3d(0, 0, 0);
			-o-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
			z-index: 10
		}
		
		.swiper-pagination-bullet {
			width: 8px;
			height: 8px;
			display: inline-block;
			border-radius: 100%;
			background: rgba(122, 211, 193, 1);
			opacity: 1;
		}
		
		.swiper-pagination-bullet-active {
			width: 6px;
			height: 6px;
			opacity: 1;
			background: #7ad3c1;
			border: #7ad3c1 1px solid;
			opacity: 0.6
		}
		
		.category {
			height: auto;
			background-color: #fff;
			overflow: hidden;
			border-bottom: 1px solid #e5e5e5;
			padding: 10px;
			padding-top: 0px;
		}
		
		.category li {
			width: 20%;
			float: left;
			margin: 5px 0;
		}
		
		.category li span {
			width: 40px;
			height: 40px;
			display: block;
			margin: 0 auto;
		}
		
		.category li span img {
			width: 40px;
			height: 40px;
		}
		
		.category li strong {
			font-weight: 400;
			display: block;
			text-align: center;
			padding-top: 5px;
			font-size: 12px;
		}
		
		.category li a {
			color: black;
		}
		
		.shoufa-wrapper .title-wrapper .shoufa-tit .shoufa-img {
			width: 56px;
			height: 18px;
		}
		
		.shoufa-wrapper .title-wrapper .shoufa-tit {
			height: 16px;
		}
		
		
	</style>
	<div class="icon-link-wrapper">
		<ul class="icon-url-list clearfix">
			<li class="icon-99by">
				<a href="by9.html?u=">
					<i></i>
					<span>9.9包邮</span>
				</a>
			</li>
			<li class="icon-rqb">
				<a href="/supper_top.html?u=">
					<i></i>
					<span>超级人气榜</span>
				</a>
			</li>
			
			<li class="icon-jpsf">
				<a href="/hot.html?u=">
					<i></i>
					<span>小编力荐</span>
				</a>
			</li>
			<li class="icon-jingxuan">
				<a href="/xpk_list.html?u=">
					<i></i>
					<span>精选商品库</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<ul class="category">
	
	<li><a href="/cat.html?cid=1"><span><img src="__HOME_STATIC__/images/cat/1.png" alt="女装"></span><strong>女装</strong></a></li>
	<li><a href="/cat.html?cid=9"><span><img src="__HOME_STATIC__/images/cat/2.png" alt="男装"></span><strong>男装</strong></a>
	</li>
	<li><a href="/cat.html?cid=10"><span><img src="__HOME_STATIC__/images/cat/4.png" alt="内衣"></span><strong>内衣</strong></a>
	</li>
	<li><a href="/cat.html?cid=2"><span><img src="__HOME_STATIC__/images/cat/5.png" alt="母婴"></span><strong>母婴</strong></a>
	</li>
	<li><a href="/cat.html?cid=3"><span><img src="__HOME_STATIC__/images/cat/6.png" alt="化妆品"></span><strong>化妆品</strong></a>
	</li>
	<li><a href="/cat.html?cid=4"><span><img src="__HOME_STATIC__/images/cat/7.png" alt="居家"></span><strong>居家</strong></a>
	</li>
	<li><a href="/cat.html?cid=5"><span><img src="__HOME_STATIC__/images/cat/3.png" alt="鞋包配饰"></span><strong>鞋包配饰</strong></a>
	</li>
	<li><a href="/cat.html?cid=6"><span><img src="__HOME_STATIC__/images/cat/8.png" alt="美食"></span><strong>美食</strong></a>
	</li>
	<li><a href="/cat.html?cid=7"><span><img src="__HOME_STATIC__/images/cat/9.png" alt="文体车品"></span><strong>文体车品</strong></a>
	</li>
	<li><a href="/cat.html?cid=8"><span><img src="__HOME_STATIC__/images/cat/10.png" alt="数码家电"></span><strong>数码家电</strong></a>
	</li>

</ul>
<div class="you-wrapper clearfix">
	<div class="title-wrapper fl"></div>
	<div class="text fl">
		<span class="mui-badge mui-badge-blue main-badge"><?php echo $total; ?></span>
	</div>
</div>
<div class="goods-list" data-page="2">
	<?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($i % 2 );++$i;?>
	<!--goods item start-->
	<div class="goods-item">
		<a href="/content.html?u=&id=<?php echo $res['GoodsID']; ?>" class="img"><span class="today-wrapper"> <span>今日</span><span>新品</span>  </span>
			<span class="coupon-wrapper">
            <span class="coupon" style="color: #EDFF00;">独家券</span>
            <span class="price"><?php echo $res['Quan_price']; ?>元</span>
        </span>
			
			<img class="lazy" src="images/rolling.gif"
			     data-original="<?php echo $res['Pic']; ?>" alt="" />
		</a>
		<a href="/content.html?u=&id=<?php echo $res['GoodsID']; ?>" class="title">
			<div class="text" style=" color:#777777;"><?php echo $res['D_title']; ?></div>
		</a>
		<div class="price-wrapper">
			<span class="text">券后</span>
			<span class="price">￥<?php echo $res['Price']; ?></span>
			<div class="sold-wrapper">
				<span class="sold-num"><?php echo $res['Sales_num']; ?></span>
				<span class="text">人已买</span>
			</div>
		</div>
	</div>
	<!--goods item end-->
	<?php endforeach; endif; else: echo "" ;endif; ?>
</div>


<div class="pullup-goods">
	<div class="label">商品加载中...</div>
</div>
<script language="javascript">
    if (window.history.state) {
        $('.goods-list').html(window.history.state.list);
        var page = window.history.state.page;
    } else {
        var page = 2;
    }

    var isFinish = false;
    var isLoading = false;
    var $pullUp = null;
    var needLoadMore = false;
    var maxScrollY = 0;
    var windowHeight = 0;
    var uid = '';
    $(document).ready(function () {

        var mySwiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            loop: true,
            autoplay: 2500
        });

        maxScrollY = $(document).height();
        windowHeight = $(window).height();
        $(window).on('resize', function () {
            windowHeight = $(window).height();
        });
        $(window).scroll(function (e) {
            if (isFinish || isLoading) {
                return;
            }
            var y = $(document).scrollTop();
            maxScrollY = $(document).height();
            windowHeight = $(window).height();
            if (Math.abs(maxScrollY - windowHeight - y) > 100) {
                return;
            }
            var $wrapper = $(this);
            if (!$pullUp) {
                $pullUp = $wrapper.find('.pullup-goods');
            }
            var data = null;
            getData($wrapper, data, 1);
        });
        function getData($wrapper, data, direction) {
            if (isFinish) {
                return;
            }
            isLoading = true;
            if (!$pullUp) {
                $pullUp = $wrapper.find('.pullup-goods');
            }
            var labelTag = $($pullUp).find('.label');
            var tPaht = "/api/index/dtkList.html";
            $.ajax(tPaht, {
                data: {r: 'index/ajax', page: page, u: uid, json: true},
                dataType: 'json',
                type: 'get',
                error: function (xhr, type, errorThrown) {
                    getData($wrapper, data, direction);
                },
                success: function (result, status, xhr) {
                    needLoadMore = false;
                    if (result.status == 0) {
                        if (result.data.pageStatus === false) {
                            isLoading = false;
                            $('.pullup-goods .label').html('没有更多商品啦');
                            isFinish = true;
                        }
                        
                        var html = '';
                        for(var i=0; i < result.data.length; i++){
                            var _d = result.data[i]
                            html += '<!--goods item start-->'
		                            +'<div class="goods-item">'
                                +'<a href="/content.html?u=&id='+_d.GoodsID+'" class="img"><span class="today-wrapper"> <span>今日</span><span>新品</span>  </span>'                                +'<span class="coupon-wrapper">'
                                +'<span class="coupon" style="color: #EDFF00;">独家券</span>'
                                +'<span class="price">'+_d.Quan_price+'元</span>'
                            +'</span>'

                            +'<img class="lazy" src="images/rolling.gif" data-original="'+_d.Pic+'" alt="" />'
                                +'</a>'
				                        +'<a href="/content.html?u=&id='+_d.GoodsID+'" class="title">'
				                        +'<div class="text" style=" color:#777777;">'+_d.D_title+'</div>'
				                        +'</a>'
						                      
                            +'<div class="price-wrapper">'
				                        +'<span class="text">券后</span>'
				                        +'<span class="price">￥'+_d.Quan_price+'</span>'
				                        +'<div class="sold-wrapper">'
				                        +'<span class="sold-num">'+_d.Quan_receive+'</span>'
				                        +'<span class="text">人已买</span>'
				                        +'</div>'
				                        +'</div>'
				                        +'</div>'
				                        +'<!--goods item end-->';
                        }
                        
                        $('.goods-list').append(html);
                        $("img.lazy").lazyload();
                        aClick();
                        maxScrollY = $(document).height();
                        isLoading = false;
                        page++;
                        $('.goods-list').attr('data-page', page);
                    } else {
                        maxScrollY = $(document).height();
                        isLoading = false;
                        $(labelTag).html('没有更多商品啦');
                        isFinish = true;
                    }
                }
            });
        }
    });
    $("img.lazy").lazyload();
</script>

<nav id="show-top-menu">
	<div class="mask" id="menu-mask"></div>
	<div class="menu-content">
		<ul class="main-cat">
			
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=1">女装</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=9">男装</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=10">内衣</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=2">母婴</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=3">化妆品</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=4">居家</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=5">鞋包配饰</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=6">美食</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=7">文体车品</a>
			</li>
			
			<li class="cat-item">
				<a rel="external" href="/cat.html?cid=8">数码家电</a>
			</li>
		
		
		</ul>
		<span class="up-menu">收起分类</span>
	</div>
</nav>
<div class="toTop">&#xe601;</div>
<div style="display: none;">
</div>
<script src="__HOME_STATIC__/js/cms_common.js?v=201704271010"></script>
<script type="text/javascript" src="__HOME_STATIC__/js/dtk.js?t=5&amp;u=525577&amp;pv=7" id="counterJs"></script>
</body>
</html>
