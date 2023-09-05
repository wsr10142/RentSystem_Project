<html>
<head>
    <title>布告欄</title> 
</head>

<body>
    <!--- 顯示高雄大學標誌，可連結到網站首頁，就是minsi的高雄大學圖標連結 --->
    <a href="home.php">國立高雄大學</a>


<!--- 接收board_no的變數，顯示該公告內容--->
<?php
    include("connect.php");

    $no=$_GET['board_No'];

    $select_db=@mysql_select_db("ors");
        
    //資料庫存取debug
    if(!$select_db)
    {
        echo '<br>找不到資料庫!<br>'; 
    }
    else
    {
        $sql_query="select title,message from board where board_No='".$no."'";
        //執行sql語法
        $result=mysql_query($sql_query);
        $row=mysql_fetch_array($result);
        ?>
        <table>

        <!---公告的標題--->
        <tr>
            <td>
                <? echo $row[0] ?>
            </td>
        </tr>

        <!---公告的內容--->      
        <tr>
            <td>
                <? echo $row[1] ?>
            </td>
        </tr>
        <td><a href="show_board.php">返回公佈欄</a></td>
        </table>
        <?
    }
?>
</body>
</html>