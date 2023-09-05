<html>
<head>
    <title>搜尋帳號</title>
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
    <h1>選擇帳號</h1>
	<!-- 網頁小標 -->
    <h2>以下為所有帳號資訊</h2>

<table>
    <tr>        
    <th>使用者帳號
    <th>姓名
    <th>email
    <th>電話   
    <th>地址
    <th>使用者類型
    </tr>
<?
    $sql_query="select * from user";
    $result=mysql_query($sql_query);
    while($row=mysql_fetch_array($result))
    {
    ?>
    <tr>
    <td><? echo $row['account'] ?></td>
    <td><? echo $row['name'] ?></td>
    <td><? echo $row['email'] ?></td>
    <td><? echo $row['phone'] ?></td>
    <td><? echo $row['address'] ?></td>
    <td><? echo $row['type'] ?></td>
    </td>
    <td>
        <!---選擇要修改或刪除的功能，連接到modify_venueInfo.php--->
        <a href="modify_act.php?act_type=<? echo $row['type'] ?>&act=<? echo $row['account'] ?>&email=<? echo $row['email'] ?>&修改=修改">修改</a>
        <a href="modify_act.php?act_type=<? echo $row['type'] ?>&act=<? echo $row['account'] ?>&刪除=刪除">刪除</a>
    </td>
    </tr>
    <?
    }   
    ?>
    </table>  
    <?
    ob_end_flush(); 
?>
</body>
</html>