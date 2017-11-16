<?php
session_start();
  $base_url="http://localhost/project5/index.php/";
  if(isset($_SESSION['username'])){
	header('Location: http://localhost/project5/index.php/customer/page2');
  }
  if(isset($_POST['submit'])){
  $username=$_POST['username'];
  }
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Customer Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body{
  width:100%;
  }
  td{
  padding:9px;
  }
  #username{
  width:250px;
  }
  .move{
  margin-left:5px;
  margin-top:8px;
  }
  .move1{
  margin-left:5px;
  margin-top:15px;
  }
  .error{
  margin-left:5px;
  margin-top:15px;
  color:red;
  }
  </style>
 </head>
 <body>
  <div class="container">
<h1>Customer Login</h1>
<hr align="left" width="370">
<div class="form-group">
<form method="post" action="<?php echo $base_url.'customer/check' ?>">
<table>
<tr><td>Username: </td><td><input type="text" class="form-control" id="username" name="username" placeholder="enter username" required></td>
<tr><td>Password: </td><td><input type="password" class="form-control" id="password" name="password" placeholder="enter password" required></td></tr><td>
</table>
<span class="error"><b><?php if(isset($error)) echo $error; ?></b></span><br>
<input type="submit" class="btn btn-primary move" value="Log in" name="submit"><br>
<a href="<?php echo $base_url.'customer/page4' ?>"><input type="button" class="btn btn-info move1" value="New users must register here"></a><br>
</form>
</div>
</div>
 </body>
</html>
