<html>
<head>
    <title>修改場地</title>
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
<?php

    $select_db=@mysql_select_db("ors");
	if(!$select_db)
	{
		 echo '<br>找不到資料庫!<br>'; 
	}
	else
	{   
        //接收資料 
        $getPlace_type=$_GET["place_type"];
        $getPlace_no=$_GET["place_no"];

        session_start();
        $_SESSION['origin_placeno']=$getPlace_no;//將原本的place_no存入SESSION中
        
        //篩出符合場地編號的所有資料
        $sql_query="select * from place where no='".$getPlace_no."'";
        $result=mysql_query($sql_query);
        $row=mysql_fetch_array($result);

        //接收到修改場地資訊的指令
        if($_GET["修改"]!="")
        {
        ?>
        	<!-- 網頁最上方的標題 -->
	        <h1>修改場地</h1>
	        <!-- 網頁小標 -->
	        <h2>可修改以下之場地資訊</h2>   

            <!---輸入要修改的資料，回傳給modify_venueInfoSuccess.php--->
            <form method="POST" action="modify_venueInfoSuccess.php">
            <tr>
            <table>
            <tr>
                <td align="right">場地編號：</td>
                <td align="left"><input type="text"  maxLength="10" name="place_no" value="<? echo $row[0] ?>"></td>
            <?
            //接收從modify_venueSuccess.php回傳的error的value
            if($_GET['error']=="")
            {
            ?>            
            </tr>
            <?
            }
            if(strcmp($_GET['error'],'1')==0)
            {
            ?>
                <td>場地編號重複</td>
            </tr>
            <?
            }
            ?>
            <tr>
                <td align="right">校內價格：</td>
                <td align="left"><input type="text"  maxLength="10" name="price_in" value="<? echo $row[1] ?>"></td>
            </tr>

            <tr>
                <td align="right">校外價格：</td>
                <td align="left"><input type="text"  maxLength="10" name="price_out" value="<? echo $row[2] ?>"></td>
            </tr>

            <tr>
                <td align="right">可否租借：</td>
                <td align="left">
                <?
                if($row[3]==1)
                {
                    $rentOrNo_check='checked';
                }
                else
                {
                    $rentOrNo_check='';
                }
                ?>
                <input value="1" type="radio" name="rentOrNo"<? echo $rentOrNo_check ?>>可租借
                <?
                if($row[3]==0)
                {
                    $rentOrNo_check='checked';
                }
                else
                {
                    $rentOrNo_check='';
                }
                ?>
                <input value="0" type="radio"name="rentOrNo" <? echo $rentOrNo_check ?>>不可租借
                </td>
            </tr>

            <tr>
                <td align="right">場地種類：</td>
                <td align="left">
                <?php
                if(strcmp($row[4],"露營位")==0)
                {
                    $type_check='checked';
                }
                else
                {
                    $type_check='';
                }
                ?>
                <input value="露營位" type="radio" name="type"<? echo $type_check ?>>露營位
                <?
                if(strcmp($row[4],"烤肉台")==0)
                {
                $type_check='checked';
                }
                else
                {
                    $type_check='';
                }
                ?>
                <input value="烤肉台" type="radio"name="type" <? echo $type_check ?>>烤肉台
                </td>
            </tr>
            </table>
            <input value="送出" type="submit">
            <input type="button" value="返回" onclick="location.href='search_venueInfo.php'">
            </form>
            <?
        }

        //接收到刪除場地的指令
        if($_GET["刪除"]!="")
        {
        ?>
	        <!-- 網頁最上方的標題 -->
	        <h1>刪除場地</h1>
	        <!-- 網頁小標 -->
	        <h2>以下為場地資訊</h2>

            <!-- 印出要刪除場地的資料 -->
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
                <?php
                if($row[3]==1)
                {
                    echo "可租借";
                }
                else if($row[3]==0)
                {
                    echo "不可租借";
                }
                ?>
                </td>
            </tr>

            <tr>
                <td align="right">場地種類：</td>
                <td align="left"><? echo $row[4] ?></td>
            </tr>
            </table>

            <!---送出後連結到刪除場地的delete_venueSuccess.php--->
            <input type="button" value="確定" onclick="location.href='delete_venueSuccess.php'">
            <input type="button" value="返回" onclick="location.href='search_venueInfo.php'">
            <?
        }
    ob_end_flush();         
    }
?>
</body>
</html>