<html>
<head>
    <title>發布公告</title>
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
    <h1>發布公告</h1>
	<!-- 網頁小標 -->
    <h2>請輸入公告資訊</h2>

    <!--填寫發布訊息表單-->
    <form method="POST" action="add_msgSuccess.php">
    <table>
        <tr>
            <!--填寫公告標題-->
            <td>標題：</td>
            <td><input type="text" maxLength="50" name="title"></td>
        </tr>

        <tr>
            <!--填寫公告訊息-->
            <td>公告訊息：</td>
            <td><input type="text" maxLength="100" name="content"></td>
        </tr>

        <?
            //設定時區
            date_default_timezone_set('Asia/Taipei');
                
                //取得日期與時間（新時區）
			$datetime=date('Y/m/d H:i:s');
            echo '<input type="hidden" name="date_time" value="'.$datetime.'">';
        ?>

    </table>

    <tr>
        <!--送出表單及取消表單-->
        <td><input value="確定" type="submit"></td>
        <td><input value="清除" type="reset"></td>
    </tr>

    <?php
        ob_end_flush();
    ?>
</body>

</html>