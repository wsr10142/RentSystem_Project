<html>
<head>
        <title>刪除場地成功</title>
    	<?php
        	session_start();
        	ob_start();
    	?>
    </head>

<body>
    <!-- 網頁最上方的標題 -->
	<h1>刪除場地成功</h1>
	<!-- 網頁小標 -->
	<h2>可至管理場地中瀏覽所有場地資訊</h2>

<?php
	session_start();
	include("connect.php");

    $usr_account=$_SESSION['usr_login'];
    //echo $usr_account;

	$origin_no=$_SESSION['origin_placeno'];

	$select_db=@mysql_select_db("ors");//選擇資料庫
    if(!$select_db)
    {           
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {      
		//刪除符合場地編號的資料          
		$sql_query="delete from place where no='".$origin_no."'";
		mysql_query($sql_query);
	}
	echo '<h3>三秒後將為您導引至功能頁</h3>';
	header("Refresh:3;url=venue_home.php");
	ob_end_flush();
?>

</body>
</html>