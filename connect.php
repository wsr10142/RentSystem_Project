<html>
    <head>
    <title>connect</title>
    </head>

<?php
	$location="localhost";//連到本機
	$account="root";
	$password="a1075504";
	if(isset($location)&&isset($account)&&isset($password))//確認三個都有值
	{
		$link=mysql_pconnect($location,$account,$password);
		if(!$link)
		{
			echo '無法連接資料庫';
			exit();
		}
		//else{echo '成功連接到資料庫';}
	}
?>

</html>