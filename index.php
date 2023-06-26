<?php  
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "proyekhci";

	$mysqli = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($mysqli));
if(isset($_POST["cari"])){
	$keyword = $_POST["keyword"];
	header("Location: search.php?keyword=".$keyword."");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stock Data</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  	<script src="https://kit.fontawesome.com/d2dec4d242.js" crossorigin="anonymous"></script>
  	<link rel="stylesheet" type="text/css" href="style.css">
  	
</head>
<body>

	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
		<div class="container-fluid">
			<h3 class="text-white">LOGO</h3>
			<button class="navbar-toggler ms-auto text-end" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
	      		<span class="navbar-toggler-icon"></span>
	    	</button>
			<div class="collapse navbar-collapse text-end ps-5 mx-auto" id="mynavbar">
				<button type="submit" name="cari" class="btn-dark me-2 d-block mx-auto mt-2" data-bs-toggle="collapse" data-bs-target="#mysearch">
					<i class="fas fa-search"></i>
				</button>
				<div class="collapse" id="mysearch">
					<form action="" method="post" class="d-flex mt-2">
						<input class="form-control form-control-sm" type="text" placeholder="Search" name="keyword" autocomplete="off">
		        		<button class="btn btn-dark btn-sm me-2" type="submit" name="cari">Search</button>
					</form>
				</div>
				<button type="button" class="btn btn-dark mt-2 notification" data-bs-toggle="collapse" data-bs-target="#dropdown">
				      <span><i class="far fa-bell"></i></span>
				      <span class="badge">
				      	<?php 
				      		$no = 0;
			 				$kategori = array("sepatu", "tas", "pakaian", "aksesoris", "sport");
			 				for ($i= 0; $i  < 5; $i++){
			 					$tampil = mysqli_query($mysqli, "SELECT * FROM $kategori[$i] WHERE stok<10");
			 					$no += mysqli_num_rows($tampil);
			 				}
			 				echo $no;
				      	 ?>
				      </span>
				</button>
				<div class="collapse mt-2" id="dropdown">
				    
				    <ul class=" list-group list-group-vertical ms-2" style=" list-style-type: none; background-color: white;">
				      <?php 
			 			$no = 0;
			 			$kategori = array("sepatu", "tas", "pakaian", "aksesoris", "sport");
			 			for ($i= 0; $i  < 5; $i++):
			 				$tampil = mysqli_query($mysqli, "SELECT * FROM $kategori[$i] WHERE stok<10");
			 				while ($data = mysqli_fetch_array($tampil)):
			 					$no++;
			 					if ($no == 5) {
			      					break;
			      				}
				 		?>
				      	<li><a class="dropdown-item" href="edit.php?category=<?=$kategori[$i]?>&id=<?=$data['id']?>"><?=$data['nama']?></a></li>
				      		<?php endwhile; ?>
				      	<?php 
				      	if ($no == 5) {
			      			break;
			      		}
				      	endfor; 
				      	?>
				      <li><hr class="dropdown-divider"></hr></li>
				      <li><a class=" dropdown-item" href="notif.php">Selengkapnya</a></li>
				    </ul>
				  </div>
			</div>
		</div>	
	</nav>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col mx-auto text-center mt-4">
				<h2>Category</h2>
			</div>
		</div>
		<div class="row mb-5 ms-1">
			<div class="col text-center mt-4" >
				<div class="row mt-4 text-center" >
					<div class="col">
						<div class="row" >
							<div class="col mt-2" >
								<button class="btn btn-dark category ">
									<a href="category.php?category=Pakaian" class="text-white text-decoration-none text-center">Pakaian <br><img class="img-fluid" src="img/pakaian.jpg"></a>
									<p>Icon made by Freepik from www.flaticon.com</p>
								</button>
							</div>
							<div class="col mt-2 mx-auto" >
								<button class="btn btn-dark category"  >
									<a href="category.php?category=Sepatu" class="text-white text-decoration-none text-center">Sepatu<br><img class="img-fluid" src="img/sepatu.jpg"></a>
									<p>Icon made by Freepik from www.flaticon.com</p>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-4 text-center" >
					<div class="col">
						<div class="row" >
							<div class="col mt-2" >
								<button class="btn btn-dark category " >
									<a href="category.php?category=Tas" class="text-white text-decoration-none text-center">Tas<br><img class="img-fluid" src="img/tas.jpg"></a>
									<p>Icon made by Freepik from www.flaticon.com</p>
								</button>
							</div>
							<div class="col mt-2 mx-auto" >
								<button class="btn btn-dark category"  >
									<a href="category.php?category=Aksesoris" class="text-white text-decoration-none text-center">Aksesoris<br><img class="img-fluid" src="img/aksesoris.jpg"></a>
									<p>Icon made by  iconixar from www.flaticon.com</p>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-4 text-center mb-5" >
					<div class="col">
						<div class="row" >
							<div class="col mt-2" >
								<button class="btn btn-dark category " >
									<a href="category.php?category=Sport" class="text-white text-decoration-none text-center">Sport<br><img class="img-fluid" src="img/sport.jpg"></a>
									<p>Icon made by Good Ware from www.flaticon.com</p>
								</button>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>

</body>
</html>