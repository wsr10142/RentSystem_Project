<head>
<title>ph連接資料庫</title>
</head>

<?php
            include("connect.php");    //連接資料庫
?>
<body>
<?php

    $userID=$_GET["Kinds"];
    $Area=$_GET["Area"];
//    $kinds=$_GET["kinds"];
//    $=$_GET[""];


    echo'<p>userID:'.$userID.'<br>';
    echo'<p>Area:'.$Area.'<br>';
//    echo'<p>kinds:'.$kinds.'<br>';
//    echo'<p>:'..'<br>';

    echo'<br>This is my php test.<br>';
    $select_db = mysql_select_db("databasefinalproject");
    if(!$select_db)
    {
        echo'<br>找不到資料庫<br>';
    }
    else
    {
        $sql_query="INSERT INTO rented VALUES('".$usrid."','".$Area."')";//SQL語法
        mysql_query($sql_query);

        echo'<br>初步申請成功!!<br>';

    }
?>

</body>