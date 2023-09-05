<!--  出納組介面  -->
<?
    session_start();
    include("connect.php");    //連接資料庫

    //接收目前登入中的帳號
    $usr_account=$_SESSION['usr_login'];

    //判斷各個功能頁中的帳號身分別
    include("judge_Account.php");
    
    $select_db=@mysql_select_db("ors");
    //$userID=$_GET["id"];
    //$password=$_GET["password"];
   
    $receipt_No=$_GET["OrderNo"];
    
    $account_belong=$_GET["account_belong"];
    $c_Num=$_GET["c_Num"];
    $b_Num=$_GET["b_Num"];
    $person_Num=$_GET["person_Num"];
    $tax_ID=$_GET["tax_ID"];
    $venueOrNo=$_GET["venueOrNo"];
    $time=$_GET["time"];
    //echo $receipt_No;
    //echo $c_Num;
    //echo $b_Num;
    //echo $person_Num;
    $EP=$_GET["EP"];
    echo 'EP:' .$EP;

    if(!$select_db)
    {
        echo'<br>找不到資料庫<br>';
        echo"<p><a href=FinalProjectLogin.php?>返回</a></p>";
    }
    else
    {

            $sql_query="UPDATE receipt SET cashierOrNo = 1 WHERE receipt_No='". $EP ."'";

            
            $result=mysql_query($sql_query);
                            $sql_query="SELECT * FROM receipt";
                            $result=mysql_query($sql_query);
                            
                            //echo '資料筆數:' .mysql_num_rows($result). '<br>' ;
                            echo '<table border=1 >';
                            echo '<tr>';
                            echo '<th>訂單編號</th>';
                            echo '<th>訂單所有者</th>';
                            echo '<th>烤肉區數量</th>';
                            echo '<th>露營區數量</th>';
                            echo '<th>總人數</th>';
                            echo '<th>統一編號</th>';
                            echo '<th>繳費確認</th>';
                            echo '<th>是否審核訂單</th>';
                            echo '<th>申請時間</th>';
                            echo '</tr>';
                            
                            while($row=mysql_fetch_array($result)){
                                echo '<tr>';
                                echo '<td><input type=hidden name="OrderNo" value='.$row[0].'>'.$row[0];
                                echo '<td>'.$row[1].'<name="account_belong">';
                                echo '<td>'.$row[2].'<name="c_Num">';
                                echo '<td>'.$row[3].'<name="b_Num">';
                                echo '<td>'.$row[4].'<name="person_Num">';
                                echo '<td>'.$row[5].'<name="tax_ID">';
                                echo '<td>'.$row[6].'<name="EP"> <!--繳費是否通過-->'; 
                                echo '<td>'.$row[7];
                                echo '<td>'.$row[8];
                                
                        }
                        echo'</table>';
        echo '
        <p><a style="
        border:2px solid white;
        border-radius:23px;
        padding: 2px 8px;
        font-size: 20px;
        background-color: white; 
        color: black;" href=cashier.php?id='.$userID.'&password='.$_GET["password"].'>繳費</a></p></input>';
        echo '
        <p><a style="border:2px solid white;
            border-radius:23px;
            padding: 2px 8px;
            font-size: 20px;
            background-color: white;
            color: black;" href= MakePDF.php?EP='.$EP.'>產生PDF</a></p>';
    }    

?>
<form method="get" action="SelectionRecieve.php">

</form>