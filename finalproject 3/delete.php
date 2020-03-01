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
        color:#BEA3BE;
        border-right:1px solid grey;
      }
      #del{
        color:#A59CA7;
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
        <div class="link" id="searchMess"><a href="fuser.php">Admin</a></div>
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
            <p id="my_mess">Delete Notice</p>
          <form action="delete.php" method="POST">
          <input id="searchM" type="text" name="search" placeholder="enter notice title">

            <input id="gene" value="delete" type="submit" name="sub-search">
          </center>
          </form>
          <center>

          <?php
            include 'dbmsu.php';

            if(isset($_POST['sub-search'])){
              $search =mysqli_real_escape_string($conn, $_POST['search']);
              if(empty($search)){
                header("Location: searchM.php?error=noresultsfound");

                exit();
              }
              else{
              $sql = "SELECT * FROM message WHERE title LIKE'%$search%' AND receipentent='everyone'";
              $result= mysqli_query($conn, $sql);
              $queryResult = mysqli_num_rows($result);
              if($queryResult > 0){
                echo "this notice has been deleted";


              $sql = "DELETE FROM message WHERE title LIKE'%$search%' AND receipentent='everyone'";
              $result= mysqli_query($conn, $sql);
              }
              else {
                header("Location: searchM.php?error=nomatch");
                exit();
              }
            }
          }
           ?>
           <?php
             if(isset($_GET['error'])){
               if($_GET['error']=="noresultsfound"){
                 echo '<center><p class="signuperror">*Please enter a valid value into the search field*</p></center>';
               }
               elseif($_GET['error']=="nomatch"){
                 echo '<center><p class="signuperror">*Unable to find results that match your search*</p></center>';
               }

             }
           ?>
           <table  id="accMessages" style="width:480px">
             <?php
                                    //creates counter variable
                                     //since a load has been used one less is available
                 $sql="SELECT * FROM message WHERE receipentent='everyone'" ;   //outputs all messages that have the specific id that is in the save array index counter this index starts at 1
                 $result=mysqli_query($conn,$sql);                       //runs the sql query
                 if(mysqli_num_rows($result)>0){                         //if they are any message rows with the ids that were recieived the below code is then ran
                   while($row=mysqli_fetch_assoc($result)){
                     $ftitle=$row['title'];
                     $fmess=$row['message'];
                     $fdate= date('F d, Y',strtotime($row['Date']));
                     $fuser= $row['username'];
                                                  //echoes the table row html code
                       echo"<td>";
                         echo"<div class='inside'>";
                           echo"<p><b>Title:&nbsp </b>".$ftitle."</p>";
                           echo"<div class='inner'>";
                             echo"<p></hr><b> Message </b><br/>".$fmess."</p>";
                           echo"</div>";
                           echo"<p> </br><b>  Sent:&nbsp  </b>".$fdate.
                           "</br><b> By user:&nbsp </b>".$fuser."<span>&#8211;</span>".$_SESSION['role']."</p>";
                            echo "<br/>";
                            echo"<tr>";
                          echo"</div>";
                       echo"</td>";

                       }
                 }



                 //got to access info from database load message delete from db queue n repeat
             ?>
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
