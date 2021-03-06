<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"../thems/default/index/xpk_list.html";i:1500108315;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>乐找券-精品库-手工选品</title>
	<link rel="stylesheet" href="/default/static/css/wap_common.css" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
	<style>
		.quan-item{width: 100%;padding: 5px;box-sizing: border-box;}
		.thumb{width: 100px; overflow: hidden; float: left;}
		.thumb img{width: 100%}
		.desc{
			margin-left: 110px;
			height: 48px;
			overflow: hidden;
			color: #fdfdfd;
			font-size: 16px;
			line-height: 24px;
			overflow : hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
		}
		.price {
			font-size: 12px;
			color: #ddd;
			margin-left: 110px;
			margin-top: 8px;
		}
		.stamp {height: 120px;padding: 0 10px;position: relative;overflow: hidden;box-sizing: border-box}
		.stamp:before {content: '';position: absolute;top:0;bottom:0;left:10px;right:10px;z-index: -1;}
		.stamp:after {content: '';position: absolute;left: 10px;top: 10px;right: 10px;bottom: 10px;box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.5);z-index: -2;}
		.stamp i{position: absolute;
			left: 20%;
			top: 63px;
			height: 174px;
			width: 225px;
			background-color: rgba(255,255,255,.15);
			transform: rotate(-30deg);
			z-index: 2;}
		.stamp .par{float: left;padding:10px 8px;width: 250px;border-right:2px dashed rgba(255,255,255,.3);text-align: left;}
		.stamp .par p{color:#fff;}
		.stamp .par .sign{font-size: 34px;}
		.stamp .par sub{position: relative;top:-5px;color:rgba(255,255,255,.8);}
		.stamp .copy{display: inline-block;width:76px;vertical-align: text-bottom;color:rgb(255,255,255);height:100%}
		.stamp01{background: #D24161;background: radial-gradient(transparent 0, transparent 5px, #D24161 5px);background-size: 15px 15px;background-position: 9px 3px;}
		.stamp01:before{background-color:#D24161;}
		.quan{
			margin-left: 110px;
		}
		.shoufa-quan {
			font-size: 10px;
			height: 17px;
			line-height: 17px;
			position: relative;
			text-indent: 4px;
			color: white;
		}
		.shoufa-quan span {
			position: absolute;
			left: 0;
			width: 19px;
			text-indent: 5px;
			height: 17px;
			background: white url(/default/static/images/cms-img.png) -205px -182px no-repeat;
			background-size: 287px 800px;
			line-height: 18px;
		}
		.shoufa-quan b {
			position: absolute;
			left: 17px;
			margin: 0;
			font-size: 12px;
			text-indent: 0;
			text-align: center;
			padding: 0 5px;
			color: #fff;
			line-height: 16px;
			height: 15px;
			border: #ff9950 1px solid;
		}
		.real_price{
			font-size: 14px;
			margin-left: 110px;
			font-weight: 600;
			color: #fff;
		}
		.look-btn{
			height: 30px;
			line-height:30px;
			margin: auto 0;
			display: inline-block;
			margin-top: 45px;
			margin-left: 5px;
			font-size:16px;
		}
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
		.pop {
			width: 100%;
			overflow: hidden;
		}
		.banner{
			max-height: 220px;
			overflow: hidden;
		}
		.banner img{
			width: 100%
		}
		.layui-m-layerchild h3.view-title{
			height: 32px;
			line-height:32px;
			text-align: left;
			font-size: 16px;
			margin:0
		}
		.view-desc{
			padding: 0 8px;
			color: #FF552E;
		}
		.view_count{
			color: #aaa;
			margin-left: 12px;
		}
		.coup{
			color: #FF552E;
			font-weight: 600;
		}
		.coup_price{
			color: #FF552E;
			font-weight: 600;
			font-size: 16px;
		}
		.view-price span{
			margin-left: 14px;
		}
		.detail{
			height: 32px;
			width: 120px;
			border: 1px solid #FF552E;
			background: #fff;
			margin: 0 auto;
			display: inline-block;
			border-radius: 8px;
			margin-top: 24px;
		}
		.pic-detail-show {
			width: 100%;
			/* overflow: hidden; */
			margin-top: 10px;
			display: none;
			height: auto;
		}
		.pic-detail-show img {
			width: 98%;
			vertical-align: middle;
			/*margin-bottom: 5px;*/
		}
		.nav-list{
			padding: 12px;
		}
		.nav-list a{
			color: #333;
			display: inline-block;
			padding: 5px 12px;
			border: 1px solid #ddd;
			-webkit-border-radius:5px;
			-moz-border-radius:5px;
			border-radius:5px;
			margin: 12px 4px;
			font-size: 14px;
		}
		.nav-list a.active{
			background: #FE4A65;
			color: #fff
		}
		.search-none {
			width: 100%;
			height: 200px;
			margin: 5rem auto;
			display: block;
		}
		.search-none .search-none-icon {
			width: 150px;
			height: 150px;
			background: url(/default/static/images/search-none2s.png) center no-repeat;
			background-size: 100%;
			margin: 0 auto 25px;
		}
		.search-none p {
			text-align: center;
			font-size: 15px;
			color: #aaa;
			line-height: 24px;
		}
	</style>
	<script src="__HOME_STATIC__/js/jquery.2.0.min.js?v=201704271010"></script>
	<script src="__HOME_STATIC__/js/lazyload.js?v=201704271010"></script>
	<script src="__HOME_STATIC__/layer/layer.js"></script>
</head>
<body>
	<div class="warrp">
		<div class="main-title clearfix">
			<a href="javascript:void(0)" class="main-back"></a>
			<div class="menu-detail">
				<span>精品库</span>
			</div>
			<a class="mui-action-menu main-home" href="/index.html"></a>
		</div>
		<div class="you-wrapper">
			<div class="title-wrapper">
				<div class="text">手工挑选优质商品</div>
			</div>
		</div>
		<div class="nav-list">
			<?php if(is_array($xpk) || $xpk instanceof \think\Collection || $xpk instanceof \think\Paginator): $i = 0; $__LIST__ = $xpk;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
				<a href="/xpk_list?xpk_id=<?php echo $x->favorites_id; ?>" class="<?php if($x->favorites_id == $xpk_id): ?>active<?php endif; ?>" data-xpkid="<?php echo $x->favorites_id; ?>"><?php echo $x->favorites_title; ?></a>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php if($list == false): ?>
		<div class="search-none">
			<div class="search-none-icon"></div>
			<p>该选品库还未选品哦~~~~</p>
		</div>
		<?php else: ?>
		<div class="quan-list">
			<ul id="quan_list_ul">
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?>
				<li class="quan-item">
					<div class="stamp stamp01">
						<div class="par">
							<div class="thumb">
								<img src="<?php echo $l->pict_url; ?>" />
							</div>
							<div class="desc"><?php echo $l->title; ?></div>
							<div class="price">
								<span><?php echo $l->zk_final_price; ?></span>
								<span>月销：<?php echo $l->volume; ?></span>
							</div>
							<?php if(isset($l->coupon_click_url)): ?>
							<div class="real_price">券后价：<?php echo $l->zk_final_price - findCounpPrice($l->coupon_info); ?></div>
							<div class="quan">
								<div class="goods-quan shoufa-quan fl">
									<span>券</span>
									<b><i>￥</i><?php echo findCounpPrice($l->coupon_info); ?></b>
								</div>
							</div>
							<?php endif; ?>
						</div>
						<div class="copy">
							<span class="look-btn" onclick="showDetail(this)"
							      data-title="<?php echo $l->title; ?>"
										data-pic="<?php echo $l->pict_url; ?>"
										data-price="<?php echo $l->zk_final_price; ?>"
										data-counpPice="<?php if(isset($l->coupon_info)): ?><?php echo findCounpPrice($l->coupon_info); else: ?>0<?php endif; ?>"
										data-url="<?php if(isset($l->coupon_click_url)): ?><?php echo $l->coupon_click_url; ?>&pid=<?php echo config('site_pid'); endif; ?>"
										data-itemid="<?php echo $l->num_iid; ?>"
										data-volume="<?php echo $l->volume; ?>"
										data-lastPrice="<?php if(isset($l->coupon_info)): ?><?php echo $l->zk_final_price - findCounpPrice($l->coupon_info); endif; ?>">立即查看</span>
						</div>
						<i></i>
					</div>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
		
		<div class="pullup-goods">
			<div class="label">商品加载中...</div>
		</div>
		<?php endif; ?>
	</div>
	<div class="pop" style="display: none">
		<div class="banner">
			<img src="" id="picUrl" />
		</div>
		<div class="title-desc">
			<h3 class="view-title" id="title"></h3>
		</div>
		<div class="view_count">销量: <span id="volume"></span></div>
		<div class="view-price">
			<span>原价: <em id="price"></em></span>
			<span class="coup">优惠券: <em id="counppice"></em></span>
			<span class="coup_price">券后价: <em id="lastprice"></em></span>
		</div>
		<div class="btns" style="text-align: center"><button class="detail btn" id="btn" data-goodsid="0">查看详情</button>
			<button class="detail tkl" id="tkl">查看淘口令</button></div>
		<div class="pic-detail-show"></div>
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
      var is_tkl = false;
      var $pullUp = null;
      var needLoadMore = false;
      var maxScrollY = 0;
      var windowHeight = 0;
      var uid = '';
      var xpk_id = <?php echo $xpk_id; ?>;

      var isLoad = false;
      function findNUm(str){
          var reg = /([0-9])+/g;
          var res = str.match(reg)
		      return res[1]
      }
      
      function showDetail(obj){
          console.log($(obj).data())
          isLoad = false
          is_tkl = false
          $('.pic-detail-show').html('')
          var height = parseInt(window.innerHeight * 0.6)
		      var data = $(obj).data();
          
          for(var k in data){
              $("#"+k).text(data[k])
          }
          
          $("#picUrl").attr('src', data['pic'])
          $("#btn").attr('data-goodsid', data['itemid'])
          // 碳层
          layer.open({
              type: 1
              ,content: $(".pop").html()
              ,anim: 'up'
              ,style: 'position:fixed; top: 50%; left:0; width: 100%; height: '+height+'px; padding:10px 0; margin-top: -'+(height / 2)+'px; border:none;overflow: scroll;'
          });
          $(".btn").click(function () {
              //图文详情
              var goodsId = data['itemid'];
              if($('.pic-detail-show').css('display') == 'none'){
                  $('.pic-detail-show').css('display','block');
              }else{
                  $('.pic-detail-show').css('display','none');
              }
              if(!isLoad){
                  $('span.loadding-lab').fadeIn(300);
                  setTimeout(function(){
                      $.ajax({
                          type: "get",
                          async: false,
                          url: 'http://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.1/?&data={"item_num_id":"'+goodsId+'"}&type=jsonp',
                          dataType: "jsonp",
                          jsonp: "callback",
                          jsonpCallback:"showTuwen",
                          success: function(jsonp){

                              $('span.loadding-lab').fadeOut(300);
                              if(jsonp.data.images.length>0){
                                  for(var i = 0 ; i < jsonp.data.images.length ; i++){
                                      $('.pic-detail-show').append('<p><img src="'+jsonp.data.images[i]+'"/></p>');
                                  }
                              }

                              isLoad = true;
                          },
                          error: function(){
                          }
                      });
                  },300);
              }
          })
		      
		      $('.tkl').click(function () {
		        $.ajax({
				        url: '/api/index/create_tkl',
				        data: {
				            logo: data['pic'],
						        url: data['url'],
						        text: data['title'],
						        json: true
				        },
				        success: function (res) {
				            if(res.hasOwnProperty('code')){
				                alert(res.msg)
				            }else{
				                layer.open({
						                content: res.model
				                })
				            }
				        },
				        error: function () {
				            alert('淘口令制作失败')
				        }
		        })
		      })
      }
      $(document).ready(function () {

          maxScrollY = $(document).height();
          windowHeight = $(window).height();
          $(window).on('resize', function () {
              windowHeight = $(window).height();
          });
          
          $(".nav-list a").click(function () {
              xpk_id = $(this).attr('data-xpkid')
		          page = 1
              getData(xpk_id);
          })
          
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
              getData(xpk_id, $wrapper, data, 1);
          });
          function getData(xpk_id, $wrapper, data, direction) {
              if (isFinish) {
                  return;
              }
              isLoading = true;
              if (!$pullUp) {
                  $pullUp = $wrapper.find('.pullup-goods');
              }
              var labelTag = $($pullUp).find('.label');
              var tPaht = "/xpkajax/";
              $.ajax(tPaht, {
                  data: {page: page, u: uid, json: true,xpk_id: xpk_id},
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
		                          console.log(_d)
                              html += '<!--goods item start-->'
                                  +'<li class="quan-item">'
                                  +'<div class="stamp stamp01">'
                                  +'<div class="par">'
                                  +'<div class="thumb">'
                                  +'<img src="'+_d['pict_url']+'" />'
                                  +'</div>'
                                  +'<div class="desc">'+_d['title']+'</div>'
                                  +'<div class="price">'
                                  +'<span>'+_d['zk_final_price']+'</span>'
                                  +'<span>月销：'+_d['volume']+'</span>'
                              +'</div>'
                              if(_d.hasOwnProperty('coupon_click_url')){
                                 html+='<div class="real_price">券后价：'+(_d['zk_final_price'] - findNUm(_d['coupon_info']))+'</div>'
                                  +'<div class="quan">'
                                  +'<div class="goods-quan shoufa-quan fl">'
                                  +'<span>券</span>'
                                  +'<b><i>￥</i>'+findNUm(_d['coupon_info'])+'</b>'
                                  +'</div>'+
                                  ' </div>'
                              }
                              
                              html+='</div>'+
                              '<div class="copy"><span class="look-btn" onclick="showDetail(this)"'
		                              +'data-title="'+_d['title']+'" data-pic="'+_d['pict_url']+'" data-price="'+_d['zk_final_price']+'"+'
				                       if(_d.hasOwnProperty('coupon_click_url')){
                                   html+='data-counpPice="'+findNUm(_d['coupon_info'])+'"'
                                   +'data-url="'+_d['coupon_click_url']+'&pid=<?php echo config('site_pid'); ?>"'
				                       }
                              html+='data-itemid="'+_d['num_iid']+'" data-volume="'+_d['volume']+'"'
                              if(_d.hasOwnProperty('')){
				                          var price = (_d['zk_final_price'] - findNUm(_d['coupon_info']));
                              }else{
                                  var price = _d['zk_final_price']
                              }
                              html+='data-lastPrice="'+price+'"' +
		                              '>立即查看</span>'+
                                  '</div>'+
                                 '<i></i>'+
                                  '</div>'+
                                  '</li>'
                                  +'<!--goods item end-->';
                          }

                          $('#quan_list_ul').append(html);
                          $("img.lazy").lazyload();
                          maxScrollY = $(document).height();
                          isLoading = false;
                          page++;
                          $('.goods-list').attr('data-page', page);
                      } else {
                          maxScrollY = $(document).height();
                          isLoading = false;
                          $('.pullup-goods .label').html('没有更多商品啦');
                          isFinish = true;
                          console.log('222')
                      }
                  }
              });
          }
         
      });
      $("img.lazy").lazyload();
      
	</script>
	<script>
      
      
      function loadDetail(goodsId){
      
      }
	
	</script>
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
</body>
</html>
