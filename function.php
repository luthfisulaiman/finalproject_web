<?php
session_start();
$pesan ="";

function connectDB()
    {
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
    return $pesan;

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
     echo $row;
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

        mysqli_close($conn);
}

function add_review(){
     $conn = connectDB();
     $book_id ;
     $user_id ;
     $date;
     $content;

     $pesan = "Berhasil menambah review";

    $sql = "INSERT INTO REVIEW (book_id,user_id,date,content) VALUES ($book_id , $user_id, $date, $content)";
    if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }

    mysqli_close($conn);

}


if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
     if ($_POST['perintah'] === 'return')
         {
         return_buku($_POST['buku-id'],$_POST['loan-id']);
         }
     }
?>
