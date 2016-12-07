<?php
require_once "./_app/function/function.php";
if(!empty($_SESSION['role']))
  {
    $_SESSION['pages'] = 'home';
    $user_id = $_SESSION['user_id'];
    $user_loan = get_loan($user_id);
    $loan_book = array();
    echo "<script>console.log('udah login')</script>";
    while ($loan_row = mysqli_fetch_row($user_loan)) {
      foreach($loan_row as $key => $value) {
        array_push($loan_book, $loan_row[1]);
      }
    }
  }
else {
  if(!isset($_SESSION))
  session_start();
  echo "<script>console.log('belom login')</script>";
}

    require_once './_app/function/auth.php';

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
} elseif($user) {
  require_once "./_layout/header.php";
} else {
  require_once "./_layout/no_login_header.php";
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
                    if($admin || !$user){

                    } else {

                      $button_flag = false;
                      if(($key = array_search($row[0], $loan_book)) !== false) {
                        $button_flag = true;
                      }
                      if ($button_flag) {
                        echo '<td>
                        <form action="./_app/function/function.php" method="post">
                        <input type="hidden" id="kembalikan-buku"
                        name="buku-id" value="'.$row[0].'">
                        <input type="hidden" id="kembalikan-loan"
                        name="loan-id" value="'.get_loan_id($row[0]).'">
                        <input type="hidden" id="return-book" name="perintah" value="return">
                        <button class="btn btn-primary"> Kembalikan </button> </td>';
                      } elseif(get_stok($row[0]) > 0) {
                        echo '<td>
                        <form action="./_app/function/function.php" method="post">
                        <input type="hidden" id="pinjam-buku" name="buku-id" value="'.$row[0].'">
                        <input type="hidden" id="id-peminjam" name="user-id" value="'.$user_id.'">
                        <input type="hidden" id="borrow-book" name="perintah" value="borrow">
                        <button class="btn btn-primary"> Pinjam </button>
                        </form>
                        </td>';
                      }
                    }
                }
            ?>
            </div>
        </div>
    </div>

<?php require_once './_layout/footer.php'; ?>
