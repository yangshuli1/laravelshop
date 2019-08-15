<?php

namespace App\Http\Controllers;

use Yansongda\Pay\Pay;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['notify','return']]);
    }
    protected $config = [
        'alipay' => [
            'app_id' => '2016101000654799',
            'notify_url' => 'http://cfyd2w.natappfree.cc/laravel/blog/public/api/notify',
            'return_url' => 'http://localhost/laravel/blog/public/api/return',
            'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqMby+OXnSLwSKT3agN4aUw+VMsRbk/gBvalSw+VMENBxH5XUDGXsMGHlnx/5BXyGQZ3npr2DSxO4tbQ/FbAqTFs/e+DIy+zereAXluVCDh4oKJqUdjdF8H9/dhtpDj/pOpcbCFVzQRvrcsKSP373U4Zco9Cz3hLfqsgxHjOERK6mW4Tn1l1SzmNjRzve4neykOdwUiizCoPPtsmBreffN/6UMm9ZlmrHbpfofEwnB+2W//TAVvXNsNd4FDwvHjbndT6HzT28i24NNyeMZ9qmHS34/WlZICj2IpkqWGC3xBxliIDcLgD8qT+b+RpAJT2Ex5BSgLybvmjZCTwEDkqeWwIDAQAB',
            'private_key' => 'MIIEpAIBAAKCAQEA0QtPx0pNGXlerZVDmqq3mnka85MJlFx4YXCYBt3XD+i2H0g2UrydNDphhvbPAdRn1j+idGIPNXphzktj/CpnriIAyLCVJ3/zKMjb3x1Mop+AO6Ujo3ltG1dOXzTsiPb3634xRjYYhNJn650MC8sxN9qghNCBgrDXh4LVzKGp7UDZzm28XSZRWR5kuQLgpaIj2tu4MibrL0ud3ets99CYfOCNEbg5DXex5tlRPovWT/BkX2SDKRjeqyq0U1omdovp0U/76emtZbg4HJjTjcBVaQpaM16+3Z99sW/yg2CEwkNxZt5MblQoxdFxNn8fqEl3Eocoj24NA+eiJZSgYxLdvQIDAQABAoIBAQCx5yyH8EXZLh9THrqgADWs8u/q5vG6H1AbrNTU0yrZ0TRdPvlsRDSNZDnnwFe/uOJ9xT4eSe2jl3lxNVvsGLKP0URVh2IIca2gwf/My4SSyac6G3pO/2HJaO27vLCoh3XKJmUM2bDYKLBkJg1AZDaI0DjXjxMJBDMIkmIdel/BFmwDwT+fhRv9Nm+lx/lRdJwqnjVbdAo2y5M282A9rx+sA/JRbVdQMvU659H2sE8iekY4eBBqeHMFQgV+SVeXGjnXJLvUDkGdS9lgpiWSnBSgnkyhZURF0AI1asP7OWn6XeBqEIIXy/WWTp2s/B6Mo3YZLE98Tt5yTIVlGbexns4JAoGBAOkBBXDM5lFfkbSMUd5Bmf889Pc/W+AYGz4dO4oAKvp+MtxXPvinFnU6+YutCkmjmvHp/Frx+3xRi+OIqiUe/e5gPsP7jgNMeHgCXqW0cNztnBoBHERjMIhvha/ToZ0s3p5q6oNI10MdbR82E6EiL1LUwZXwoAEpI/5SNSVp/FGzAoGBAOWs7qoO0bSiQ9wsQKbEzCnMPWTNVSzEj8WEyRR4QErWiVh3bNia13xoeG34rYDyY2psPB31eXhbDDMr3w/fK5G86w2brJ1Gv0GVLQhPC1dEG7oUTl4wpOF1hSDUwLBuhIJ1VXyaXb5LCl3TwrbzANafTm7TNhjZEhfCq2wMrPrPAoGAFLEehpHrsjZGfj4n1xEEWAJVzs81nYUGhlGaQ/sX1f73DVJCKVrNR8Pg/WJ0k22QCQO6gWkT6EplneM5GOrTqiOp70WbqvdTi3TKavTHQRdo0XZfyEL2wGcG/EJTC948Nt1PzjDdzPwEAM2QmLKseTKjrmkcDH5Wz/ME/TmYSrkCgYA0Iv6GkhielZsr9suyT8g80MU7BbWJFRHB97Ohtu55Tpwc/fcycGvsLNbxt9rDA8L3nJxE/L1XSevKDfJz6ug8DBObojQb+7xcyd1QHolnhOl6YzOrBAXZvFC9NC6NnnjsGHCQeYZANU6kH/b6is0s6zrlw4JrP5Nw21sIixQVVwKBgQDoqkQeLRjzDgqAhTpIraGZATMmg8uqR1yJl1kYc2uNXVsUwEWIv3BBpdiYwBoiKnq+PgYVZrrBON/FtehQzctajxbkJap6n17dGJNXWnV05jfSr0liAZLsUKNpwhpRg0f9qqcerd9+bBOR0jSoMQ/E8H3x9HdqHO9i9k/7Et+66A==',
        ],
    ];

    public function index(Request $request)
    {
        $config_biz = [
            'out_trade_no' =>$request->input('oid') ,
            'total_amount' => $request->input('totalp'),
            'subject'      => 'test subject',
        ];

        $pay = new Pay($this->config);

        return $pay->driver('alipay')->gateway()->pay($config_biz);
    }

    public function return(Request $request)
    {
        $pay = new Pay($this->config);

       $pay->driver('alipay')->gateway()->verify($request->all());
        header("location:http://localhost:8080/#/buyca");
    }

    public function notify(Request $request)
    {
        $pay = new Pay($this->config);

        if ($pay->driver('alipay')->gateway()->verify($request->all())) {
            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。 
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号； 
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）； 
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）； 
            // 4、验证app_id是否为该商户本身。 
            // 5、其它业务逻辑情况
            file_put_contents(storage_path('notify.txt'), "收到来自支付宝的异步通知\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单号：' . $request->out_trade_no . "\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单金额：' . $request->total_amount . "\r\n\r\n", FILE_APPEND);
            
        } else {
            file_put_contents(storage_path('notify.txt'), "收到异步通知\r\n", FILE_APPEND);
        }

        echo "success";
    }
}