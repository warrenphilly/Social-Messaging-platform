<?php
  session_start(); //starts the session
  if($_SESSION['login']!='yes'){
    header("location:index.php");
  } //checks to see if the user is logged in
  include_once 'dbmsu.php';  //includes the database in the page
 ?>
<html>
  <head>
    <!--css link(dont forget to refresh browser cache if css does not load{shift-cmd-r})-->
    <link href="page.css" rel="stylesheet" type="text/css">

    <!-- title of page-->
    <title>HoneyComb</title>
  </head>

  <body>

    <div id="container"> <!--container div-->

<!--left div(navbar)-->
      <div id="left_bar">
        <!--the big logo for honey comb-->
        <center><p id="banner">HoneyComb</a></center>
        <br/>
        <center>
        <!--links to other pages-->
        <br/>
        <button id="new_message" onclick="on()">create message</button>
		    <div class="link" id="mymessage"><a href="mmyMessage.php">My Message</a></div>
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

<!--middle div(message/unread message combobox)-->
      <div id="middle_bar">

              <div id="my_user"> <!--the top div that displays the users name -->

            		<?php
                  echo "<div class='cred'>";
                  echo "<span id='uSer'>".$_SESSION['u_name']."</span>";

                  echo "</div >";
                  echo "<div class='cred'>";
                  echo "<div id='iffy' <span> Logged in&#8211;</span>".$_SESSION['role']."</div>";
                  echo "</div>";
                   //displays the name of the user gives a sense of home
          				$username4=$_SESSION['u_name']; //puts the username in a variable
          				$counter=1;	                       //creates counter variable
          				$moreloads=0;                      //creates moreloads variable this determines how many more times elements in the table are created
          				$sql="SELECT id FROM message WHERE  receipentent ='everyone'OR receipentent ='$username4' AND state='False'ORDER BY id DESC ;"; //queries the database to ouput all ids that have the receipentent being the user and are not read yet
          				$result=mysqli_query($conn,$sql);  //runs the sql query
          				  $save = array(0);             //declares a array called save
          				if(mysqli_num_rows($result)>0){                   //determines if they are any messages sent to you
          				  while($row=mysqli_fetch_array($result)){           //runs a loop that puts each id into the save array and puts into the counter index and adds one since it is a while loop
          					 $save[$counter]=$row['id'];
          					 $counter++;
          				  }
          				  $moreloads=$counter-1;            //subtracts one from counter and sets moreloads this is done because counter starts at 1
          				  }
          				 else{       //if they are no messages sent to you it does this
          				     //nothing hahaha
          				 }
          				?>
                </center>
              </div>  <!--ends the my user div-->

              <center>
                <br/>
              <p id="my_mess">My Messages </p>

        		<form action="unread.php" method="POST">   <!--makes a form that is sent to the unread.php page -->

        		  <select id='choose' name="read">
                <?php  include_once 'dbmsu.php';
                  $counter=1;                //updates the counter variable ressetting the 1st one cause that variable is basically done with
                  $combo= array(0);
                        //creates a como array
                  $sql="SELECT title FROM message  WHERE receipentent='$username4' AND state='False'ORDER BY id DESC;";  //outputs all the titles that are sent to the user that are not read
                  	$result=mysqli_query($conn,$sql);  //runs the query
                  	if($result=$conn->query($sql)){   //uses the point object
                    	if ($result->num_rows){          //
                    		while($row=$result->fetch_object()){ // this basically puts all the ouputs into a option in the combo box
                    			$mcombo.="<option >".$row->title."</option>"; //this puts the option html tags and then the row of title from database sandwiched between
                    		}$result->free();            //this runs more object code
                    	}
                  	}
                  $mcombo.="</select>";      //this stores the variable plus the code behind it the .= allows for this
                  echo $mcombo;                     //this echoes out the  options plus select behind it
                ?>
              <input id= "laRead"type="submit"value="mark as read"name="read_submit">  <!--submits the combo box -->
            </form>
            <!--closes form-->

            <!--Table that contains messag boxes-->
          <table  id="accMessages" style="width:480px">
            <?php
              $counter=0;             //sets the counter variable once again to 0
              while($moreloads>0){                   //whilest there are not 0 messages it will continue to load from the database
                $counter=$counter+1;                 //updates counter
                $moreloads-=1;                        //since a load has been used one less is available
                $sql="SELECT * FROM message WHERE id='$save[$counter]'" ;   //outputs all messages that have the specific id that is in the save array index counter this index starts at 1
                $result=mysqli_query($conn,$sql);                       //runs the sql query
                if(mysqli_num_rows($result)>0){                         //if they are any message rows with the ids that were recieived the below code is then ran
                  while($row=mysqli_fetch_assoc($result)){
                    $ftitle=$row['title'];
                    $fmess=$row['message'];
                    $fdate= date('F d, Y',strtotime($row['Date']));
                    $fuser= $row['username'];
                    $frole= $row['role'];
                                                 //echoes the table row html code
                      echo"<td>";
                        echo"<div class='inside'>";
                          echo"<p><b>Title:&nbsp </b>".$ftitle."</p>";
                          echo"<div class='inner'>";
                            echo"<p></hr><b> Message </b><br/>".$fmess."</p>";
                          echo"</div>";
                          echo"<p> </br><b>  Sent:&nbsp  </b>".$fdate.
                          "</br><b> By user:&nbsp </b>".$fuser."<span>&#8211;</span>".$frole."</p>";
                           echo "<br/>";
                           echo"<tr>";
                         echo"</div>";
                      echo"</td>";

                      }
                }
                else{
                  echo"Be more social </br> you have no messages";
                }
              }

                //got to access info from database load message delete from db queue n repeat
            ?>
          </table>
          </center>
      </div>
<!--end of middle div-->

<!--div containing message overlay-->
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

<!--javascript for overlay-->
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
<!--end of page-->
</html>
