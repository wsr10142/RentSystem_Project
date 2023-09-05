<html>
    <head>
        <title>填寫電子信箱</title>
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
	    <h2>請填寫電子信箱</h2>

<?
    $userID=$_POST["account"];
    
    $select_db = @mysql_select_db("ors");
    if(!$select_db)
    {
        echo'<br>找不到資料庫<br>';
    }
    else
    {
        $sql_query="select * from user where account='".$userID."'"; //是否為註冊過的使用者
        $result=mysql_query($sql_query);
        
        if(mysql_num_rows($result)==1)  //如果是使用者
        {
?>
        <form method="POST" action="GetYourPassword.php">
            
                <h3>你的電子信箱:
                <input name="email" class="box" type="text" required autofocus placeholder="電子信箱"></h2><br><br>
            </loginBox>
            <input type=hidden name="account" value=<?php echo $userID;?>>  <!--將userID繼續傳給下一頁-->
            <input value="確認" type="submit">
        </form> 
<?        
        }
        else {  //如果非使用者
?>
            <label><h2>你確定註冊過???</h2></label><br>       
            <p><a href=ForgotPasswordACT.php?>再試一次</a></p>
            <p><a href=login.php?>退出</a></p>
<?      }
    }
?>        
    </body>

</html> 