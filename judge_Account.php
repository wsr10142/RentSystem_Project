<?php

    $select_db=@mysql_select_db("ors");
    if(!$select_db)
    {
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {   
    ?>

        <!--- 顯示高雄大學標誌，可連結到網站首頁，就是minsi的高雄大學圖標連結 --->
        <a href="home.php">國立高雄大學</a>

    <?
        //找account所屬的身分別，導引到不同的功能頁面
        $sql_query="select type from user where account='".$usr_account."'";
        $result=mysql_query($sql_query);
        $row=mysql_fetch_array($result);

        //場地管理員
        if(strcmp($row[0],"場地管理員")==0)
        {
        ?>   
            <a href="venue_home.php">hey</a>
        <?
        }

        //出納人員
        else if(strcmp($row[0],"出納人員")==0)
        {
        ?>    
            <a href="cash_home.php">hey</a>
        <?
        }

        //系統管理員
        else if(strcmp($row[0],"系統管理員")==0)
        {
        ?>
            <a href="system_home.php">hey</a>
        <?
        }

        //租借人
        else if(strcmp($row[0],"租借人")==0)
        {
        ?>
            <a href="rent_home.php">hey</a>
        <?
        }
		?>
        <!--- 登出按鈕 --->
        <a href="home.php?logout=1">Logout</a>
        <?
    }
?>
