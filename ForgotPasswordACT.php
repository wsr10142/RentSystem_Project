<html>
    <head>
        <title>忘記密碼</title>
    </head>
    <body>
        <!--- 顯示高雄大學標誌，可連結到網站首頁 --->
        <a href="home.php">國立高雄大學</a>

        <!--- 登入按鈕 --->
        <a href="login.php">Login</a>

        <!-- 網頁最上方的標題 -->
	    <h1>獲得密碼</h1>
	    <!-- 網頁小標 -->
	    <h2>請填寫帳號</h2>

        <form method="POST" action="ForgotPasswordMail.php">
            
                <h3>你的帳號:
                <input name="account" type="text" required autofocus placeholder="帳號"></h3><br><br>
            
            <input value="確認" type="submit">
        </form>  
    </body>
</html>     