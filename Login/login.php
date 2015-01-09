<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
    session_start();
    
    //注销登录
    if (isset($_GET['action'])) {
        if($_GET['action'] == "logout"){  
            unset($_SESSION['userid']);
            unset($_SESSION['username']);
            echo "注销登录成功！点击此处 <a href='login.html'>登录</a>";
            exit;
        } 
    }

    if(isset($_POST['reg'])) {
        echo "<script>location.href='reg.html';</script>";
    }
    
    //登录
    if(!isset($_POST['submit'])){
        echo "<script>alert('illegal access!');location.href='index.html';</script>";
        exit;
    }
    else {
        if (!isset($_POST['username'])) {
            exit;
        }
        elseif(empty($_POST['username'])){
            echo "<script>alert('Please input Username.');location.href='index.html';</script>";  //alert 弹框警告，JS语言，location.href 回到的页面
            exit;
        }
        else $username = htmlspecialchars($_POST['username']);
        
        if (!isset($_POST['password'])) {
            exit;
        }
        elseif(empty($_POST['password'])){
            echo "<script>alert('Please input Password.');location.href='index.html';</script>";  
            exit;
        }
        else $password = MD5($_POST['password']);
    }

    //包含数据库连接文件
    include('conn.php');
    //检测用户名及密码是否正确
    $check_query = mysqli_query($dbindex,"select userid from userdata where username='$username' and password='$password' limit 1");
    //echo $check_query;
    if($result = mysqli_fetch_array($check_query)){
        //登录成功
        $_SESSION['username'] = $username;
       // echo $result['0'].'<br/>';
        $_SESSION['userid'] = $result['userid'];
        echo $username,' 欢迎你！进入 <a href="my.php">用户中心</a><br />';
        echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
        exit;
    } else {
        exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
    }
?>