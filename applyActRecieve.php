<head>
<title>申請帳號結果</title>
</head>

<?php
    include("connect.php");
?>
<body>
    <!--- 顯示高雄大學標誌，可連結到網站首頁 --->
    <a href="home.php">國立高雄大學</a>

    <!--- 登入按鈕 --->
    <a href="login.php">Login</a>

    <!-- 網頁最上方的標題 -->
	<h1>申請結果</h1>
<?php

    $account=$_POST["account"];
    $name=$_POST["name"];
    $password=$_POST["password"];
    $eMail=$_POST["eMail"];
    $kind=$_POST["kind"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
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
        //判定校內人士
        if($kind==1){
            if(!preg_match("/@mail.nuk.edu.tw/i",$eMail)){
                echo "請輸入學校email 如果你是校內人士<br>";
                $flag=false;
            }

            //不知道為甚麼會出現Array
            if($SID==NULL){
                echo "請輸入學號 如果你是校內人士<br>";
                $flag=false;
            }
        }
        if($flag==TRUE){
            ?>
            <!-- 網頁小標 -->
            <h2>註冊成功</h2>
            <?
            echo'<p>account：'.$account.'<br>';
            echo'<p>name：'.$name.'<br>';
            echo'<p>password：'.$password.'<br>';
            echo'<p>eMail：'.$eMail.'<br>';
            echo'<p>kind：'.$kind.'<br>';
            echo'<p>phone：'.$phone.'<br>';
            echo'<p>SID：'.$SID.'<br>';
            echo'<p>address：'.$address.'<br>';
            $sql_query="INSERT INTO user VALUES('".$account."','".$password."','".$name."','".$phone."','".$eMail."','".$address."','租借人')";//加入使用者
            mysql_query($sql_query);
            $sql_query="INSERT INTO renter VALUES('".$account."','".$SID."','".$kind."')";//加入租借者
            mysql_query($sql_query);
        }
        else
            echo '<p><a href=applyAct.php?>重新申請會員</a></p>';
    }
    
?>

</body>