<html>
<head>
    <title>刪除公告成功</title>
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
    <h1>刪除成功</h1>
	<!-- 網頁小標 -->
    <h2>以下為刪除公告的內容</h2>

    <?
        $select_db=@mysql_select_db("ors");//選擇資料庫
        
        //資料庫存取debug
        if(!$select_db)
        {
            echo '<br>找不到資料庫!<br>'; 
        }
        else
        {
            //抓取選取刪除的訊息編號
            $board_No=$_GET['board_No'];

            $sql_query="SELECT `title`,`message` from `board` where board_No='".$board_No."'";
            $result=mysql_query($sql_query);
            $row=mysql_fetch_array($result);
            ?>
            <table>
            <tr>
                <td align="right">標題：</td>
                <td align="left"><? echo $row[0] ?></td>
            </tr>

            <tr>
                <td align="right">公告訊息：</td>
                <td align="left"><? echo $row[1] ?></td>
            </tr>
            </table>
            
            <?
            //抓取登入者的名字
            $sql_query="DELETE from `board` where board_No='".$board_No."'";
            mysql_query($sql_query);

            echo '<h3>三秒後將為您導引至功能頁</h3>';
            header("Refresh:3;url=venue_home.php");
        }
        ?>   




        <?php
            ob_end_flush();
        ?>
    </body>

</html>