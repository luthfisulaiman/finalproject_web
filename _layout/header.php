<?php
if(!isset($_SESSION))
    {
			session_start();
    }
$pages = $_SESSION["pages"];
$active = 'active';

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
    <link rel="stylesheet" href="./css/app.css" />
</head>
<body>
    <div id="carousel-example-with-caption" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-with-caption" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-with-caption" data-slide-to="1"></li>
        <li data-target="#carousel-example-with-caption" data-slide-to="2"></li>
      </ol>

      <div class="carousel-inner" role="listbox">
        <div class="carousel-caption">
          <h1>What we do</h1>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
        </div>
        <div class="carousel-item active">
          <img src="./src/img/1.jpg" width=100% height=100% alt="First slide">
        </div>
        <div class="carousel-item">
          <img src="./src/img/2.jpg" width=100% height=100% alt="Second slide">
        </div>
        <div class="carousel-item">
          <img src="./src/img/3.jpg" width=100% height=100% alt="Third slide">
        </div>
      </div>
      <a class="left carousel-control" href="#carousel-example-with-caption" role="button" data-slide="prev">
        <span class="icon-prev" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-with-caption" role="button" data-slide="next">
        <span class="icon-next" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <nav class="navbar navbar-light bg-faded">
      <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
      </button>
      <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
        <a class="navbar-brand">Perpustakaan Mini</a>
        <ul class="nav navbar-nav">

          <li class="nav-item  <?php if ($pages == 'home') echo $active?>">
            <a class="nav-link <?php if ($pages == 'home') echo $active?>" href="view.php">Home</a>
          </li>
          <li class="nav-item <?php if ($pages == 'dp') echo $active?>">
            <a class="nav-link <?php if ($pages == 'dp') echo $active?>" href="daftar_pinjam.php">Daftar Pinjam<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <form action="./_app/function/function.php" method="post">
              <input type="hidden" id="logout" name="perintah" value="logout"/>
              <button class="btn btn-danger">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
