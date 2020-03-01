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

<!--sign up overlay-->
    <div id="signup_container" >
        <div id="myAnimation">
          <div id="suTitle"><p >Sign Up</P></div>
            <?php
              if(isset($_GET['error'])){
              if($_GET['error']=="emptyfields"){
                echo '<center><p class="signuperror">*Some fields have not been filled in*</p></center>';
              }
              elseif($_GET['error']=="invalidfirstnameandemail"){
                echo '<center><p class="signuperror">*Invalid email address and username*</p></center>';
              }
              elseif($_GET['error']=="invalidemail"){
                echo '<center><p class="signuperror">*Invalid email address*</p></center>';
              }
              elseif($_GET['error']=="invalidusername"){
                echo '<center><p class="signuperror">*Invalid username*</p></center>';
              }
              elseif($_GET['error']=="passwordcheck"){
                echo '<center><p class="signuperror">*Passwords do not match*</p></center>';
              }
              elseif($_GET['error']=="passwordcheck"){
                echo '<center><p class="signuperror">*Passwords do not match*</p></center>';
              }
              elseif($_GET['error']=="usernamealreadytaken"){
                echo '<center><p class="signuperror">*This username is already in use</p></center>';
              }
            }
             ?>
          <form id="input_data" action="mySignup.php" method="POST">
              <input id="leUsername" type="text"class="signup" placeholder="username" name="sUsername">
              <input id="password" type="text" class="signup"  placeholder="First Name" name="firstname">
              <br/>
              <br/>
              <input id="leUsername" type="text" class="signup" placeholder="Email Address" name="emailAddress">
              <input id="password" type="text" class="signup" placeholder="Last Name" name="lastname">
              <br/>
              <br/>
              <input id="leUsername" type="password" class="signup" placeholder="Password" name="sPassword">
              <input id="password" type="text" class="signup" placeholder="Occupation" name="occupation">
              <br/>
              <br/>
              <input id="leUsername" type="password" class="signup" placeholder="Retype Password" name="rPassword">
              <input id="password" type="text" class="signup"	placeholder="Company Identafication Number" name="id">
              <br/>
              <br/>
              <br/>
              <br/>
              <input type="submit" name="signup-submit" id="suSubmit" value="Sign Up">

          </form>
          <center><p>Already a have an account? Click <a  id="here" href="index.php">here</a></p></center>
        </div>
      </div>
<!--end of signup overlay-->


    

  </body>
<!--end of page code-->
</html>
