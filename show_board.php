<html>
<head>
    <title>布告欄</title> 
</head>

<body>
    <!--- 顯示高雄大學標誌，可連結到網站首頁，就是minsi的高雄大學圖標連結 --->
    <a href="home.php">國立高雄大學</a>

    <!-- 網頁最上方的標題 -->
	<h1>布告欄</h1>
	<!-- 網頁小標 -->
	<h2>最新消息</h2>

<?php
    include("connect.php");
    //選擇資料庫
    $select_db=@mysql_select_db("ors");
        
    //資料庫存取debug
    if(!$select_db)
    {
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {
        //在table:board搜尋公告訊息，並顯示最新消息
        $sql_query="select board_No,title,message,date from board order by date DESC";
        //執行sql語法
        $result=mysql_query($sql_query);
    ?>
        <table>
        <tr>
            <td>公告標題</td>
            <td>發布時間</td>
        </tr>
        <?
        while($row=mysql_fetch_array($result))
        {
        ?>
        <tr>
            <td><a href="show_boardMsg.php?board_No=<? echo $row[0] ?>"><? echo $row[1] ?></a></td>
            <?
                $time=explode(" ",$row[3]);
            ?>
            <td><? print_r($time[0]) ?></td>
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