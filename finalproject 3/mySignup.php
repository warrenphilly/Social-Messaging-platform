<?php
if(isset($_POST["signup-submit"])){

  require 'dbms.php';

  $username = $_POST["sUsername"];
  $firstName = $_POST["firstname"];
  $lastName = $_POST["lastname"];
  $email = $_POST["emailAddress"];
  $occupation = $_POST["occupation"];
  $password = $_POST["sPassword"];
  $rePassword = $_POST["rPassword"];
  $companyID = $_POST["id"];

  if(empty($username)|| empty($firstName)|| empty($lastName)|| empty($email) || empty($occupation) || empty($password)|| empty($rePassword) || empty($companyID)) {
    header("Location: signup.php?error=emptyfields&sUsername=".$username."&firstname=".$firstName."&lastname=".$lastName."&emailAddress=".$email."&occupation=".$occupation."&id=".$companyID);
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: signup.php?error=invalidfirstnameandemail&firstname=".$firstName."&lastname=".$lastName."&occupation=".$occupation."&id=".$companyID);
    exit();
  }
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: signup.php?error=invalidemail&sUsername=".$username."&firstname=".$firstName."&lastname=".$lastName."&occupation=".$occupation."&id=".$companyID);
    exit();
  }
  elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: signup.php?error=invalidusername&firstname=".$firstName."&lastname=".$lastName."&emailAddress=".$email."&occupation=".$occupation."&id=".$companyID);
    exit();
  }
  elseif($password !==$rePassword){
    header("Location: signup.php?error=passwordcheck&sUsername=".$username."&firstname=".$firstName."&lastname=".$lastName."&emailAddress=".$email."&occupation=".$occupation."&id=".$companyID);
  }
  else{

    $sql= "SELECT username FROM users WHERE username =?";
    $statement= mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement,$sql)){
      header("Location: signup.php?error=lolosqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($statement,"s",$username);
      mysqli_stmt_execute($statement);
      mysqli_stmt_store_result($statement);
      $resultcheck = mysqli_stmt_num_rows($statement);
      if($resultcheck > 0){
        header("Location: signup.php?error=usernamealreadytaken");
        exit();
      }

      else{
        $sqlId = "SELECT * FROM companyID,adminNo WHERE companyId= '$companyID' OR adminId= '$companyID'";
        $resultId = mysqli_query($conn,$sqlId);
        $resultCheck= mysqli_num_rows($resultId);
        if($resultCheck < 1){
          header("Location: signup.php?error=noIdfound");
          exit();
        }
        else  {
          $sql= "SELECT adminId FROM adminNo where adminId='$companyID'";
          $result = $conn->query($sql);
          $resultCheck= mysqli_num_rows($result);
           if($resultCheck <1)
          {
            $sql=  "INSERT INTO users (username,email,password,firstname,lastname,occupation,companyId,role) VALUES (?,?,?,?,?,?,?,'Guest')";
            $statement= mysqli_stmt_init($conn);
            $role='Guest';
          }
          else{
            $sql=  "INSERT INTO users (username,email,password,firstname,lastname,occupation,companyId,role) VALUES (?,?,?,?,?,?,?,'Admin')";
            $statement= mysqli_stmt_init($conn);
            $role='Admin';
          }

        if(!mysqli_stmt_prepare($statement,$sql)){
          header("Location: signup.php?error=sqlerror");
          exit();
        }
          else{
            $hashedPass = password_hash($password,PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($statement,"sssssss",$username,$email,$hashedPass,$firstName,$lastName,$occupation,$companyID);
            mysqli_stmt_execute($statement);

            session_start();
            $_SESSION['u_name']=$username;
            $_SESSION['u_fname']=$firstName;
            $_SESSION['u_lname']=$lastName;
            $_SESSION['u_occupation']=$occupation;
            $_SESSION['u_mail']=$email;
            $_SESSION['role']=$role;
            $_SESSION['login']='yes';

            }
            $sql= "SELECT adminId FROM adminNo where adminId='$companyID'";
            $result = $conn->query($sql);
            $resultCheck= mysqli_num_rows($result);
             if($resultCheck <1)
            {
              header("Location: myMessageG.php?login=success");
              exit();

            }
            else{
              header("Location: mmyMessage.php?login=success");
              exit();
            }
          }

        }
      }
    }
    mysqli_stmt_close($statement);
    mysqli_close($conn);
  }

else{
  header("Location: signup.php");
  exit();
}

 ?>
