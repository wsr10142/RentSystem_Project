<html>
<head>
        <title>新增場地成功</title>
    	<?php
        	session_start();
        	ob_start();
    	?>
    </head>

<body>
	<!-- 網頁最上方的標題 -->		
	<h1>新增場地成功</h1>
    <!-- 網頁小標 -->
    <h2>以下為新場地資料</h2>

<?php
	include("connect.php");

    $usr_account=$_SESSION['usr_login'];
    //echo $usr_account;

    //接收資料
    $place_no=$_SESSION['new_no'];
    $price_in=$_POST['price_in'];
    $price_out=$_POST['price_out'];
    $rentOrNo=$_POST['rentOrNo'];
    $type=$_POST['place_type'];

    $select_db=@mysql_select_db("ors");//選擇資料庫
    if(!$select_db)
    {           
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {
        //新增一筆場地資料到place
        $sql_query="insert into place values ('".$place_no."','".$price_in."','".$price_out."','".$rentOrNo."','".$type."')";
        mysql_query($sql_query);
    }
    ?>
        <table>
        <tr>
            <td align="right">場地編號：</td>
            <td align="left"><? echo $place_no ?></td>
        </tr>

        <tr>
            <td align="right">校內價格：</td>
            <td align="left"><? echo $price_in ?></td>
        </tr>

        <tr>
            <td align="right">校外價格：</td>
            <td align="left"><? echo $price_out ?></td>
        </tr>

        <tr>
            <td align="right">可否租借：</td>
            <td align="left">
            <?
            if($row[3]==0)
            {
            ?>
                <? echo '不可租借' ?></td>
            <?
            }
            else if($row[3]==1)
            {
            ?>
                <? echo '可租借' ?></td>
            <?
            }
            ?>
        </tr>

        <tr>
            <td align="right">場地種類：</td>
            <td align="left"><? echo $type ?></td>
        </tr>
        </table>
        <?
        echo '<h3>三秒後將為您導引至功能頁</h3>'; 
        header("Refresh:3;url=venue_home.php");  

	ob_end_flush();
?>

</body>
</html>