<html>
<head>
    <title>系統管理員首頁</title>
    <?php
        session_start();
        ob_start();
        include("connect.php");
        
        //接收登入的帳號
		$usr_account=$_SESSION['usr_login'];
		
		include("judge_Account.php");
	?>
</head>

<body>
    <!---連接到不同功能的網頁--->
    <a href="act_mag.php">帳號管理</a>
    <a href="archive.php">歸檔日期設置</a>

<?php
	ob_end_flush();
?>

</body>
</html>