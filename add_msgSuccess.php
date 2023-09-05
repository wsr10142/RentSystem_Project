<html>
<head>
    <title>發布成功</title>
    	<?php
        	session_start();
        	ob_start();
            include("connect.php");
            $usr_account=$_SESSION['usr_login'];
    	?>
</head>

<body>
    <!--Process-->

    <!-- 網頁最上方的標題 -->		
    <h1>發布成功</h1>
	<!-- 網頁小標 -->
    <h2>以下為發布公告的內容</h2>

    <?
        $select_db=@mysql_select_db("ors");//選擇資料庫
        
        //資料庫存取debug
        if(!$select_db)
        {
            echo '<br>找不到資料庫!<br>'; 
        }
        else
        {
            
            //抓取網頁"發布公告"(add_board.php)表單的資訊

            //抓取登入者的名字
            $sql_query="select name from user where account='".$usr_account."'";
            $result=mysql_query($sql_query);
            $row=mysql_fetch_array($result);//登入者的名字

            $announcer=$usr_account;
            $title=$_POST["title"];
            $content=$_POST["content"];
            $date_time=$_POST["date_time"];

            //下sql語法：在table:board插入一筆資料
            $sql_query="INSERT INTO `board` VALUES('','".$title."','".$content."','".$announcer."','".$date_time."')";
            //執行sql語法
            mysql_query($sql_query);

            ?>
            <table>
            <tr>
                <td align="right">標題：</td>
                <td align="left"><? echo $title ?></td>
            </tr>

            <tr>
                <td align="right">公告訊息：</td>
                <td align="left"><? echo $content ?></td>
            </tr>
            </table>
            
            <?
            echo '<h3>三秒後將為您導引至功能頁</h3>';
            header("Refresh:3;url=venue_home.php");
        }
        ?>

        <?php
            ob_end_flush();
        ?>
    </body>

</html>