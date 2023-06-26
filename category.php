<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "proyekhci");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo mysqli_error($conn);
	}
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}
$category = $_GET["category"];
$tabel = strtolower($category);

$mhs = query("SELECT * FROM ".$tabel."");

if(isset($_POST["cari"])){
	$keyword = $_POST["keyword"];
	header("Location: search.php?keyword=".$keyword."");
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  	<link rel="stylesheet" type="text/css" href="style.css">
  	<script src="https://kit.fontawesome.com/d2dec4d242.js" crossorigin="anonymous"></script>
 
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
		<div class="container-fluid">
			<h3 class="text-white">LOGO</h3>
			
			<button class="navbar-toggler ms-auto text-end" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
	      		<span class="navbar-toggler-icon"></span>
	    	</button>
			<div class="collapse navbar-collapse text-end ps-5 mx-auto" id="mynavbar">
				<a href="index.php" class="nav-link text-white">Category</a>
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
			 					$tampil = mysqli_query($conn, "SELECT * FROM $kategori[$i] WHERE stok<10");
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
			 				$tampil = mysqli_query($conn, "SELECT * FROM $kategori[$i] WHERE stok<10");
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


	<div class="container-fluid">
		<div class="row">
			<div class="col mx-auto text-center mt-4">
				<h2><?php echo ucwords($category) ; ?></h2>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col">
				<button type="button" class="btn btn-dark">
				<a href="tambah.php?category=<?php echo $tabel ?>" class="text-decoration-none text-white">Tambah</a>
				</button>
			</div>
		</div>
		<div class="row">
			<div class="col table-responsive">
				<table class="table table-bordered border-dark mt-2 text-center" >
					<thead>
						<tr class="table-dark">
							<th>No.</th>
							<th>Gambar</th>
							<th>Nama</th>
							<th>Harga</th>
							<th>Stok</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 0;
						foreach($mhs as $row) : 
							$no++;
							?>
						<tr>
							<td><?= $no ;?></td>
							<td>
								<img src="img/<?= $row["gambar"] ;?>" style="width: 50px;">
							</td>
							<td><?= $row["nama"] ;?></td>
							<td>Rp. <?php echo number_format($row["harga"],0,',','.');?></td>
							<td><?= $row["stok"] ;?></td>
							<td>
								<button type="button" class="btn btn-dark">
									<a class="text-decoration-none text-white" href="edit.php?id=<?= $row["id"] ;?>&category=<?php echo $tabel ;?>">Edit</a>
								</button>
								<button type="button" class="btn btn-dark">
									<a class="text-decoration-none text-white" href="hapus.php?deleteid=<?php echo $row['id'] ;?>&category=<?php echo $tabel ;?>" >Hapus</a>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
					
				</table>
				<script src="sorting.js"></script>
			</div>
		</div>
	</div>




</body>
</html>