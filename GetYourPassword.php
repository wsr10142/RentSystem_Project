<html>
    <head>
        <title>獲得密碼</title>
    </head>
    <?include("connect.php");?>
    <body>

        <!--- 顯示高雄大學標誌，可連結到網站首頁 --->
        <a href="home.php">國立高雄大學</a>

        <!--- 登入按鈕 --->
        <a href="login.php">Login</a>

        <!-- 網頁最上方的標題 -->
        <h1>獲得密碼</h1>
        <!-- 網頁小標 -->
        <h2>以下為您的密碼</h2>
<?
    $email=$_POST["email"];
    $account=$_POST["account"];
    $select_db = @mysql_select_db("ors");
    if(!$select_db)
    {
        echo'<br>找不到資料庫<br>';
    }
    else
    {
        $sql_query="select * from user where email='".$email."'AND account='".$account."'"; //是否為那個使用者的電子信箱
        $result=mysql_query($sql_query);
        if(mysql_num_rows($result)==1)
        {
            $row = mysql_fetch_array($result);
?>
            <h3>密碼：<?echo $row['password'];?></h3><br>   <!--改一下位置ㄅ脫-->
<?
        }
        else {
?>
            <label><h3>少騙了!錯誤辣!!</h3></label><br>       <!--改一下位置ㄅ脫-->
            <p><a href=ForgotPasswordACT.php?>再試一次</a></p>
            <p><a href=login.php?>退出</a></p>
<?
        }      
    }
?>        
    </body>
</html> 