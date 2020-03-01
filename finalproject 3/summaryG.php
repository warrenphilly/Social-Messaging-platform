<?php
  session_start();
  if($_SESSION['login']!='yes'){
    header("location:index.php");
  }
  include_once 'dbmsu.php';
 ?>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="page.css">
  </head>

  <body>
<!--container div-->
    <div id="container">
<!--left div(navbar)-->
      <div id="left_bar">

        <center><p id="banner">HoneyComb</a></center>
        <br/>
        <center>
<!--user navigation bar-->
        <br/>
        <button id="new_message" onclick="on()">create message</button>
		    <div class="link" id="mymessage"><a href="myMessageG.php">My Message</a></div>
        <br/>
        <div class="link" id="messageSum"><a href="summaryG.php">Message summary</a></div>

        <br/>
        <div class="link" id="aboutus"><a href="aboutusG.php">About us</a></div>
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
    				$username4=$_SESSION['u_name'];
    				$counter=1;
    				$moreloads=0;
    				$sql="SELECT id FROM message WHERE receipentent ='$username4'ORDER BY id DESC ;";
    				$result=mysqli_query($conn,$sql);
    				  $save = array(0);
    				if(mysqli_num_rows($result)>0){
    				  while($row=mysqli_fetch_array($result)){

    					 $save[$counter]=$row['id'];
    					 $counter++;
    				  }
    				  $moreloads=$counter-1;
    				  }
    				 else{
    				 $save=0;
    				 }
  				?>
        </div>
        <center><c<p id="my_mess"> Message Summary</p></center>



<!--functionality for messages-->
<center>
<div id='sum'>

    	  <?php
      		  $counter=1;
      			 $sql="SELECT id FROM message WHERE receipentent ='$username4'AND state='False'ORDER BY id DESC ;";
      				$result=mysqli_query($conn,$sql);
      				  $save = array(0);
      				if(mysqli_num_rows($result)>0){
      				  while($row=mysqli_fetch_array($result)){

      					 $save[$counter]=$row['id'];
      					 $counter++;
      				  }
      				  }
      				  $unread=$counter-1;
      				  $counter=1;
      				  $sql="SELECT id FROM message WHERE username ='$username4'ORDER BY id DESC ";
      				$result=mysqli_query($conn,$sql);
      				  $save = array(0);
      				if(mysqli_num_rows($result)>0){
      				  while($row=mysqli_fetch_array($result)){

      					 $save[$counter]=$row['id'];
      					 $counter++;
      				  }
      				  }

      			$sent=$counter-1;
            echo "<center>";

      				 	  echo "<p class='sumnum'>You have" .$moreloads." messages</p>";
      			  	  echo"<p class='sumnum'> You have marked ".$unread." as read</p>";
      					  echo"<p class='sumnum'> You have sent ". $sent." Messages</p>";

    			?>
        </center>
      </div>
    </center>
      </div>
<!--end of middle bar-->
<!--overlay message functionality-->
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
  </div>
<!--end of container-->
  </body>
<!--end of page-->
</html>
