<html>
<head>
    <title>新增場地</title>
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
	<h1>新增場地</h1>
	<!-- 網頁小標 -->
	<h2>請填寫以下資料</h2>

	<!---輸入選擇的場地，回傳給add_veneuSuccess.php--->
	<form method="POST" action="add_venueSuccess.php">
    <table>

	<!---選擇場地類型--->
	<tr>
		<td align="right">場地類型：</td>
		<td align="left">
			<select name="place_type" onchange="window.location='<? echo $PHP_SELF; ?>?place_type='+this.value">
    			<option value="">請選擇</option>
    			<option value="露營位" <?if($_GET["place_type"]=="露營位"){echo "selected";}?>>露營位</option>
    			<option value="烤肉台" <?if($_GET["place_type"]=="烤肉台"){echo "selected";}?>>烤肉台</option>
    		</select>
	</tr>

<?
	$type=$_GET["place_type"];//接收place_type的value

	$select_db=@mysql_select_db("ors");
	if(!$select_db)
	{
		 echo '<br>找不到資料庫!<br>'; 
	}
	else
	{    
		//篩出符合場地種類的場地編號
		$sql_query="select no from place where type='".$type."'";
		$result=mysql_query($sql_query);

		//當場地種類為露營位時，計算目前場地編號的最大值，作為新場地的編號
		if(strcmp($type,"露營位")==0)
		{
			$max=0;
			while($row=mysql_fetch_array($result))
			{
				$num=explode("c",$row[0]);//切割字串
				$num=implode("",$num);//將array轉字串
				$num=intval($num);//將字串轉數值
				if($num>$max)
				{
					$max=$num;
				}
			}
			$max=$max+1;

			//將數值串接為場地編號
			if($max<10)
			{
				$max=strval($max);//將數值轉字串
				$max='c0'.$max;
			}
			else if($max>=10)
			{
				$max=strval($max);//將數值轉字串
				$max='c'.$max;
			}

			session_start();
			$_SESSION['new_no']=$max;//將新場地編號存入SESSION
			?>

			<!---印出新場地的編號--->
			<tr>
				<td align="right">場地編號：</td>
				<td align="left"><? echo $max ?></td>
			</tr>
			<?
		}

		//當場地種類為烤肉台，計算目前場地編號的最大值，作為新場地的編號
		else if(strcmp($type,"烤肉台")==0)
		{
			$max=0;
			while($row=mysql_fetch_array($result))
			{
				$num=explode("b",$row[0]);
				$num=implode("",$num);
				$num=intval($num);
				if($num>$max)
				{
					$max=$num;
				}
			}
			$max=$max+1;
			if($max<10)
			{
				$max=strval($max);
				$max='b0'.$max;
			}
			else if($max>=10)
			{
				$max=strval($max);
				$max='b'.$max;
			}

			session_start();
			$_SESSION['new_no']=$max;
			?>

			<tr>
				<td align="right">場地編號：</td>
				<td align="left"><? echo $max ?></td>
			</tr>
			<?
		}
	}
	?>

    <tr>
    	<td align="right">校內價格：</td>
    	<td align="left"><input type="text"  maxLength="10" name="price_in">
    </tr>

    <tr>
    	<td align="right">校外價格：</td>
    	<td align="left"><input type="text"  maxLength="10" name="price_out">
    </tr>

	<tr>
		<td align="right">可否租借：</td>
		<td align="left">
			<input value="1"type="radio"name="rentOrNo"checked>可租借
			<input value="0"type="radio"name="rentOrNo">不可租借
	</tr>
	</table>

    <input value="送出" type="submit">
	</form>
<?php
	ob_end_flush();
?>

</body>
</html>