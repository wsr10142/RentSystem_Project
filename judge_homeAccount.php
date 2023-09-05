<html>
    <head>
        <meta name = "viewport" content = "width=device-width, initial-scale = 1.0" http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>校內租借系統</title>
        <link rel="stylesheet" href="LandingPage.css">
<?php

    $select_db=@mysql_select_db("ors");
    if(!$select_db)
    {
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {   
        //找account所屬的身分別，導引到不同的功能頁面
        $sql_query="select type from user where account='".$usr_account."'";
        $result=mysql_query($sql_query);
        $row=mysql_fetch_array($result);

        //場地管理員
        if(strcmp($row[0],"場地管理員")==0)
        {
        ?>
            <a href="venue_home.php" class="card card2">
            <h3>場地管理員</h3>
            </a>
        <?
        }

        //出納人員
        else if(strcmp($row[0],"出納人員")==0)
        {
        ?>
            <a href="cash_home.php" class="card card2">
            <h3>出納人員</h3>
            </a>
        <?
        }

        //系統管理員
        else if(strcmp($row[0],"系統管理員")==0)
        {
        ?>
            <a href="system_home.php" class="card card2">
            <h3>系統管理員</h3>
            </a>
        <?
        }

        //租借人
        else if(strcmp($row[0],"租借人")==0)
        {
        ?>
            <a href="rent_home.php" class="card card2">
            <h3>租借功能列</h3> 
            </a>
        <?
        }
    }
?>