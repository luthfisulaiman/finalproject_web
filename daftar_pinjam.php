<?php
session_start();
include 'function.php';
$user_id = 8;
$result = get_loan($user_id);

?>

<!DOCTYPE html>

<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Perpustakaan Mini">
    <meta name="description" content="Tugas Akhir Perancangan dan Pemograman Web">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpusatakaan Mini</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light bg-faded">
      <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
        &#9776;
      </button>
      <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
        <a class="navbar-brand" href="#">Perpustakaan Mini</a>
        <ul class="nav navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="view.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="daftar_pinjam.php">Daftar Pinjam<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="table-responsive">
             <table class='table'>
               <thead>
                  <tr>
                     <th>Cover</th>
                     <th>Judul</th>
                     <th>Penulis</th>
                     <th>Penerbit</th>
                     <th>Stok</th>
                     <th></th>
                  </tr>
               </thead>
            <?php
                while ($row = mysqli_fetch_row($result)) {
                    # code...
                    echo"<tr>";
                    $i = 0;
                    foreach($row as $key => $value) {
                        if($i < 1){
                        echo "<td><img class='img-thumbnail' src='$value'/></td>";
                        } else {
                        echo "<td>$value</td>";
                        }
                        $i++;
                    }

                    echo "<td><button class='btn btn-primary'> Kembalikan </button> </td>";
                }
            ?>
            </div>
        </div>
    </div>



   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
   <script src="   https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js"></script>
</body>
</html>