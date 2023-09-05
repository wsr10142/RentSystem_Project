<html>
<head>
    <title>修改帳號</title>
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
        $getAct_type=$_GET["act_type"];
        $getAct=$_GET["act"];
        $getemail=$_GET["email"];

        session_start();
        $_SESSION['origin_act']=$getAct;//將原本的account存入SESSION中
        $_SESSION['origin_email']=$getemail;//將原本的email存入SESSION中
        $_SESSION['origin_type']=$getType;//將原本的type存入SESSION中
        
        //篩出符合帳號的所有資料
        $sql_query="select * from user where account='".$getAct."'";
        $result=mysql_query($sql_query);
        $row=mysql_fetch_array($result);

        //接收到修改帳號資訊的指令
        if($_GET["修改"]!="")
        {
        ?>
        	<!-- 網頁最上方的標題 -->
	        <h1>修改帳號</h1>
	        <!-- 網頁小標 -->
	        <h2>可修改以下之帳號資訊</h2>   

            <!---輸入要修改的資料，回傳給modify_actInfoSuccess.php--->
            <form method="POST" action="modify_actSuccess.php">
            <tr>
            <table>
            <tr>
                <td align="right">帳號：</td>
                <td align="left"><input type="text"  maxLength="10" name="act" value="<? echo $row['account'] ?>"></td>
            <?
            //接收從modify_actSuccess.php回傳的error的value
            if($_GET['error']=="")
            {
            ?>            
            </tr>   
            <?
            }
            if(strcmp($_GET['error'],'1')==0)
            {
            ?>
                <td>帳號重複</td>
            </tr>
            <?
            }
            
            ?>
            <tr>
                <td align="right">姓名：</td>
                <td align="left"><input type="text"  maxLength="10" name="name" value="<? echo $row['name'] ?>"></td>
            </tr>

            <tr>
                <td align="right">電話：</td>
                <td align="left"><input type="text"  maxLength="10" name="phone" value="<? echo $row['phone'] ?>"></td>
            </tr>

            <tr>
                <td align="right">email：</td>
                <td align="left"><input type="text"  maxLength="10" name="email" value="<? echo $row['email'] ?>"></td>
            </tr>
            <?
            if(strcmp($_GET['error'],'2')==0)
            {
            ?>
                <td>信箱重複</td>
            </tr>
            <?
            }
            //接收從modify_venueSuccess.php回傳的error的value
            if(strcmp($_GET['error'],'3')==0)
            {
            ?>
                <td>請填入校內email</td>
            </tr>
            <?
            }
            ?>
            

            <tr>
                <td align="right">地址：</td>
                <td align="left"><input type="text"  maxLength="10" name="address" value="<? echo $row['address'] ?>"></td>
            </tr>
            <?
            if($row['type']=='租借人'){
                $sql_query="select * from renter where renter_account='".$getAct."'";
                $result_renter=mysql_query($sql_query);
                $row_renter=mysql_fetch_array($result_renter);
            ?>
            
                <tr>
                <td align="right">種類:</td>
                <td align="left">
                <?
                if($row_renter['InOrOut']==1)
                {
                    $renter='checked';     
                }
                else
                {
                    $renter='';
                }
                ?>
                <input value="1" type="radio" name="InOrOut"<? echo $renter ?>>校內
                <?
                if($row_renter['InOrOut']==0)
                {
                    $renter='checked';
                }
                else
                {
                    $renter='';
                }
                ?>
                <input value="0" type="radio" name="InOrOut"<? echo $renter ?>>校外
                </td>
                </tr>
                <tr>
                    <td align="right">校內ID:</td>
                    <td align="left" ><input type=text maxLength="10" size=15 name="SID" value="<? echo $row_renter['ID'];?>"></td>
                </tr>
            <?
                //接收從modify_venueSuccess.php回傳的error的value
                if(strcmp($_GET['error'],'4')==0)
                {
                ?>
                    <td>校內帳號請填入SID</td>
                </tr>
                <?
                }
            }
            else if($row['type']=='出納組'){
                $sql_query="select * from cashier where cashier_account='".$getAct."'";
                $result_cashier=mysql_query($sql_query);
                $row_cashier=mysql_fetch_array($result_cashier);
            ?>
                <tr>
                <td align="right" style="color:black">營業時間:</td>
                <td align="left"><input type=text size=15 name="opentime" value="<? echo $row_cashier['opentime'];?>"></td>
                </tr>
            <?
            }
            ?>
            </table>
            <input value="送出" type="submit">
            <input type="button" value="返回" onclick="location.href='search_act.php'">
            </form>
            <?
        }

        //接收到刪除帳號的指令
        if($_GET["刪除"]!="")
        {
        ?>
	        <!-- 網頁最上方的標題 -->
	        <h1>刪除帳號</h1>
	        <!-- 網頁小標 -->
	        <h2>以下為帳號資訊</h2>
        <?
            //接收資料 
            $getAct_type=$_GET["act_type"];
            $getAct=$_GET["act"];

            session_start();
            $_SESSION['act']=$getAct;//將原本的account存入SESSION中
            $_SESSION['act_type']=$getAct_type;//將原本的account存入SESSION中

        ?>
            <!-- 印出要刪除帳號的資料 -->
            <table>
            <tr>
                <td align="right">帳號：</td>
                <td align="left"><? echo $row['account'] ?></td>
            </tr>

            <tr>
                <td align="right">姓名：</td>
                <td align="left"><? echo $row['name'] ?></td>
            </tr>

            <tr>
                <td align="right">電話：</td>
                <td align="left"><? echo $row['phone'] ?></td>
            </tr>
            <tr>
                <td align="right">email：</td>
                <td align="left"><? echo $row['email'] ?></td>
            </tr>

            <tr>
                <td align="right">地址：</td>
                <td align="left"><? echo $row['address'] ?></td>
            </tr>

            <tr>
                <td align="right">使用者類型：</td>
                <td align="left"><? echo $row['type'] ?></td>
            </tr>
            </table>

            <!---送出後連結到刪除帳號的delete_actSuccess.php--->
            <input type="button" value="確定" onclick="location.href='delete_actSuccess.php'">
            <input type="button" value="返回" onclick="location.href='search_act.php'">
            <?
        }
    ob_end_flush();         
    }
?>
</body>
</html>