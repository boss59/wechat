<?php

namespace App\Http\Controllers\Alipay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlipayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;//异步通知地址
    public $return_url;//同步通知地址
    public $rsaPrivateKeyFilePath = '';  //私钥如果是文件形式的,这就是默认路径
    public $aliPubKey = '';  //公钥路径
    public $privateKey = 'MIIEowIBAAKCAQEAsVvGg6Xv68ixdHLW1k+OV919MzCPJSWwE8l2RHWEp8p9g+i7N+um7LMQbxgAjtr6HeS86BH1h9A0lKq5xb6DaVNwGK0M0i1gDFCSvN1qgXNzMQhuro4puBCFm2EWHweGTKGGDOadXLFYWG/3fHZ9Ruic9cI3d03FqiO8t2xiC9klxrtwkZcervCfqQcWvVDJQTzqwOUa8zoCzVCdkh4zshXGfMmhyFS5K/G4mUyHFFTqK3jQOWdKnmBln5VE5XBUsNRzwKtIx0mewH/vKHir//VyUUcBHBDm0BOoZBpZStqmFhWmaEudFCvqYXNeZFku7mL1zWigSskFY+Rb1fIM6wIDAQABAoIBAH4z2fxPlXtn4a4FEY6KKbWoK7DDOvip6rMJxhhMr0peMhYtAxt1meAQQv9qSutcMmIXI7zXGqm7o86t9Wcae5P1BWzpppfgJdpdcyzlOSZIKo2XfHrFOjZ5uzinSwBlcFETFroTV6Jfp4e2lJqCDf7pAtd1jdZdBuxcZar3eoUGnZ4nSLOssPEhmrBQZoFfBwfkXKyscLUe9ZPiPAdmhHaCRJGqmceJzHnl5DO/FlhcuE/qt9P09sK7u3TIrxygYRmFYYo2Xrc3QR4D7NW7seBM3t8FGW0FB8cs6HuJmyfmoSW/xLN2hOdU1f9WLT9O/uj4bOZKUaV11XmrPYq3akECgYEA4sv+Z9a+f1SZvWXfKF6HWFHOtbZrB0nM4Yr/6m2MBxdXbTh9zyKTZEZ89UfekXmHwJJOOk5zuJ8UoPgkOvBw4f0KQ2j/VqsuxUidhmgX4tlMVkpcg3hCS+5vxwQnwss1SETxqePGlcHc+JQL9wI5bne6wc9ZjhZR7pfYlOxf+7sCgYEAyDIfgxY6irPAE2IiEFR1RecwQoof+YBBphc5JmohtHciX5zyNBB8SK2gEzRAPeqJcIq2UXWUkze0NiGgmdpjI9FjCMPWoKAE47Gg+t/XX5CdrH2k74aLkrkJHuNpOXE+F1cGnWNKRwBOisBe6e2DdoIlFItXp4WomYcxKkup6JECgYBwlkAnIE3VPBROF4Jesf6Sc5ogTvx208YnuS8uG0/GPWojSEX8S/fLccqaoSD2KtSfXoIDI+sCncZJ2qVxtOb06P7tU/Rd/ADt4wyAKrCg5qqks6mVgl+2/hjzPTbX1rUOuVsWsYJl2aVuqV//MVV9Z2aIy/xzMtVdknfsBiPn/QKBgCdzkTgxAjphL+Hh/dp/+lhbNex28dQmTUmg2/dRBPFeZNy4vhY6hXOBG8GNE3fgJ1ORUlp9NFlKqe3c9Jw9KDpfwgdxKHOg9TW1xIaL5BKGGjxqyj0Vo523by+yGwNh6J2K3dfYQEP7sH6xaELrNnP9M7d3uj9eHJqcxLiUDpixAoGBAKI5yUc91g5JV6Jm1Lix1iiSY+VKJg/cJr5XHzg/e4lwJLncDwfhVlcZFpp4UbLuzlw7QyMbsx8L/h6z3yzj4tMrsx58kIvKJdRZUTu2C7crzJKc1jGl0mP5zrP0wqnUo7ye7Kgf8R0hdcPYm43y2iwouggzTRKtzEZ4WMc7X557';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAk0IW9njsYxYR+UZG0/ndxDUuFnBpr6mbRMwgOI+5Z6k4GqY4+hY/fWJh+rdIuKdzG4iln4RJaIJwfxy8/khSeW4q1zA4A6yFAiGDbfSnrtP5MGokuIchMowgoR2dDrDcaDpX56GEO4GaOIGm/h7+P/YGvfACeJE76tcrYPKc9KgOuybHGgnJpT1fz/JShbQIZUa8YsUD9LwUqeIMT7lgrj29k4ojqRsYGWmpzDYVth3hvFAC38uB1BL61Ji1L+DwqgO6SRD+3LI39wpNKr20SXsNe6jo0WDwIYMpbGU+gx+6hkUHF4TJftwRIxHab9efKJNaGPPl7aZBPc8O/aVnAQIDAQAB';
    /**
     * 支付核心类的构造方法
     * @author 崔健
     * @DateTime 2019-09-19T15:00:50+0800
     * @email    haiwanlvzhu@163.com
     */
    public function __construct()
    {
        $this->app_id = '2016093000628169';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = "";//异步通知地址
        $this->return_url = asset("alipay/return_url");
    }
    
    /**
     * 订单支付
     * @author 崔健
     * @DateTime 2019-09-19T15:02:17+0800
     * @email    haiwanlvzhu@163.com
     * @param    Request  $request [接受订单号]
     * @return   [type]   [调到具体的支付页面]
     */
    public function pay(Request $request)
    {
        $data = $request->all();
        if (!isset($data['order_amount']) || !isset($data['order_rand'])) {
            echo "参数错误,格式你懂得!";die;
        }
        
        $amount = $data['order_amount'];  //订单总金额
        $oid = $data['order_rand'];  //订单号
      
        if (empty($amount) || empty($oid)) {
            echo "参数不能为空,格式你懂得!";die;
        }
       
        // file_put_contents(storage_path('logs/alipay.log'),"\nqqqq\n",FILE_APPEND);
        // die();
        //验证订单状态 是否已支付 是否是有效订单
        //$order_info = OrderModel::where(['oid'=>$oid])->first();
        //判断订单是否已被支付
        //判断订单金额是否正确
        // if ($order_info['order_amount'] != $amount) {
        //     die("订单金额不符");
        // }
        // if($order_info['order_pay']==1){
        //     die("订单已支付，请勿重复支付");
        // }
        //判断订单是否为有效订单
        // if(empty($order_info)){
        //     die("订单为无效订单，无法支付");
        // }
        // 判断订单是否过期
        // if ($order_info['status'] == 0) {
        //     die("订单已过期，无法支付");
        // }

        //业务参数
        $bizcont = [
            'subject'           => '1812shop--' .$oid,
            'out_trade_no'      => $oid,
            'total_amount'      => $amount,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;
        
        header("Location:".$url);
    }
    /**
     * 获取签名方法
     * @author 崔健
     * @DateTime 2019-09-19T15:06:09+0800
     * @email    haiwanlvzhu@163.com
     * @param    [type]                   $params [description]
     * @return   [type]                           [description]
     */
    public function rsaSign($params) 
    {
        return $this->sign($this->getSignContent($params));
    }
    /**
     * 签名具体
     * @author 崔健
     * @DateTime 2019-09-19T15:06:34+0800
     * @email    haiwanlvzhu@163.com
     * @param    [type]                   $data [description]
     * @return   [type]                         [description]
     */
    protected function sign($data) 
    {
        if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
            $priKey=$this->privateKey;
            $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
                wordwrap($priKey, 64, "\n", true) .
                "\n-----END RSA PRIVATE KEY-----";
        }else{
            $priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
        }
        
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    /**
     * 获取签名的规则
     * @author 崔健
     * @DateTime 2019-09-19T15:07:22+0800
     * @email    haiwanlvzhu@163.com
     * @param    [type]                   $params [description]
     * @return   [type]                           [description]
     */
    public function getSignContent($params) 
    {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    /**
     * 检测非空
     * @author 崔健
     * @DateTime 2019-09-19T15:07:41+0800
     * @email    haiwanlvzhu@163.com
     * @param    [type]                   $value [description]
     * @return   [type]                          [description]
     */
    protected function checkEmpty($value) 
    {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) 
    {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 同步通知回调
     * @author 崔健
     * @DateTime 2019-09-19T15:09:33+0800
     * @email    haiwanlvzhu@163.com
     * @return   [type]                   [description]
     */
    public function aliReturn()
    {
        // //获取订单号
        // $oid = $_GET['out_trade_no'];
        // //修改订单状态
        // $res = OrderModel::where('order_rand',$oid)->update([
        //          'status'=>1,
        //      ]);
        // if (!$res) {
        //     echo "订单状态修改失败";die;
        // }
        //验签
        //     if(!$this->verify($_GET)){
        //         die('簽名失敗');
        //     }
       echo "订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转到订单详情';
       // header("Refresh:2;url=/home/orderlist");//调到
       // echo '<pre>';print_r($_GET);echo '</pre>';die;

    }
    /**
     * 异步通知
     * @author 崔健
     * @DateTime 2019-09-19T15:08:20+0800
     * @email    haiwanlvzhu@163.com
     * @return   [type]                   [description]
     */
    public function aliNotify()
    {
        $data = json_encode($_POST);
        $log_str = '>>>> '.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res === false){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }

        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        //验证订单交易状态
        if ($data['trade_status'] == "TRADE_SUCCESS") {
            $log_str .= " TRADE SUCCESS!<<<<< \n\n";//交易成功
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }else{
            $log_str .= " TRADE Failed!<<<<< \n\n";//交易失败
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }
        //处理订单逻辑
        $res = DB::table('order_detail')->where('order_rand',$oid)->update([
                 'status'=>1,
             ]);
        if ($res) {
            $log_str .= " Edit ORDER SUCCESS!<<<<< \n\n";//修改订单成功
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }else{
            $log_str .= " Edit ORDER Failed!<<<<< \n\n";//修改订单失败
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }
        
        echo 'success';//出的所有问题看日志就行,这里为了不让阿里云发送消息都是success了
    }
    /**
     * 验证签名
     * @author 崔健
     * @DateTime 2019-09-19T15:09:00+0800
     * @email    haiwanlvzhu@163.com
     * @param    [type]                   $params [description]
     * @return   [type]                           [description]
     */
    function verify($params) 
    {
        $sign = $params['sign'];

        if($this->checkEmpty($this->aliPubKey)){
            $pubKey= $this->publicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }else {
            //读取公钥文件
            $pubKey = file_get_contents($this->aliPubKey);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }
            
        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256)===1);
        openssl_free_key($res);
        return $result;
    }
    /**
     * 处理订单逻辑 更新订单 支付状态 更新订单支付金额 支付时间
     * @param $data
     */
    public function dealOrder($data)
    {
        //加积分
        //减库存
    }
}
