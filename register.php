<?php include("connect.php") ?>

<?php
$sql=mysqli_query($conn,"SELECT count(*) as c FROM info WHERE slot='1'");

$result=mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
  
  if($result['c']>0){
     
   if($result['c']==8){
    $slot1='<option selected disabled value=""></option>';
   }else{
    $slot1='<option value="1">Monday 15.00-17.00 '.(8-$result['c']). ' seats remaining</option>';
   }
  }
  else{
    $slot1='<option value="1">Monday 15.00-17.00 8 seats remaining</option>';
  }
}
$sql=mysqli_query($conn,"SELECT count(*) as c FROM info WHERE slot='2'");

$result=mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
  
  if($result['c']>0){
     
   if($result['c']==8){
    $slot2='<option selected disabled value=""></option>';
   }else{
    $slot2='<option value="2">Tuesday 14.00-16.00 '.(8-$result['c']). ' seats remaining</option>';
   }
  }
  else{
    $slot2='<option value="2">Tuesday 14.00-16.00 8 seats remaining</option>';
  }
}
$sql=mysqli_query($conn,"SELECT count(*) as c FROM info WHERE slot='3'");

$result=mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
  
  if($result['c']>0){
     
   if($result['c']==8){
    $slot3='<option selected disabled value=""></option>';
   }else{
    $slot3='<option value="3">Thursday 11.00-13.00 '.(8-$result['c']). ' seats remaining</option>';
   }
  }
  else{
    $slot3='<option value="3">Thursday 11.00-13.00 8 seats remaining</option>';
  }
}
$sql=mysqli_query($conn,"SELECT count(*) as c FROM info WHERE slot='4'");

$result=mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
  
  if($result['c']>0){
     
   if($result['c']==8){
    $slot4='<option selected disabled value=""></option>';
   }else{
    $slot4='<option value="4">Friday 10.00-12.00 ' .(8-$result['c']). ' seats remaining</option>';
   }
  }
  else{
    $slot4='<option value="4">Friday 10.00-12.00 8 seats remaining</option>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-danger">
  <a class="navbar-brand text-white font-weight-bolder" href="index.php">Home</a>
</nav>
  <h3 class="text-center green">Registration</h3>
  <form action="register.php" method="POST" class="form-control">
  <div class="form-group">
  <label for="name">Name : </label>
  <input type="text" name="name" id="">
  </div>
  <div class="form-group">
  <label for="fname">Firstname : </label>
  <input type="text" name="fname" id="">
  </div>
  <div class="form-group">
  <label for="sid">SID : </label>
  <input type="text" name="sid" id="">
  </div>
  <div class="form-group">
  <label for="email">Email Address : </label>
  <input type="text" name="email" id="">
  </div>
  <div class="form-group">

  <label for="slot">Select slot:</label>
  <select class="custom-select" name="slot" id="">
  <?php echo $slot1; ?>
  <?php echo $slot2; ?>
  <?php echo $slot3; ?>
  <?php echo $slot4; ?>
  
  
  </select>
  </div>
  <div class="text-center">
  <button  type="submit" name="register" class="btn btn-success">Register</button>
  </div>
  </form>
  <?php
  if (isset($_POST['register'])){
      $errors=array();
      $name=mysqli_real_escape_string($conn,$_POST['name']);
      $fname=mysqli_real_escape_string($conn,$_POST['fname']);
      $sid=mysqli_real_escape_string($conn,$_POST['sid']);
      $email=mysqli_real_escape_string($conn,$_POST['email']);
      $slot=mysqli_real_escape_string($conn,$_POST['slot']);
      
      if(empty($name)){
        array_push($errors,"Name is required");
     } 
     if(empty($email)){
        array_push($errors,"Email is required");
     }
     if(empty($fname)){
        array_push($errors,"First Name is required");
     }
     if(empty($slot)){
      array_push($errors,"Slot is required");
   }
   if(empty($sid)){
    array_push($errors,"SId is required");
   }
   if (count($errors)>0){
    foreach($errors as $error){ 
       echo "<script type='text/javascript'>alert(`$error`);</script>"; 
     }
    } 
     if(count($errors)==0){
      $sql2=mysqli_query($conn,"SELECT slot FROM info WHERE sid='".$sid."'");
      $result=mysqli_fetch_assoc($sql2);
      if(mysqli_num_rows($sql2)>0){
        if($result['slot']==$slot){
          
          echo "<script type='text/javascript'>alert(`This student has been already registered to this slot`);</script>";
        }
        else{
          $sql="DELETE FROM info WHERE sid='".$sid."'";
          mysqli_query($conn,$sql);
          echo "<script type='text/javascript'>alert(`Section Change request has been granted`);</script>";
          $sql="INSERT INTO info(name,fname,sid,email,slot)
             VALUES ('".$name."','".$fname."','".$sid."','".$email."','".$slot."')";
          mysqli_query($conn,$sql);
        }}
      else{
        $sql="INSERT INTO info(name,fname,sid,email,slot)
        VALUES ('".$name."','".$fname."','".$sid."','".$email."','".$slot."')";
       mysqli_query($conn,$sql);
       echo "<script type='text/javascript'>alert(`Registered Successfully`);</script>";

      }
      }
    }
   
?>
</body>
</html>