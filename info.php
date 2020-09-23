<?php include("connect.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
</nav>
<p class="h2 text-center">SEARCH STUDENT INFORMATION </p>
<form action="info.php" method="POST" class="form-control">
<select class="custom-select" name="slot" id="">
  <option value="1">Monday 15.00-17.00 </option>
  <option value="2">Tuesday 14.00-16.00 </option>
  <option value="3">Thursday 11.00-13.00 </option>
  <option value="4">Friday 10.00-12.00 </option>
 </select>
 <div>
<button class="btn btn-info" type="submit" name="submit"> Search </button>
</div>
</form>
<br>
<br>
<br>
<?php if(isset($_POST["submit"])){
  $slot=$_POST['slot'];
  $sql=mysqli_query($conn,"SELECT * FROM info WHERE slot='".$slot."'");
 if(mysqli_num_rows($sql)>0){ 
    $results=mysqli_fetch_all($sql,MYSQLI_ASSOC);
    $count=0;
     foreach($results as $result){
      $count++;
      echo("Student Information : " .$count);
      echo("<hr>");
      echo ("Name: ".$result['name']."<br>");
      echo ("First Name: ".$result['fname']."<br>");
      echo ("SID: " .$result['sid']."<br>") ;
      echo ("Email: ".$result['email']."<br>") ;
      echo("<br>");
      echo "<br>";
      } }
   else{ 
       echo "There is no student in this slot"; 
     } }
     ?>
</body>
</html>
