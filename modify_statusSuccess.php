<html>
<head>
        <title>修改狀態成功</title>
    	<?php
        	session_start();
        	ob_start();
    	?>
</head>

<body>
	<!-- 網頁最上方的標題 -->		
    <h1>修改狀態成功</h1>
	<!-- 網頁小標 -->
    <h2>以下為訂單更新後資訊</h2>

<?php
	session_start();
	include("connect.php");

	$usr_account=$_SESSION['usr_login'];
    //echo $usr_account;
    $no=$_GET['receipt_no'];
    $rent=1;

    $select_db=@mysql_select_db("ors");//選擇資料庫
    if(!$select_db)
    {           
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {
		//將訂單改為核准
        $sql_query="update receipt set venueOrNo='".$rent."' where receipt_No ='".$no."'";
        mysql_query($sql_query);

		//將user跟receipt的資料表做join，篩出符合訂單編號的資料
        $sql_query="select receipt_No,name,phone,cashierOrNo,venueOrNo,time from user right outer join receipt on user.account = receipt.account_belong where receipt_No= '".$no."'";
        $result=mysql_query($sql_query);
        
		?>

			<!---印出符合訂單編號的資料--->
			<table>
			<tr>
			   <td>訂單編號</td>
			   <td>名字</td>
			   <td>電話</td>
			   <td>繳費狀況</td>
			   <td>核准狀態</td>
			   <td>申請時間</td>
		   	</tr>

		   	<?
			while($row=mysql_fetch_array($result))
			{
		   	?>
				<tr>
					<td> <? echo $row[0] ?>
					<td> <? echo $row[1] ?>
					<td> <? echo $row[2] ?>
			   	<?
			   	if($row[3]==0)
			   	{
			   	?>
					<td>未繳費
			   	<?
			   	}
			   	else if($row[3]==1)
			   	{
			   	?>
				   	<td>已繳費
			   	<?
			   	}
			   	if($row[4]==0)
			   	{
			   	?>
					<td>未核准
			   	<?
			   	}
				else if($row[4]==1)
			   	{
			   	?>
				   	<td>已核准
			   	<?
			   	}
			   	?>
				   	<td><? echo $row[5] ?>
				<?
			}
			?>
			   	</tr>
				</table>
			<?

		echo '<h3>三秒後將為您導引至功能頁</h3>';
		header("Refresh:3;url=venue_home.php");
		ob_end_flush();
    }
?>

</body>
</html>