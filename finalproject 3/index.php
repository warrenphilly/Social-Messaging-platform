<?php
session_start();
 ?>
<DOCTYPE html>
<html>

  <head>
    <link href="myIndex.css" rel="stylesheet" type="text/css">

    <title> Welcome HoneyComb</title>


  </head>

  <body>
<!--login portion of page-->
    <div id="login">
        <div id="login_container">
          <center>
            <p id="aLogo">HoneyComb</p>
            <img src="myLogo.png" height="40" width="40px">
            <p>communicate with collegues</p>
            <?php
              if(isset($_GET['error'])){
                if($_GET['error']=="noinfo"){
                  echo '<center><p class="signuperror">*please check login information*</p></center>';
                }
                elseif($_GET['error']=="nouserfound"){
                  echo '<center><p class="signuperror">*Username does not exsist*</p></center>';
                }
                elseif($_GET['error']=="wrongpassword"){
                  echo '<center><p class="signuperror">*Incorrect password*</p></center>';
                }
              }
            ?>
            </center>
            <div id="user_info">

              <form id="input_data" action="myLogin.php" method="POST">
                  <input id="leUsername" type="text" class="credential" placeholder="username" name="userName">
                  <br/>
                  <br/>
                  <input id="password" type="password" class="credential" placeholder="password" name="passWord">
                  <br/>
                  <br/>
                  <br/>
                  <br/>
                  <br/>
                  <br/>
                  <input type="submit" name="login-submit" id="submit" value="Log In">
              </form>
        <center><p>Don't have an account?Sign up <a id="here" href ="signup.php">here</a></p>
      </div>
    </div>
<!--end of login portion of page-->












<!--javascript code-->
    <script type="text/javascript">
    //script for red circle
    document.getElementById("red").onclick =function()
    {
      document.getElementById("signup_container").style.display="none";
    }
    document.getElementById("blue").onclick =function()
    {
      var elem = document.getElementById("signup_container");
      elem.style.display="block";
    }
    </script>
<!--end of javascript code-->

  

  </body>
<!--end of page code-->
</html>
