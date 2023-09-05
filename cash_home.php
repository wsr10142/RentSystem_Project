<html>
    <head>
        <title>出納人員首頁</title>
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
        
        <!---連接到不同功能的網頁--->
        <a href="cashierPage.php">訂單一覽</a>
        <a href="cashier.php">繳費</a>
        
        <?php
            ob_end_flush();
        ?>

    </body>
</html>