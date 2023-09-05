<html>
<head>
    <title>帳號申請</title>
    	<?php
        	session_start();
        	ob_start();
    	?>
</head>
    <!--- 顯示高雄大學標誌，可連結到網站首頁 --->
    <a href="home.php">國立高雄大學</a>

    <!--- 登入按鈕 --->
    <a href="login.php">Login</a>

<body>

    <center>
	<!-- 網頁最上方的標題 -->
	<h1>申請帳號</h1>
	<!-- 網頁小標 -->
	<h2>請填寫以下資料</h2>

    <form method="POST" action="applyActRecieve.php">
    <table border="0">
        <tr>
        <td align="right">帳號:</td>
        <td align="left"><input type=text maxLength="10" size=20 name="account"></td>
        </tr>
        <tr>
        <td align="right">姓名:</td>
        <td align="left"><input type=text maxLength="20" size=20 name="name"></td>
        </tr>
        <tr>
        <td align="right">密碼:</td>
        <td align="left"><input type=text maxLength="10" size=20 name="password"></td>
        </tr>
        <tr>
        <td align="right">電話:</td>
        <td align="left"><input maxLenth="10" size=20 name="phone" type="text"></td>
        </tr>
        <tr>
        <td align="right">種類:</td>
        <td align="left">
            <input value=1 type=radio name="kind" checked>校內
            <input value=0 type=radio name="kind">校外
        </td>
        </tr>
        <tr>
        <td align="right">校內ID:</td>
        <td align="left"><input type=text maxLength="10" size=20 name="SID"></td>
        </tr>
        <tr>
        <td align="right">Email:</td>
        <td align="left"><input type=text maxLength="50" size=20 name="eMail"></td>
        </tr>
        <tr>
        <td align="right">地址:</td>
        <td align="left"><input type=text maxLength="100" size=20 name="address"></td>
        </tr>
    </table>
    <p>
    <input value+"註冊" type="submit">
    <input value+"清除" type="reset">
     </p>
    </center>
    
</body>
</html>