<?php //author deshad bostic
  session_start();
  if($_SESSION['login']!='yes'){
    header("location:index.php");
  }
  include_once 'dbmsu.php';
if (isset($_POST["message_submit"])){
  include_once 'dbms.php';
   $username=$_SESSION['u_name'];
     $companyid=$_SESSION['cid'];
     $role =$_SESSION['role'];
   $datesent=date('Y-m-d H:i:s');
   $unread="False";
  $receipentent= mysqli_real_escape_string($conn,$_POST['reci']);
  $title= mysqli_real_escape_string($conn,$_POST['title']);
  $message= mysqli_real_escape_string($conn,$_POST['mage']);
         if(empty($username) || empty($receipentent) || empty($title)  || empty($message)){
    header("Location: mmyMessage.php?error=noinfo");
    exit();
  }else{
    $sql = "INSERT INTO message(username,title,receipentent,message,companyID,Date,state,role) VALUES ('$username','$title','$receipentent','$message','$companyid','$datesent','$unread','$role');";
    if(!mysqli_query($conn,$sql)){
      header("Location: mmyMessage.php?error=notinserted");
      exit();
    }else{
      header("Location:mmyMessage.php?message sent");
        }
      }
    }
else{
  header("Location:mmyMessage.php?error:discard");
  exit();
}
?>
