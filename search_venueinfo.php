<html>
<head>
    <title>選擇場地</title>
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
	<h1>管理場地</h1>
	<!-- 網頁小標 -->
	<h2>請選擇場地</h2>
            
<?php
    $select_db=@mysql_select_db("ors");
	if(!$select_db)
	{
		 echo '<br>找不到資料庫!<br>'; 
	}
	else
	{              
    ?>
        <table>
        <!---選擇場地類型--->
        <tr>
            <td align="center">場地種類：</td>
            <td align="left">
                <select name="place_type" onchange="window.location='<? echo $PHP_SELF; ?>?place_type='+this.value">
                    <option value="">請選擇</option>
                    <option value="露營位" <?if($_GET["place_type"]=="露營位"){echo "selected";}?>>露營區</option>
                    <option value="烤肉台" <?if($_GET["place_type"]=="烤肉台"){echo "selected";}?>>烤肉區</option>
                </select>
            </td>
        </tr>
        </table>

            <?php
                $type=$_GET["place_type"];

                //篩出符合場地種類的所有資料
                $sql="select no,price_In,price_Out,rentOrNo from place where type = '$type'";
                $result=mysql_query($sql);

                ?>
                <table>
                <tr>
                    <td>場地編號</td>
                    <td>校內價格</td>
                    <td>校外價格</td>
                    <td>可否租借</td>
                    <td>選取</td>
                </tr>

                <?
                while($row=mysql_fetch_array($result))
                {
                ?>
                    <tr>
                        <td><? echo $row[0] ?></td>
                        <td><? echo $row[1] ?></td>
                        <td><? echo $row[2] ?></td>
                        <td>
                        <? 
                            if(strcmp($row[3],1)==0)
                            {
                                echo '可租借';
                            }
                            else if(strcmp($row[3],0)==0)
                            {
                                echo '不可租借';
                            }
                        ?>
                        </td>
                        <td>
                            <!---選擇要修改或刪除的功能，連接到modify_venueInfo.php--->
                            <a href="modify_venueInfo.php?place_type=<? echo $type ?>&place_no=<? echo $row[0] ?>&修改=修改">修改</a>
                            <a href="modify_venueInfo.php?place_type=<? echo $type ?>&place_no=<? echo $row[0] ?>&刪除=刪除">刪除</a>
                        </td>
                    </tr>
                <?
                }   
                ?>
                </table>
  
    <?
        }
    ?>

</body>
</html>
