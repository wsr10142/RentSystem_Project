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
	<h1>修改帳號資訊成功</h1>
	<!-- 網頁小標 -->
	<h2>以下為帳號更新後資訊</h2>
            
<?php
	include("connect.php");

    $usr_account=$_SESSION['usr_login'];

    //接收資料
    $origin_act=$_SESSION['origin_act'];
    $origin_email=$_SESSION['origin_email'];
    $origin_type=$_SESSION['origin_type'];
    $act=$_POST['act'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['adress'];
    $type=$_POST['type'];
    $SID=$_POST['SID'];
    $InOrOut=$_POST['InOrOut'];
    $opentime=$_POST['opentime'];


    $select_db=@mysql_select_db("ors");//選擇資料庫
    if(!$select_db)
    {           
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {
        //當帳號有改變時，判斷帳號是否有重複
        if(strcmp($origin_act,$act)!=0)
        {
            $sql_query="select * from user where account ='".$act."'";
            $result=mysql_query($sql_query);

            if(mysql_num_rows($result)==1)
            {
                //回傳給modify_act.php，error的value為1
                header("Location:modify_act.php?act=$origin_act&email=$origin_email&act_type=$type&修改=修改&error=1");
            }

        }
        
        //信箱不可重複
        if(strcmp($origin_email,$email)!=0)
        {
            $sql_query="select * from user where account ='".$act."'";
            $result=mysql_query($sql_query);

            if(mysql_num_rows($result)==1)
            {
                //回傳給modify_act.php，error的value為2
                header("Location:modify_act.php?act=$origin_act&email=$origin_email&act_type=$type&修改=修改&error=2");
            }
        }
        //校內要有校內的信箱
        if(!preg_match("/@mail.nuk.edu.tw/i",$mail) && $InOrOut==1){
            header("Location:modify_act.php?act=$origin_act&email=$origin_email&act_type=$type&修改=修改&error=3");
        }
        if($SID==NULL && $InOrOut==1){
            header("Location:modify_act.php?act=$origin_act&email=$origin_email&act_type=$type&修改=修改&error=4");
        }
        
            //更新符合帳號的所有資訊               
            $sql_query="update user set account='".$act."',name='".$name."',phone='".$phone."',email='".$email."'address='".$address."' where account ='".$origin_act."'";
            mysql_query($sql_query);
            if($origin_type='租借人'){
                $sql_query="update renter set renter_account='".$act."',InOrOut='".$InOrOut."',ID='".$SID."' where renter_account ='".$origin_act."'";
                mysql_query($sql_query);
            }
            else if($origin_type='出納組'){
                $sql_query="update cashier set cashier_account='".$act."',opentime='".$opentime."' where cashier_account ='".$origin_act."'";
                mysql_query($sql_query);
            }
             
            //篩出符合修改過後帳號的所有資訊
            $sql_query="select * from user where account='".$act."'";
            $result=mysql_query($sql_query);
            $row=mysql_fetch_array($result);
?>
            <!---印出修改過後場地的所有資訊--->
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
            <?
            if($origin_type='租借人'){
                $sql_query="select * from renter where renter_account='".$act."'";
                $result=mysql_query($sql_query);
                $row=mysql_fetch_array($result);
                ?>
                <tr>
                <td align="right">校內或校外(In=1)：</td>
                <td align="left"><? echo $row['InOrOut'] ?></td>
                </tr>

                <tr>
                <td align="right">學號：</td>
                <td align="left"><? echo $row['ID'] ?></td>
                </tr>
                <?
            }
            else if($origin_type='出納組'){
                $sql_query="select * from cashier where cashier_account='".$act."'";
                mysql_query($sql_query);
                $result=mysql_query($sql_query);
                $row=mysql_fetch_array($result);
                ?>
                <tr>
                <td align="right">營業時間：</td>
                <td align="left"><? echo $row['opentime'] ?></td>
                </tr>
                <?
            }
            ?>
            </table>
<?    
    echo '<h3>三秒後將為您導引至功能頁</h3>';
    header("Refresh:3;url=system_home.php");
    ob_end_flush();       
    }
?>
</body>
</html>