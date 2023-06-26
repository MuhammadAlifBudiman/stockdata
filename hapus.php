<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "proyekhci");

if(isset($_GET['deleteid'])){
	$id=$_GET['deleteid'];
	$category = $_GET["category"];

	$sql="DELETE FROM ".$category." WHERE id=$id;";
	$result=mysqli_query($conn,$sql);

	if($result){
		header('location:category.php?category='.$category.'');
	}
	else{
		die(mysqli_error($conn));
	}
}
 ?>