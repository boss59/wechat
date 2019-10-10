<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// 登陆 注册
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// 博客
Route::any('/blogs/index','blogs\BlogsController@index');// 首页
Route::any('/blogs/logout','blogs\UserController@logout');// 注销
Route::any('/blogs/send','blogs\UserController@send');// 邮箱
Route::any('/blogs/articleadd','blogs\ArticleController@articleadd');//文章添加
Route::any('/blogs/articlelist','blogs\ArticleController@articlelist');//文章展示
Route::any('/blogs/detail','blogs\ArticleController@detail')->name('detail');//文章 详情
Route::any('/blogs/update','blogs\ArticleController@update')->name('update');//文章 修改
Route::any('/blogs/del','blogs\ArticleController@del')->name('del');//文章 删除


// ==================微信 App============
Route::any('/weui/index','weui\WeuiController@index');// 首页
Route::any('/weui/Login','weui\LoginController@Login');// 用户登陆
Route::any('/weui/regist','weui\LoginController@regist');// 用户注册
Route::any('/weui/quit','weui\MineController@quit');// 退出登陆
Route::any('/weui/xieyi','weui\LoginController@xieyi');// 协议
Route::any('/weui/ajaxgetFloor','weui\WeuiController@ajaxgetFloor');// 楼层 数据显示
Route::any('/weui/prolist','weui\ProlistController@prolist');// 精选 推荐
Route::any('/weui/progoods','weui\ProlistController@progoods');// ajax 条件
Route::any('/weui/cate','weui\CateController@cate');// 分类
Route::any('/weui/cart','weui\CartController@cart');// 购物车
Route::any('/weui/sell','weui\SellController@sell');// 商家流程
Route::any('/weui/proinfo','weui\ProinfoController@proinfo');// 产品详情
Route::any('/weui/addCary','weui\ProinfoController@addCary');// 加入购物车
Route::any('/weui/newinfo','weui\NewinfoController@newinfo');// 新闻详情
Route::any('/weui/newlist','weui\NewinfoController@newlist');// 新闻列表
Route::any('/weui/orders','weui\OrdersController@orders');// 订单 管理
Route::any('/weui/orderinfo','weui\OrderinfoController@orderinfo');//订单列表
Route::any('/weui/mine','weui\MineController@mine');// 会员中心
Route::any('/weui/coller','weui\ProinfoController@coller');// 收藏 我的 ajax
Route::any('/weui/mycoller','weui\MineController@mycoller');// 收藏 我的 ajax
Route::any('/weui/address_list','weui\AddressContorller@address_list');// 地址管理
Route::any('/weui/area','weui\AddressContorller@area');// 地址添加
Route::any('/weui/getArea','weui\AddressContorller@getArea');// ajax地址添加
Route::any('/weui/addAddress','weui\AddressContorller@addAddress');// ajax地址添加
Route::any('/weui/addorder','weui\AddressContorller@addorder');// ajax地址添加
Route::any('/weui/deff','weui\AddressContorller@deff');// ajax地址添加
// ============= 购物车 列表操作========================
Route::any('/weui/del','weui\CartController@del');// ajax删除
Route::any('/weui/alldel','weui\CartController@alldel');// ajax批删
Route::any('/weui/total','weui\CartController@total');// ajax改数量 购买
// ============= 下单  ========================
Route::any('/weui/confirmOrder','weui\OrderinfoController@confirmOrder');// 支付
Route::any('/weui/alipay','weui\OrderinfoController@alipay');// 支付
// ======= 支付 通知 ===========
Route::any('/weui/returnpay','weui\OrderinfoController@returnpay');// 同步
Route::any('/weui/notifypay','weui\OrderinfoController@notifypay');// 异步


// =============== admin 后台======================
Route::group(['middleware'=>['CheckLogin']],function(){
	Route::any('/admin/index','admin\AdminController@index');//全职首页
	Route::any('/admin/quit','admin\LoginController@quit');// 退出登路
	// 管理员
	Route::any('/admin/useradd','admin\UserController@useradd');//管理员 添加
	Route::any('/admin/userlist','admin\UserController@userlist');//管理员 列表
	Route::any('/admin/userdelete','admin\UserController@userdelete');//管理员 删除
	Route::any('/admin/userdata','admin\UserController@userdata');//管理员 批删
	Route::any('/admin/userupdate','admin\UserController@userupdate');//管理员 修改
	// 品牌
	Route::any('/brand/brandadd','admin\BrandController@brandadd');// 品牌添加
	Route::any('/brand/brandlist','admin\BrandController@brandlist');// 品牌列表
	Route::any('/brand/branddel','admin\BrandController@branddel');// 品牌列表
	Route::any('/brand/brandupdate','admin\BrandController@brandupdate');// 品牌列表

	Route::any('/cate/cateadd','admin\CateController@cateadd');//分类添加
	Route::any('/cate/catelist','admin\CateController@catelist');//分类展示
	Route::any('/cate/catedel','admin\CateController@catedel');//删除分类
	Route::any('/cate/cateupdate','admin\CateController@cateupdate');//修改分类
	Route::any('/cate/cateedit','admin\CateController@cateedit');


	//商品添加
	Route::any('/goods/goodsadd','admin\GoodsController@goodsadd');
	//商品展示
	Route::any('/goods/goodslist','admin\GoodsController@goodslist');
	//商品删除
	Route::any('/goods/goodsdel','admin\GoodsController@goodsdel');
	//修改
	Route::any('/goods/goodsupdate','admin\GoodsController@goodsupdate');
	Route::any('/goods/edit','admin\GoodsController@edit');
	//     =====  中间件  ===========
	// Route::any('/','indexcontroller@index')->middleware(["checkLogin"]); 第一种 方式
});
// 第三方登录 微信
	Route::any('/wechat/wechat','wechat\WachatController@wechat');
	Route::any('/wechat/index','wechat\WachatController@index');
	Route::any('/weui/userinfo','wechat\WachatController@userinfo');
	Route::any('/weui/wechatcode','wechat\WachatController@wechatcode');


