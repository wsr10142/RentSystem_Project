<html>
<head>
    <title>場地管理員首頁</title>
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
    <a href="add_venue.php">新增場地</a>
    <a href="search_venueInfo.php">管理場地</a>
    <a href="add_board.php">發布公告</a>
    <a href="delete_board.php">刪除公告</a>
    <a href="modify_orderStatus.php">訂單狀態</a>
<?php
	ob_end_flush();
?>

</body>
</html>