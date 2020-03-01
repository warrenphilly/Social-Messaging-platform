<?php //author deshad bostic
  session_start();
  if($_SESSION['login']!='yes'){
    header("location:index.php");
  }
  include_once 'dbmsu.php';
if (isset($_POST["read_submit"])){
include_once 'dbms.php';
   $username=$_SESSION['u_name'];
   $unread=$_SESSION['unread'];
     $unread= mysqli_real_escape_string($conn,$_POST['read']);
    $sql = "UPDATE message SET state='True'WHERE title='$unread';";
    if(!mysqli_query($conn,$sql)){
      header("Location: myMessageG.php?error=notread");
      exit();
    }else{
      header("Location:myMessageG.php?message read");
        }
      }
else{

    header("Location:myMessageG.php?error:notpossible");
  exit();
}
?>
