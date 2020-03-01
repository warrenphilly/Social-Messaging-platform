<?php
  session_start();
  if($_SESSION['login']!='yes'){
    header("location:index.php");
  }
  include_once 'dbmsu.php';
 ?>
<html>
  <head>
    <link href="page.css" rel="stylesheet" type="text/css">
    <style type="text/css">
      #admin_nav a{
        margin-right: 20px;
        text-decoration: none;



        padding-right: 30px;
        padding-top: 10px;
        padding-bottom:10px;

      }
      #users{
        color:#BEA3BE;
        border-right:1px solid grey;
      }
      #gengen{
        color:#A59CA7;
        border-right:1px solid grey;
      }
      #del{
        color:#BEA3BE;
      }
      #search_mess{
        color:#BEA3BE;
        border-right:1px solid grey;
      }
      #admin_nav a:hover{
        margin-right: 20px;
        text-decoration: none;

        color:#A59CA7;

        padding-right: 30px;
        padding-top: 10px;
        padding-bottom:10px;

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
          echo "<div class='cred'>";
          echo "<span id='uSer'>".$_SESSION['u_name']."</span>";

          echo "</div >";
          echo "<div class='cred'>";
          echo "<div id='iffy' <span> Logged in&#8211;</span>".$_SESSION['role']."</div>";
          echo "</div>";
      			?>

        </div>
        <div  id="admin_nav">
          <a class="admin-button" id="users"href="fuser.php">users</a>
          <a class="admin-button" id="search_mess"href="searchM.php">search messages</a>
          <a class="admin-button" id="gengen"href="admin.php">generate company id</a>

          <a class="admin-button" id="del"href="delete.php">delete messages</a>


        </div>
        <div id="page_content">
          <center>
          <form id="generate" action="admin.php" method="POST">
            <p>Enter guest number here(7 characters)</p><br/><input class="geno"type="text" placeholder="ID number" maxlength="7" name="compID">
            <p>Enter admin number here(7 characters)</p><br/><input class="geno"type="text" placeholder="ID number" maxlength="7" name="adminID">
            <br/>
            <br/>
            <input  id="generate" type="submit" value="generate numbers" name="submit">
          </form>

          <table id="customers">
            <tr>
              <th>Guest ID</th>
              <th>Admin ID</th>
              <th>Active IDs</th>
            </tr>
            <tr>
          <?php
          if(isset($_POST["submit"])){
            $cId=$_POST['compID'];
            $aId =$_POST['adminID'];




            $sql = "INSERT INTO adminNo (adminId)
            VALUES ($aId)";
            $result = $conn->query($sql);

            $sqla = "INSERT INTO companyID (companyId)
            VALUES ($cId)";
            $resulta = $conn->query($sqla);
          }



          ?>
          <td>
          <?php

            $sql= "SELECT companyId FROM companyID ";
            $result = $conn->query($sql);
            if ($result-> num_rows >0){
              while($row = $result->fetch_assoc()){
                echo $row["companyId"]."<br/>";

              }
            }

           ?>
         </td>
         <td>
         <?php

           $sql= "SELECT adminId FROM adminNo ";
           $result = $conn->query($sql);
           if ($result-> num_rows >0){
             while($row = $result->fetch_assoc()){
               echo $row["adminId"]."<br/>";

             }
           }

          ?>
        </td>
        <td>
          <?php
          $sql= "SELECT companyId FROM users";
          $result = $conn->query($sql);
          if ($result-> num_rows >0){
            while($row = $result->fetch_assoc()){
              echo $row["companyId"]."<br/>";

            }
          }
          ?>
        </td>
         </tr>
        </table>
        </center>
        </div>


      </div>

        <!--end of middle div-->

          <!--right div(chatroom)-->



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
      echo "<option> everyone </option>";
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

                  <input id="send" class="navigate " name="message_submit" type="submit" value="Send">
                </center>
                </div>
              </form>
              <button id="discard" onclick="off()" class="navigate " name="discard"id="discard" > Discard</button>
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
