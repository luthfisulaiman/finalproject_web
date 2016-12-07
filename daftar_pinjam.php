<?php
session_start();
$_SESSION['pages'] = 'dp';
$user_id = $_SESSION['user_id'];

require_once './_app/function/auth.php';

require_once "./_app/function/function.php";
require_once "./_layout/header.php";

$result = get_loan($user_id);
?>

    <div class="container">
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
                        if($i == 2){
                        echo "<td><img class='img-thumbnail' src='$value'/></td>";
                        } elseif($i > 2){
                        echo "<td>$value</td>";
                        } else {

                        }
                        $i++;

                    }
                    echo '<td>
                    <form action="./_app/function/function.php" method="post">
                    <input type="hidden" id="kembalikan-buku"
                    name="buku-id" value="'.$row[1].'">
                    <input type="hidden" id="kembalikan-loan"
                    name="loan-id" value="'.$row[0].'">
                    <input type="hidden" id="return-book" name="perintah" value="return">
                    <button class="btn btn-primary"> Kembalikan </button> </td>';
                }
            ?>
            </div>
        </div>
    </div>



<?php require_once './_layout/footer.php'; ?>

<?php  ?>
