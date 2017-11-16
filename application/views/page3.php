<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .msg{
  color:red;
  }
  .move{
  margin-top:10px;
  }
  .move1{
  margin-top:10px;
  }
  </style>
 </head>
 <body>
 <div class="container">
  <h1>Shopping Basket</h1>
  <hr align="left">
   <?php
  $base_url="http://localhost/project5/index.php/";
  $count=0;
  //$connect=mysqli_connect("localhost","root","root","CheapBooks");
  if(isset($_SESSION['count'])){
		$count=$_SESSION['count'];
  }
  if(isset($_SESSION['val'])&&isset($_SESSION['val1'])&&isset($ISBN)){
	  $res=0;
	  /*foreach($ISBN as $value){
		  echo $value->ISBN.'<br>';
	  }*/
	  echo "<form class='form-group'>";
	  echo "<table class='table table-bordered'>";
	  echo "<tr><th>ISBN</th><th>Title</th><th>Author Name</th><th>Price</th><th>Quantity Bought</th></tr>";
	  $count1=1;
	  foreach($ISBN as $value1=>$value){
		  //echo $value[$value1]->ISBN;
		  echo '<tr><td>'.$value->ISBN.'</td><td>'.$value->title.'</td><td>'.$value->name.'</td><td>'.$value->price.'</td><td>'.$_SESSION['val1'][$value1].'</td></tr>';
		  $res+=$value->price*$_SESSION['val1'][$value1];
	  }
	  echo "</table>";
	  echo "</form>";
	  echo "<span class='msg'><b>The total price of cart is: ".number_format($res,2).'</b></span>';
  }
  ?>
  <form method="post" action="">
  <input type="submit" class="btn btn-primary move" value="Buy" id="buy" class="buy" name="buy">
  </form>
  <?php
  $val=[];
  $val1=[];
  if(isset($_POST['buy'])){
	  $count1=0;
	  $count2=0;
	  foreach($ISBN as $value1=>$value){
		  $get=$_SESSION['val1'][$value1];
		  if($get<=$value->number){
			  unset($_SESSION['val'][$count2]);
			  $val=array_values($_SESSION['val']);
			  unset($_SESSION['val1'][$count2]);
			  $val1=array_values($_SESSION['val1']);
		  }
		  else{
			  $count1++;
			  $val=array_values($_SESSION['val']);
			  $val1=array_values($_SESSION['val1']);
		  }
		  $count2++;
	  }
	  $_SESSION['val']=$val;
	  $_SESSION['val1']=$val1;
	  $_SESSION['count1']=$count1;
      $_SESSION['count']=$count1;
	  header("location: http://localhost/project5/index.php/customer/page2");
  }
  ?>
  <a href=<?php echo $base_url.'customer/page2' ?>><input type="button" class="btn btn-info move1" name="return" id="return" value="Return to Search"></a>
  </div>
 </body>
</html>
