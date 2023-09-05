<html>
<head>
<title>新增帳號結果</title>
        <?php
        session_start();
        ob_start();
        include("connect.php");

        //接收目前登入中的帳號
        $usr_account=$_SESSION['usr_login'];
            
        include("judge_Account.php");
        ?>  
</head>

<body>
    <!-- 網頁最上方的標題 -->		
    <h1>新增帳號結果</h1>

<?php

    $account=$_POST["account"];
    $name=$_POST["name"];
    $password=$_POST["password"];
    $eMail=$_POST["eMail"];
    $kind=$_POST["kind"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    $type=$_POST["type"];
    $opentime=$_POST["opentime"];
    $SID=$_POST["SID"];

    $select_db = mysql_select_db("ors");
    if(!$select_db)
    {
        echo'<br>找不到資料庫<br>';
    }
    else
    {   
        $flag=TRUE;
        //偵測是否已經有帳號了
        $sql_query="select * from user where account='".$account."'";
        $result=mysql_query($sql_query);
        if(mysql_num_rows($result)==1){
            echo "<h3>此帳號已申請過</h3>";
            $flag=false;
        }
        //偵測是否有email了
        $sql_query="select * from user where email='".$eMail."'";
        $result=mysql_query($sql_query);
        if(mysql_num_rows($result)==1){
            echo "<h3>此信箱已申請過</h3>";
            $flag=false;
        }
        //是否有漏寫
        if($account==NULL){
            echo "請輸入帳號<br>";
            $flag=false;
        }
        if($name==NULL){
            echo "請輸入名稱<br>";
            $flag=false;
        }
        if($password==NULL){
            echo "請輸入密碼<br>";
            $flag=false;
        }
        if($eMail==NULL){
            echo "請輸入E-Mail<br>";
            $flag=false;
        }
        if($phone==NULL){
            echo "請輸入電話<br>";
            $flag=false;
        }
        if($address==NULL){
            echo "請輸入地址<br>";
            $flag=false;
        }
        if($type==NULL){
            echo "請輸入使用者類型<br>";
            $flag=false;
        }
        if($flag==True){
        //判定校內人士
        if( $type=="租借人"){
            if(!preg_match("/@mail.nuk.edu.tw/i",$eMail) && $kind==1){
                echo "請輸入學校email 如果你是校內人士<br>";
                $flag=false;
            }
            if($SID==NULL && $kind==1){
                echo "請輸入學號 如果你是校內人士<br>";
                $flag=false;
            }
            if($flag==TRUE){
                ?>
                <!-- 網頁小標 -->
                <h2>新增成功</h2>
                <?
                echo'<p>account:'.$account.'<br>';
                echo'<p>name:'.$name.'<br>';
                echo'<p>password:'.$password.'<br>';
                echo'<p>eMail:'.$eMail.'<br>';
                echo'<p>kind:'.$kind.'<br>';
                echo'<p>phone:'.$phone.'<br>';
                echo'<p>SID:'.$SID.'<br>';
                echo'<p>address:'.$address.'<br>';
                echo'<p>type:'.$type.'<br>';
                $sql_query="INSERT INTO user VALUES('".$account."','".$password."','".$name."','".$phone."','".$eMail."','".$address."','租借人')";//加入使用者
                mysql_query($sql_query);
                $sql_query="INSERT INTO renter VALUES('".$account."','".$SID."','".$kind."')";//加入租借者
                mysql_query($sql_query);
                echo '<h3>三秒後將為您導引至功能頁</h3>';
	            header("Refresh:3;url=system_home.php");
            }
        }
        else if( $type=="出納組"){
            if($opentime==NULL){
                echo "請輸入營業時間";
                $flag=false;
            }
            if($flag==TRUE){
                ?>
                <!-- 網頁小標 -->
                <h2>新增成功</h2>
                <?
                echo'<p>account:'.$account.'<br>';
                echo'<p>name:'.$name.'<br>';
                echo'<p>password:'.$password.'<br>';
                echo'<p>eMail:'.$eMail.'<br>';
                echo'<p>kind:'.$kind.'<br>';
                echo'<p>phone:'.$phone.'<br>';
                echo'<p>opentime:'.$opentime.'<br>';
                echo'<p>type:'.$type.'<br>';
                $sql_query="INSERT INTO user VALUES('".$account."','".$password."','".$name."','".$phone."','".$eMail."','".$address."','出納組')";//加入使用者
                mysql_query($sql_query);
                $sql_query="INSERT INTO cashier VALUES('".$account."','".$opentime."')";//加入出納組
                mysql_query($sql_query);
                echo '<h3>三秒後將為您導引至功能頁</h3>';
	            header("Refresh:3;url=system_home.php");
            }
        }
        if($flag==FALSE){
            ?>
            <!-- 網頁小標 -->
            <h2>新增成功</h2>
            <?
            echo'<p>account:'.$account.'<br>';
            echo'<p>name:'.$name.'<br>';
            echo'<p>password:'.$password.'<br>';
            echo'<p>eMail:'.$eMail.'<br>';
            echo'<p>kind:'.$kind.'<br>';
            echo'<p>phone:'.$phone.'<br>';
            echo'<p>type:'.$type.'<br>';
            $sql_query="INSERT INTO user VALUES('".$account."','".$password."','".$name."','".$phone."','".$eMail."','".$address."','".$type."')";//加入使用者
            mysql_query($sql_query);
            echo '<h3>三秒後將為您導引至功能頁</h3>';
	        header("Refresh:3;url=system_home.php");
        }
        }
        else
        echo '<p><a href=add_act.php?>重新新增帳號</a></p>';
    }
    
?>

</body>