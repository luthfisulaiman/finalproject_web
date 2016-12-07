<?php
if(!isset($_SESSION))
    {
        session_start();
    }

$_SESSION['pages'] = 'review';

require_once './_app/function/auth.php';
require_once './_app/function/function.php';

?>
<div class="container" xmlns="http://www.w3.org/1999/html">
        <?php
            if($admin){
              require_once "./_layout/header_admin.php";
            } else {
              require_once "./_layout/header.php";
            }
        ?>
        <?php

        $result_review = getBook($_SESSION['buku-id']);
        $i = 0;

        while ($row = mysqli_fetch_row($result_review)) {
            echo '<div class="row">';

            foreach($row as $key => $value) {
                if ($i == 1) {
                    echo "<div class='col-sm-4'><img class='img-thumbnail' src='$value'/></div>";
                }  elseif($i == 2){
                    echo "<div class='col-sm-8'><p class='text-justify'>$row[5]</p></div>";
                    echo '</div>';
                }   elseif($i == 3){
                    echo '<div class="row">';
                    echo "<div class='col-sm-3'><h4>Judul:</h4>$row[2]</div>";
                }   elseif ($i == 4){
                    echo "<div class='col-sm-3'><h4>Penulis:</h4>$row[3]</div>";
                }   elseif ($i == 5){
                    echo "<div class='col-sm-3'><h4>Penerbit:</h4>$row[4]</div>";
                }   elseif ($i == 6){
                    echo "<div class='col-sm-3'><h4>Stok:</h4>$row[6]</div>";
                    echo "</div>";
                }
                $i++;
            }

        }

        ?>

        <?php
        $result = show_review($_SESSION['buku-id']);
        $i = 0;
        while ($row = mysqli_fetch_row($result)) {

            $username = getUsername($row[2]);

                echo ' <div class="row review">
                        <div class="col-sm-8">
                            <div class="panel panel-white post panel-shadow">
                                <div class="post-heading">
                                    <div class="pull-left meta">
                                        <div class="title h5">
                                            <a href="#"><b>' .$username.'</b></a>
                                            made a review.
                                        </div>
                                        <h6 class="text-muted time">' .$row[3].'</h6>
                                    </div>
                                </div>
                                <div class="post-description">
                                    <p>' . $row[4] . '</p>
                                </div>
                            </div>
                        </div>
                       </div>
            ';

        }
        ?>
    <?php
        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d");
        $book_id = $_SESSION['buku-id'];
        $user_id = $_SESSION['user_id'];
    ?>
    <div class="add-review"">
        <form  method="post" id="review-form">
        <h4>Add a review:</h4>
        <textarea rows="4" cols="50" id="comment" name="comment" form="review-form"></textarea>
        <?php
            echo '<input type="hidden" id="tanggal_review" name="tanggal" value="'.$date.'">';
            echo '<input type="hidden" id="book_id_review" name="book_id" value="'.$book_id.'">';
            echo '<input type="hidden" id="user_id_review" name="user_id" value="'.$user_id.'">';
         ?>
        <input type="hidden" id="add-review" name="perintah" value="add-review">
        <br>
        <button id="btn-add-review" class="btn btn-primary"> Add review </button>
        </form>
    </div>

    <div class="hasil"></div>

</div>

<?php require_once './_layout/footer.php'; ?>
