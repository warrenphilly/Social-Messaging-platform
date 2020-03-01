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

  				?>
        </div>

        <div id="content">

          <
            <center>
            <div id="welcome">

              <h2>About us</h2>
              <p> Human beings are social creatures. that is why we  at HoneyComb<br/> are constantly developing
                creative ways to push the boundaries of communication to further connect the world.
                <br/> HoneyComb is a technology and communications company that has taken on the titanic task of <br/>
                shrinking the world through the convenience of technology.</p>
            </div>
          </center>
            <div id="mission"><center>
              <h1> Our Mission</h1>
              <p> Here at HoneyComb we believe that communication is not a privilage,</br>
                it is a right, and it therefore our duty to link the<br/> world together using communication therefore making it smaller
              <br/><br/><br/>Warren Phillips - Chief Development Officer <br/>ID:0102177</p>
            </center></div>
            <div id="m_pic"><center>

            </center></div>
            <div id="clear"></div>
            <div id="b_pic"><center>
            </div>
              <div id="goal"><center>
                <h1> How we do it</h1>
                <p> For us to achieve our goals of uniting the world,</br>
                  throught communication and technology, we must first<br/> start at home, ensuring that our valued<br/>
                  employees have a convenient and secure<br/> means of communicating
                <br/><br/><br/>Deshasd Bostic - Chief Technology Officer <br/>ID:0103402</p>
              </center></div>




          </div>
        </div>
      </div>


<!--functionality for messages-->


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
  </div>
<!--end of container-->
  </body>
<!--end of page-->
</html>







?>














</body>
</html>
