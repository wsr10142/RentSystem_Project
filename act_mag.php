<html>
<head>
    <title>帳號管理</title>
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
    <h1>帳號管理</h1>
	<!-- 網頁小標 -->
    <h2>以下為所有帳號資訊</h2>
<?

    $account=$_POST["account"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    $type=$_POST["type"];  
?>
    <!--搜尋
    <form method="post" action="act_mag.php">
    帳號:<input name="account" class="box" type="text"  autofocus placeholder="帳號" style="color:black">
    姓名:<input name="name" class="box" type="text"  autofocus placeholder="姓名" style="color:black">
    email:<input name="email" class="box" type="text"  autofocus placeholder="帳號" style="color:black">
    電話:<input name="phone" class="box" type="text"  autofocus placeholder="電話" style="color:black">
    地址:<input name="address" class="box" type="text" autofocus placeholder="地址" style="color:black">
    使用者類型:<input name="type" class="box" type="text" autofocus placeholder="使用者類型" style="color:black">
    <td><input class="form" type="submit" value="搜尋"></td>
    </form>-->
<?
    /*//搜尋的部分尚未完成
    $condition="";
    $fristCondition=True;
    if($account!=NULL){
        if($fristCondition==True){
            $condition+="where account='".$account."'";
            $fristCondition=false;
        }
    }
    if($name!=NULL){
        if($fristCondition==True){
            $condition+="where name='".$name."'";
            $fristCondition=false;
        }
        else{
            $condition+=" & name='".$name."'";
        }
    }
    if($email!=NULL){
        if($fristCondition==True){
            $condition+="where email='".$email."'";
            $fristCondition=false;
        }
        else{
            $condition+=" & email='".$email."'";
        }
    }
    if($phone!=NULL){
        if($fristCondition==True){
            $condition+="where phone='".$phone."'";
            $fristCondition=false;
        }
        else{
            $condition+=" & phone='".$phone."'";
        }
    }
    if($address!=NULL){
        if($fristCondition==True){
            $condition+="where address='".$address."'";
            $fristCondition=false;
        }
        else{
            $condition+=" & address='".$address."'";
        }
    }
    if($type!=NULL){
        if($fristCondition==True){
            $condition+="where type='".$type."'";
            $fristCondition=false;
        }
        else{
            $condition+=" & type='".$type."'";
        }
    }*/
    $sql_query="select * from user LEFT JOIN renter ON user.account = renter.renter_account ".$condition;
    $result=mysql_query($sql_query);
    //echo '資料筆數:'.mysql_num_rows($result).'<br>';
    echo '<table border=1>';
    echo '<tr>';
    echo '<th>使用者帳號';
    echo '<th>姓名';
    echo '<th>email';
    echo '<th>電話';
    echo '<th>地址';
    echo '<th>使用者類型';
    echo '<th>校內或校外';
    echo '<th>學號';
            
    while($row=mysql_fetch_array($result)){
        echo '<tr>';
        echo '<td>'.$row['account'];
        echo '<td>'.$row['name'];
        echo '<td>'.$row['email'];
        echo '<td>'.$row['phone'];
        echo '<td>'.$row['address'];
        echo '<td>'.$row['type'];
        if($row['InOrOut']!="")
        {
            if($row['InOrOut']==1)
            {
                echo '<td>校內人士';
            }
            else if($row['InOrOut']==0)
            {
                echo '<td>校外人士';
            }
        }
        else
        {
            echo '<td>';
        }
        echo '<td>'.$row['ID'];                                
    }
    echo '</table>';
                    
?>
    <!---連接到不同功能的網頁--->
    <a href="add_act.php">新增帳號</a>
    <a href="search_act.php">修改帳號資料</a>

<?
    ob_end_flush();
?>
</body>
</html>