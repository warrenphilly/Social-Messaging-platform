<?php
  session_start();
  if($_SESSION['login']!='yes'){
    header("location:index.php");
  }
  include_once 'dbmsu.php';
 ?>
<html>
  <head>
    <link href="messages.css" rel="stylesheet" type="text/css">
    <style type="text/css">
    body{
      margin:0px;
      padding:0px;
      font-family: Helvetica;

    }
    #container{
      height:100%;
    }
    #left_bar{
      border-right:1px solid #D3D3D3;
      float:left;
      background-color: white;
      width:210px;
      height:100%;

    }
    #banner{
      font-size: 30px;
      color:#908690;
    }
    #left_bar a{
      text-decoration:none;
      padding-top: 25px;
      margin-left:0px;
      color:#ADA5A5;
      font-size:22px;
      border-bottom: 1px solid #D3D3D3;
      padding-bottom: 20px;

    }
    #left_bar a:hover{
      text-decoration:none;
      padding-top: 25px;
      margin-left:0px;
      color:#8E659D;
      font-size:22px;

    }
    .search{
      margin-top:20px;
      width:320px;
      height:50px;
      border-top:none;
      border-left:none;
      border-right:none;
      margin-left: 20px;
      font-size:27px;
    }


    #middle_bar{
      float:left;
      border-right:1px solid #D3D3D3;
      width:480px;
      height:100%;


    }
    #right_bar{
      float:left;
      border-right:1px solid #D3D3D3;
      width:587px;
      height:100%;
    }
    .link{
      color:#ADA5A5;
      margin-bottom:20px;


    }
    .link a:hover{
      color:#BEA3BE;
      transition: 0.7s all;
    }
    #new_message{
      height:50px;
      width:150px;
      border-radius:50px ;
      margin-left:10px;
      background-color: #BEA3BE;
      color:white;
      margin-top:0px;
      margin-bottom:45px;
      cursor:pointer;
      font-size:18px;
    }

    #logout{
      background-color:#CBC6D0;
        color: white;
        width: 90px;
        padding: 90px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border-radius:50px ;
    }

    #Placeholder{
      font-size: 30px;
      margin-top:290px;
      color:#BEA3BE;
    }
    #aboutus{
      border-bottom: none !important;
    }
    #my_user{
      height:70px;
      width:440px;
      background-color:#BEA3BE;
      color:white;
      font-size: 30px;
      padding-left:40px;
      padding-top:20px;
    }
    #overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 2;

    cursor: pointer;
}

#message{
    background-color:none;
    height:540px;
    border-radius: 34px 34px 34px 34px;
    width:500px;
    position: absolute;
    top: 50%;
    left: 50%;
    color: white;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
    padding:0px;
}
  #message_content{

    height:290px;
    width:500px;
    font-size: 17px;
    border-left: none;
    color:#9C939E;
    border-right: none;
    border-top: none;
    padding-left: 10px;
    border-bottom: none;
    background-color:#E2E1E3;
  }
  #message_content::placeholder {
    color: #9C939E;

}
  #user_here
  {
    padding-left: 10px;
    width:500px;
    height:63px;
    font-size: 20px;
    background-color:#A59CA7;
    border-left: none;
    border-right: none;
    border-top: none;
    color:#E2E1E3;
    border-bottom: none;
  }
  #user_here::placeholder {
    color: #E2E1E3;
    opacity: 0.7;
}
  #title::placeholder {
    color: #9C939E;
    opacity: 0.7;
}
  #title{
    padding-left: 10px;
    width:500px;
    font-size: 25px;
    border-left: none;
    border-right: none;
    border-top: none;
    border-bottom: none;
    height:63px;
    background-color:#E2E1E3;
    color:#9C939E;
    border-bottom: 1px solid #BFBABA;
    border-length:50px;
  }
  #message_title{

    padding-top: 2px;
    padding-bottom: 30px;
    padding-left: 10px;
    font-size: 35px;
    background-color:#DCCFE0;
    margin:0px;
    height:54px;
    border-radius: 34px 34px 0px 0px;
    color:#9C939E;
  }
  #button_div{
    height:50px;
    width:500px;
    border-radius: 0px 0px 34px 34px;
    background-color:#E2E1E3;
    padding-bottom:25px;

  }
  .navigate{
    height:60px;
    width:170px;
    color:white;
    font-size: 28px;
    border:none;
    background-color:#A18DA5;
    border-radius: 34px 34px 34px 34px;
  }
  #discard{
    margin-right:70px;
  }
    </style>
  </head>

  <body>
    <!--container div-->
    <div id="container">
      <!--left div(searchbar/navbar)-->
      <div id="left_bar">

        <center><p id="banner">HoneyComb</a></center>
        <br/>
        <center>
        <button id="new_message" onclick="on()">create message</button>


        <br/>
        <div class="link" id="myMessages"><a href="mmyMessage.php">my messages</a></div>
        <br/>
        <div class="link" id="messageSum"><a href="summary.php">Message summary</a></div>
        <br/>
        <div class="link" id="searchMess"><a href="admin.php">Admin</a></div>
        <br/>
        <div class="link" id="aboutus"><a href="aboutus.php">About us</a></div>
        <br/>
        <a id="logout" href="logout.php">logout</a>
      </center>
      </div>
            <!--end of left div-->

          <!--middle div(searchbar/conversations)-->
      <div id="middle_bar">

        <div id="my_user">
          <?php
                  echo $_SESSION['u_name'];
      			?>

        </div>
        <input type="text" class="search" placeholder="Search" >
      </div>
        <!--end of middle div-->

          <!--right div(chatroom)-->
      <div id="right_bar">
          <!--end of right div-->
          <center><div id="Placeholder"><p >no message selected</p></div></center>


    </div>

    <div id="overlay" >


            <div id="message">
              <form action="sendmessage.php" method="POST">
                <div id="message_title"><p>Create a message</p></div>
      		  <select id="user_here" name="reci">
      <?php  include_once 'dbmsu.php';
      $combo= "";
      $sql="SELECT username FROM users ORDER BY username ASC";
      if($result=$conn->query($sql)){
      	if ($result->num_rows){
      		while($row=$result->fetch_object()){
      			$combo.="<option>".$row->username."</option>";
      		}$result->free();
      	}
      }
      $combo.="</select>";
      echo $combo;
       ?>
      	<!--	    <select id="user_here" name="reci">
          <option value="">                   </option>
          <option value="saab">Saab          </option>
          <option value="fiat">Fiat           </option>
          <option value="audi">Audi               </option>
        </select> -->

                <br/>
                <input id="title" type="text" name="title" placeholder="Title"  maxlength="1000">
                <br/>
                <textarea rows="4" cols="50" name="mage" id="message_content" placeholder="Message goes here"></textarea>
                <br/>
                <div id="button_div">
                  <center>
                  <button class="navigate " name="discard"id="discard" > Discard</button>
                  <input class="navigate " name="message_submit" type="submit" value="Send">
                </center>
                </div>
              </form>
            </div>
          </div>



    </div>



<script>
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}
</script>


    <!--end of container-->
  </body>

</html>
