<html>
<head>
    <title>刪除公告</title>
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
    <!--Process-->
    
    <!-- 網頁最上方的標題 -->		
    <h1>刪除公告</h1>
	<!-- 網頁小標 -->
    <h2>請選擇公告</h2>

    <?
        //選擇資料庫
        $select_db=@mysql_select_db("ors");
        
        //資料庫存取debug
        if(!$select_db)
        {
            echo '<br>找不到資料庫!<br>'; 
        }
        else
        {
			# 設定時區
			date_default_timezone_set('Asia/Taipei');

			# 取得日期與時間（新時區）
			$datetime = date('Y-m-d');
            //下sql語法
            //在table:board搜尋當日發布的公告訊息
            $sql_query="SELECT `board_No`,`account`,`title`,`date` from `board` where `date` like '".$datetime."%'";
            //執行sql語法
            $result=mysql_query($sql_query);
                
            ?>
            <table>
                <tr>
                    <td>訊息編號</td>
                    <td>發布人</td>
                    <td>公告標題</td>
                    <td>發布時間</td>
                    <td>選取</td>
                </tr>

                <?
                    while($row=mysql_fetch_array($result))
                    {
                        ?>
                            <tr>
                                <td><? echo $row[0]; ?></td>
                                <td><? echo $row[1]; ?></td>
                                <td><? echo $row[2]; ?></td>
                                <td><? echo $row[3]; ?></td>
                                <td><a href="delete_boardSuccess.php?board_No=<? echo $row[0] ?>">刪除</a></td>
                            </tr>
                        <?
                    }

                ?>
            </table>
            <?
        }
    ?>

    <?php
        ob_end_flush();
    ?>
</body>

</html>