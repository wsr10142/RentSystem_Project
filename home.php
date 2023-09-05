<html>
    <head>
        <meta name = "viewport" content = "width=device-width, initial-scale = 1.0" http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>校內租借系統</title>
        <link rel="stylesheet" href="LandingPage.css">

        <?php
            echo $_SESSION['usr_login'];
            session_start();
            ob_start();
            include("connect.php");
            //接收登出的value
            $logout=$_GET["logout"];

            //登出，清除SESSION
            if($logout==1)
            {
                unset($_SESSION['usr_login']);
                $logout==0;
            }

            //登出按鈕 
            if($_SESSION['usr_login']!=NULL)
            {
            ?>
            <a href="home.php?logout=1">Logout
            <? 
            } 
            ?>
    </head>
    
    <body>
        <div class="container">
            <div class="navbar">
                <a href="home.php">
                    <img src="img/logo.png" class="logo">
                </a>
            </div>
            <div class="row">
                <div class="col">
                    <h1>
                        歡迎光臨
                    </h1>
                    <p>高雄大學 校內烤肉區租借系統</p>
                </div>

                <div class="col">
                    <a href="show_board.php" class="card card1">
                        <h3>布告欄</h3>
                    </a>
                    <? 
                        if($_SESSION['usr_login']==NULL)
                        {
                        ?>
                            <a href="login.php" class="card card2">
                                <h3>登入</h3>
                            </a>
                        <?
                        }
                         
                        //登入
                        else
                        {
                            //接收目前登入中的帳號
                            $usr_account=$_SESSION['usr_login'];
                
                            //判斷首頁的帳號身分別，連接至該身分別的功能頁
                            include("judge_homeAccount.php");
                        }
                     ?>

                </div>
            </div>
        </div>

<?php
	ob_end_flush();
?>
    </body>
</html>