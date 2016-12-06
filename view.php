<?php
if(!isset($_SESSION))
    {
        session_start();
    }
$_SESSION['pages'] = 'home';

require_once './_app/function/auth.php';
require_once "./_app/function/function.php";

    if(isset($_POST['review-buku'])) {
        $_SESSION['review'] = $_POST['review-buku'];
        if(isset($_SESSION['review'])) {
            $_SESSION['buku-id'] = $_SESSION['review'];
            header('location: review.php');
        }

    }

$result = look_book();
?>

<?php
if($admin){
  require_once "./_layout/header_admin.php";
} else {
  require_once "./_layout/header.php";
}
?>
    <div class="container">
        <?php
        if($admin){
            include_once './admin.php';
        }
        ?>
        <div class="row">
            <div class="table-responsive">
             <table class='table table-hover'>
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
                        if($i == 1){
                            echo '
                             <form action="view.php" method="post">
                             <input type="hidden" id="review-buku" name="review-buku" value="'.$row[0].'">
                             <input id="buku-'.$row[0].'" type="submit" class="hidden">

                             </form>
                            ';
                            echo '<button class="hidden" id="bukubuku-'.$row[0].'" data-toggle="modal" data-target="#myModal"></button>';
                        echo "<td class='img-review' val='".$row[0]."'><img href='#' class='img-thumbnail' src='$value'/></td>";
                        } elseif($i > 1){
                        echo "<td>$value</td>";
                        } else {

                        }
                        $i++;

                    }
                    if($admin || get_stok($row[0]) < 1){

                    } elseif(get_stok($row[0]) > 0) {
                    echo "<td><button class='btn btn-primary'> Pinjam </button> </td>";
                    }
                }
            ?>
            </div>
        </div>
    </div>

<?php require_once './_layout/footer.php'; ?>
