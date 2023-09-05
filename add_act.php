<html>
<head>
    <title>新增帳號</title>
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
    <center>
    <!-- 網頁最上方的標題 -->		
    <h1>新增帳號</h1>
	<!-- 網頁小標 -->
    <h2>請填寫以下資料</h2>

    <form method="POST" action="addActRecieve.php">
    <table border="0">
        <tr>
        <td align="right">帳號：</td>
        <td align="left"><input type=text maxLength="10" size=20 name="account"></td>
        </tr>
        <tr>
        <td align="right">姓名：</td>
        <td align="left"><input type=text maxLength="20" size=20 name="name"></td>
        </tr>
        <tr>
        <td align="right">密碼：</td>
        <td align="left"><input type=text maxLength="10" size=20 name="password"></td>
        </tr>
        <tr>
        <td align="right">電話：</td>
        <td align="left"><input maxLenth="10" size=20 name="phone" type="text"></td>
        </tr>
        <tr>
        <td align="right">種類：</td>
        <td align="left">
            <input value=1 type=radio name="kind" checked>校內
            <input value=0 type=radio name="kind">校外
        </td>
        </tr>
        <tr>
        <td align="right">校內ID：</td>
        <td align="left" ><input type=text maxLength="10" size=20 name="SID"></td>
        </tr>
        <tr>
        <td align="right">Email：</td>
        <td align="left"><input type=text maxLength="50" size=20 name="eMail"></td>
        </tr>
        <tr>
        <td align="right">地址：</td>
        <td align="left"><input type=text maxLength="100" size=20 name="address"></td>
        </tr>
        <tr>
        <td align="right">營業時間：</td>
        <td align="left"><input type=text size=20 name="opentime"></td>
        </tr>
        <tr>
        <td align="right">類型：</td>
        <td align="left"><input type=text maxLength="100" size=20 name="type"></td>
        </tr>
    </table>
    <p>
    <input value+"註冊" type="submit">
    <input value+"清除" type="reset">
     </p>
    </center>
</body>
</html>