<?php

    date_default_timezone_set("PRC");
    set_time_limit(0); //限制页面执行时间,0为不限制
    include_once('../connectMysql.php');
    $header = array("content-Type:application/json", "token:test", "client:h5");

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = ($_POST['password'])?$_POST['password']:0;  //旧密码是 修改密码时提交的 第3位参数
    $loginType = $_POST['loginType'];
    $ip = $_COOKIE['ip'];
    $city = $_COOKIE['city'];
    $loginTime =  date("Y-m-d");
    $expireTime = date("Y-m-d", strtotime("+6 day"));
    $lastTime = date("Y-m-d H:i:s"); 

//    echo '<scrip>alert('+$email+')</scrip>';
    
    $postData = array( "email"=>$email, "username"=>$username,"password"=>$password );
//    $postData = array( "email"=>"10184586@qq.com", "username"=>"333","password"=>"333" );

    if( $loginType==0 ){    //注册
        $url="http://mixtvapi.mixtvapp.com/ott/user/register";
		$sql = mysqli_query($connect, "replace into client(sn,mark,password,ip,city,loginTime,expireTime,lastTime,isOnLine) values ('$sn','$email','$password','$ip','$city','$loginTime','$expireTime','$lastTime','在线')") or die(mysqli_error($connect));
    }else if( $loginType==1 ){  //登陆
        $url="http://mixtvapi.mixtvapp.com/ott/user/login";
    }else if( $loginType==2 ){  //退出登陆
        $url="http://mixtvapi.mixtvapp.com/ott/user/logout";
    }else if( $loginType==3 ){  //重置密码
        $url="http://mixtvapi.mixtvapp.com/ott/user/resetPassword";
    }else if( $loginType==4 ){  //修改密码
        $postData = array( "userId"=>$email, "newPassword"=>$username,"password"=>$password );
        //用户ID是 修改密码时提交的 第1位参数 即email,实际提交的是userId
        //新密码是 修改密码时提交的 第2位参数 即username,实际提交的是oldPassword
        //旧密码是 修改密码时提交的 第3位参数 即password
        $url="http://mixtvapi.mixtvapp.com/ott/user/editPassword";
    }
//  $url="http://mixtvapi.mixtvapp.com/ott/user/register";

    // 传入数组进行HTTP POST请求
    function curlPost($url, $post_data = array(), $timeout = 15, $header = "", $data_type = "") {
        $header = empty($header) ? '' : $header;
        //支持json数据数据提交
        if($data_type == 'json'){
            $post_string = json_encode($post_data);
        }elseif($data_type == 'array') {
            $post_string = $post_data;
        }elseif(is_array($post_data)){
            $post_string = http_build_query($post_data, '', '&');
        }
        
        $ch = curl_init();    // 启动一个CURL会话
        curl_setopt($ch, CURLOPT_URL, $url);     // 要访问的地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 对认证证书来源的检查   // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        //curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($ch, CURLOPT_POST, true); // 发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);     // Post提交的数据包
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        //curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     // 获取的信息以文件流的形式返回 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //模拟的header头
        $result = curl_exec($ch);
    
        // 打印请求的header信息
        //$a = curl_getinfo($ch);
        //var_dump($a);
    
        curl_close($ch);
        return $result;
    }
    $result = curlPost($url, $postData, 15, $header, 'json');

    echo $result;

?>

