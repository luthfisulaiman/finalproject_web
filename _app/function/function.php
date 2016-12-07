<?php
if(!isset($_SESSION))
    {
			session_start();
    }
$pesan ="";

function connectDB(){
    $servername = "localhost";
    $username = "user";
    $password = "";
    $dbname = "personal_library";

    // Create connection

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection

    if (!$conn)
        {
        die("Connection failed: " + mysqli_connect_error());
        }

    return $conn;
    }

function insertBook() {
        $conn = connectDB();

        $cover = $_POST['cover'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $sql = "INSERT into book (img_path, title, author, publisher, description, quantity) values('$cover','$judul','$penulis','$penerbit','$deskripsi','$stok')";

        if($result = mysqli_query($conn, $sql)) {
            echo "New record created successfully <br/>";
            header("Location: ../../view.php");
        } else {
            die("Error: $sql");
        }
        mysqli_close($conn);
    }

function look_book(){
    $conn = connectDB();
    $sql = "SELECT book_id,img_path,title,author,publisher,quantity FROM BOOK";

    if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }

    mysqli_close($conn);
    return $result;
}

function borrow_book($id_buku, $user_id) {
  $conn = connectDB();
  $sql = "INSERT INTO LOAN (book_id, user_id) VALUES ('$id_buku', $user_id)";
  echo "console.log('Masuk awal')";
  if (!$result = mysqli_query($conn, $sql))
      {
      die("Error: $sql");
      }

  echo "console.log('Masuk tengah')";
  update_stok($id_buku, "kurang");
  mysqli_close($conn);
  $pesan = "Buku berhasil dipinjam";
  $_SESSION['pesan'] = $pesan;
  header('location: ../../view.php');
  echo "console.log('Masuk akhir')";
}

function get_loan($user_id){
    $conn = connectDB();
    $sql = "SELECT LOAN.loan_id , book.book_id,book.img_path,book.title,book.author,book.publisher,book.quantity FROM BOOK INNER JOIN LOAN ON BOOK.book_id = LOAN.book_id AND LOAN.user_id = $user_id";

    if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }

    mysqli_close($conn);
    return $result;
}

function get_loan_id($book_id){
  $conn = connectDB();
  $sql = "SELECT loan_id FROM loan WHERE book_id = $book_id";
  if (!$result = mysqli_query($conn, $sql))
      {
      die("Error: $sql");
      }
  $row = mysqli_fetch_row($result);
  $row = $row[0];
  mysqli_close($conn);

  return $row;
}

function return_buku($id_buku , $id_loan){
     $conn = connectDB();
     $sql = "DELETE FROM LOAN WHERE loan_id = $id_loan";
     $pesan = "Buku berhasil dikembalikan";
    if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }

    update_stok($id_buku,'tambah');
    mysqli_close($conn);

    $_SESSION['pesan'] = $pesan;
    header('location: ../../view.php');
}

function get_stok($id){
     $conn = connectDB();
     $sql = "SELECT quantity FROM BOOK WHERE book_id = $id";
     if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }
     $row = mysqli_fetch_row($result);
     $row = $row[0];
     mysqli_close($conn);

     return $row;
}

function update_stok($id,$perintah){
     $conn = connectDB();
     if($perintah == 'tambah'){
        $stok = get_stok($id) + 1;
     } else {
        $stok = get_stok($id) - 1;
     }

     $sql = "UPDATE BOOK SET quantity = $stok WHERE book_id = $id";
        if (!$result = mysqli_query($conn, $sql))
            {
            die("Error: $sql");
            }
    $pesan = "berhasil ditambah";

        mysqli_close($conn);
    return $pesan;

}

function show_review($idbook){
    $conn = connectDB();
    $sql = "SELECT * FROM REVIEW WHERE book_id = $idbook";

    if (!$result = mysqli_query($conn, $sql))
    {
        die("Error: $sql");
    }
    mysqli_close($conn);
    return $result;
}

function getUsername($id){
    $conn = connectDB();
    $sql = "SELECT username FROM user WHERE user_id = $id";

    if (!$result = mysqli_query($conn, $sql))
    {
        die("Error: $sql");
    }

    $row = mysqli_fetch_row($result);
    $row = $row[0];

    mysqli_close($conn);
    return $row;
}

function add_review($book_id, $user_id ,$date,$content){
     $conn = connectDB();
     $date ="'".$date."'";
     $content = "'".$content."'";

    $pesan = "Berhasil menambah review";

    $sql = "INSERT INTO REVIEW (book_id, user_id, date ,content) VALUES ($book_id , $user_id, $date, $content)";

    if (!$result = mysqli_query($conn, $sql))
        {
            die("Error: $sql");
        }

    mysqli_close($conn);
}

function getBook($id){
    $conn = connectDB();
    $sql = "SELECT * FROM BOOK WHERE book_id = $id";

    if (!$result = mysqli_query($conn, $sql))
    {
        die("Error: $sql");
    }
    mysqli_close($conn);
    return $result;
}

function logout()
{
    session_unset();
    session_destroy();
    $_SESSION = array();
	echo "<script>window.open('../../login.php','_self')</script>";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
     if (!empty($_POST['perintah']) && $_POST['perintah'] === 'return')
         {
            return_buku($_POST['buku-id'], $_POST['loan-id']);
         }
     elseif  (!empty($_POST['perintah']) && $_POST['perintah'] === 'add-review')
         {
             add_review($_POST['book_id'],$_POST['user_id'],$_POST['tanggal'],$_POST['comment']);
         }
     elseif  (!empty($_POST['perintah']) && $_POST['perintah'] === 'logout')
         {
            echo "<script>console.log('Masuk if')</script>";
             logout();
         }
     elseif  (!empty($_POST['perintah']) && $_POST['perintah'] === 'insert')
         {
             insertBook();
         }
     elseif  (!empty($_POST['perintah']) && $_POST['perintah'] === 'borrow')
         {
            echo "<script>console.log('Masuk if')</script>";
             borrow_book($_POST['buku-id'], $_POST['user-id']);
         }
     }

?>
