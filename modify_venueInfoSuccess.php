<html>
<head>
        <title>修改場地資訊成功</title>
    	<?php
        	session_start();
        	ob_start();
    	?>
    </head>

<body>
    <!-- 網頁最上方的標題 -->
	<h1>修改場地資訊成功</h1>
	<!-- 網頁小標 -->
	<h2>以下為場地更新後資訊</h2>
            
<?php
	session_start();
	include("connect.php");

    $usr_account=$_SESSION['usr_login'];

    //接收資料
    $origin_no=$_SESSION['origin_placeno'];
    $place_no=$_POST['place_no'];
    $price_in=$_POST['price_in'];
    $price_out=$_POST['price_out'];
    $rentOrNo=$_POST['rentOrNo'];
    $type=$_POST['type'];


    $select_db=@mysql_select_db("ors");//選擇資料庫
    if(!$select_db)
    {           
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {
        //當場地編號有改變時，判斷場地編號是否有重複
        if(strcmp($origin_no,$place_no)!=0)
        {
            $sql_query="select * from place where no ='".$place_no."'";
            $result=mysql_query($sql_query);

            if(mysql_num_rows($result)==1)
            {
                //回傳給modify_venueInfo.php，error的value為1
                header("Location:modify_venueInfo.php?place_no=$origin_no&place_type=$type&修改=修改&error=1");
            }

        }
            //更新符合場地編號的所有資訊               
            $sql_query="update place set no='".$place_no."',price_In='".$price_in."',price_Out='".$price_out."',rentOrNo='".$rentOrNo."',type='".$type."' where no ='".$origin_no."'";
            mysql_query($sql_query);
             
            //篩出符合修改過後場地編號的所有資訊
            $sql_query="select * from place where no='".$place_no."'";
            $result=mysql_query($sql_query);
            $row=mysql_fetch_array($result);
?>
            <!---印出修改過後場地的所有資訊--->
            <table>
            <tr>
                <td align="right">場地編號：</td>
                <td align="left"><? echo $row[0] ?></td>
            </tr>

            <tr>
                <td align="right">校內價格：</td>
                <td align="left"><? echo $row[1] ?></td>
            </tr>

            <tr>
                <td align="right">校外價格：</td>
                <td align="left"><? echo $row[2] ?></td>
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
                <td align="left"><? echo $row[4] ?></td>
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