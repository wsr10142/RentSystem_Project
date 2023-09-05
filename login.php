<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َ登入</title>
    <link rel="stylesheet" href="login.css">
    <? session_start(); ?>
  </head>

  <body>
      <div class="container">
        <div class="navbar">
          <a href="home.html">
              <img src="img/logo.png" class="logo">
          </a>
         </div>
      </div>

      <form class="box" action="" method="post">
        <h1>登入</h1>
        <input type="text" name="usr_account" placeholder="帳號">
        <input type="password" name="usr_pwd" placeholder="密碼">

        <input type="submit" name="" value="登入">
        <a href=applyAct.php>申請帳號</a>
        <a href=ForgotPasswordACT.php>忘記密碼了嗎?</a>
      </form>

      <?php
          include("connect.php");
        
          //接收使用者輸入的帳號跟密碼
          $usr_account=$_POST["usr_account"];
          $usr_pwd=$_POST["usr_pwd"];
          
          $select_db=@mysql_select_db("ors");//選擇資料庫
          if($usr_account!=NULL&&$usr_pwd!=NULL)
          {
            if(!$select_db)
            {
              echo '<br>找不到資料庫!<br>'; 
            }
            else
            {
              //尋找資料庫中是否有相符的帳號及密碼
              $sql_query="select * from user where account='".$usr_account."'and password='".$usr_pwd."'";
              $result=mysql_query($sql_query);
        
              //沒有相符
              if(mysql_num_rows($result)==0)
              {
                echo '帳號/密碼錯誤';
              }
        
              //帳號密碼一樣，導引至網站首頁
              else
              {
                $_SESSION['usr_login']=$usr_account;
                header("Location:home.php");
                exit;
              }
            }
          
          }
          ob_end_flush();
    ?>
  </body>
</html>
