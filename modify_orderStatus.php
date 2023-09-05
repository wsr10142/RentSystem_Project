<html>
<head>
    <title>選擇訂單</title>
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
	<!-- 網頁最上方的標題 -->	
	<h1>選擇訂單</h1>
	
	<!---輸入租借者的手機末三碼，回傳給modify_orderStatus.php--->
	<form method="POST" action="">
	<table>
		<tr>
    		<td align="right">電話後三碼：</td>
    		<td align="left"><input type="text"  maxLength="10" name="tel">
			<input value="搜尋" type="submit">
    	</tr>
	</table>

<?
	//接收tel的value
	$tel=$_POST['tel'];

	//當tel的value不為空時
	if($tel != "")
	{
		$select_db=@mysql_select_db("ors");
		if(!$select_db)
		{
			 echo '<br>找不到資料庫!<br>'; 
		}
		else
		{
			//將user跟receipt的資料表做join，篩出符合手機末三碼的資料
			$sql_query="select receipt_No,name,phone,cashierOrNo,venueOrNo,time from user right outer join receipt on user.account = receipt.account_belong where phone like '%".$tel."'";
			$result=mysql_query($sql_query);	
		?>

			<!---印出符合手機末三碼的資料--->
			<table>
			<tr>
			   <td>訂單編號</td>
			   <td>名字</td>
			   <td>電話</td>
			   <td>繳費狀況</td>
			   <td>核准狀態</td>
			   <td>申請時間</td>
			   <td>更改核准狀態</td>
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
				   	<td>
			   
			   	<!---選擇核准，導引到租借核准成功的modify_statusSuccess.php，並回傳訂單編號--->
			   	<a href="modify_statusSuccess.php?receipt_no=<? echo $row[0] ?>">核准</a>

			   	<?
		   	}
			   	?>
			   	</tr>
				</table>
			   	<?
		}
	}
	ob_end_flush();
?>

</body>
</html>