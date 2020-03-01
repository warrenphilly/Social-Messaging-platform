<?php
  include 'dbmsu.php';

  if(isset($_POST['sub-search'])){
    $search =mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM message WHERE message LIKE'%$search%'";

  }

 ?>
