<html>
<head>
        <title>刪除帳號成功</title>
    	<?php
        	session_start();
        	ob_start();
    	?>
    </head>

<body>
    <!-- 網頁最上方的標題 -->
	<h1>刪除帳號成功</h1>
	<!-- 網頁小標 -->
	<h2>可至管理帳號中瀏覽所有帳號資訊</h2>

<?php
	session_start();
	include("connect.php");

    $usr_account=$_SESSION['usr_login'];
    //echo $usr_account;

	$origin_no=$_SESSION['act'];
	$origin_type=$_SESSION['act_type'];

	$select_db=@mysql_select_db("ors");//選擇資料庫
    if(!$select_db)
    {           
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {       
		//刪除符合帳號的資料        
		if($origin_type=='租借人'){
			$sql_query="delete from renter where renter_account='".$origin_no."'";
			mysql_query($sql_query);
		}
		else if($origin_type=='出納組'){
			$sql_query="delete from cashier where cashier_account='".$origin_no."'";
			mysql_query($sql_query);
		}   
		$sql_query="delete from user where account='".$origin_no."'";
		mysql_query($sql_query);
        /* //renter table 的東西
        $sql_query="delete from renter where account='".$origin_no."'";
		mysql_query($sql_query);
        */
	}
	echo '<h3>三秒後將為您導引至功能頁</h3>';
	header("Refresh:3;url=system_home.php");
	ob_end_flush();
?>

</body>
</html>