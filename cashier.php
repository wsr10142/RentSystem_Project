<?php session_start(); ?>
<html>
    <head>
        <meta name = "viewport" content = "width=device-width, initial-scale = 1.0" http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>出納組</title>
        <link rel="stylesheet" href="cashier.css">
        <form method="get" action="cashierPage.php">
        <?php
            include("connect.php");    //連接資料庫

            //接收目前登入中的帳號
            $usr_account=$_SESSION['usr_login'];

            include("judge_Account.php");
        ?>
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <a href="home.php">
                    <img src="img/logo.png" class="logo">
                </a>
            </div>
            <form method="get" action="cashierPage.php">
            <div class="maintitle">
                <center>歡迎進入出納組繳交確認系統</center>  
            </div>
            <div class="whitebox">
            <!--$sql_query="UPDATE receipt SET cashierOrNo=1 WHERE OrderNo='".$EP."'";
                mysql_query($sql_query);  -->
                <?
                            $select_db=@mysql_select_db("ors");
                            $sql_query="SELECT * FROM receipt WHERE cashierOrNo=0";
                            $result=mysql_query($sql_query);
                            
                            //echo '資料筆數:' .mysql_num_rows($result). '<br>' ;
                            echo '<table border=1 >';
                            echo '<tr>';
                            echo '<th>訂單編號</th>';
                            echo '<th>訂單所有者</th>';
                            echo '<th>烤肉區數量</th>';
                            echo '<th>露營區數量</th>';
                            echo '<th>總人數</th>';
                            echo '<th>統一編號</th>';
                            echo '<th>繳費確認</th>';
                            echo '<th>是否審核訂單</th>';
                            echo '<th>申請時間</th>';
                            echo '</tr>';
                           
                            while($row=mysql_fetch_array($result)){
                                echo '<tr>';
                                echo '<td><input type=hidden name="OrderNo" value='.$row[0].'>'.$row[0];
                                echo '<td><input type=hidden name="account_belong" value='.$row[1].'>'.$row[1];
                                echo '<td>'.$row[2].'<name="c_Num">';
                                echo '<td>'.$row[3].'<name="b_Num">';
                                echo '<td>'.$row[4].'<name="person_Num">';
                                echo '<td>'.$row[5].'<name="tax_ID">';
                                echo '<td><input value='.$row[0].' type="checkbox" name="EP"> <!--繳費是否通過-->'; 
                                echo '<td>'.$row[7];
                                echo '<td>'.$row[8];
                                
                               
                                
                        }
                        echo'</table>';
                        
                ?>
                <center>
                <input value="送出" type="submit" style="
                            border:2px solid white;
                            border-radius:23px;
                            padding: 2px 8px;
                            font-size: 20px;
                            background-color: rgb(200, 200, 200); 
                            color: black;" href=cashierPage.php?>
                <input value="清除" type="reset" style="
                            border:2px solid white;
                            border-radius:23px;
                            padding: 2px 8px;
                            font-size: 20px;
                            background-color: rgb(200, 200, 200); 
                            color: black;" href=cashier.php?>  
                </center>                               
            </div>

        </div>
    </body>
</html>