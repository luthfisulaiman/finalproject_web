<?php


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
    $sql = "SELECT img_path,title,author,publisher,quantity FROM BOOK";

    if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }

    mysqli_close($conn);
    return $result;
}

function get_loan($user_id){
    $conn = connectDB();
    $sql = "SELECT book.img_path,title,author,publisher,quantity FROM BOOK INNER JOIN LOAN ON BOOK.book_id = LOAN.book_id AND LOAN.user_id = $user_id";

    if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }

    mysqli_close($conn);
    return $result;
}

function return_buku($id){
     $conn = connectDB();
     $sql = "DELETE FROM LOAN WHERE loan_id = $id";
     $pesan = "Buku berhasil dikembalikan";
    if (!$result = mysqli_query($conn, $sql))
        {
        die("Error: $sql");
        }

    mysqli_close($conn);
    return $pesan;

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


// if ($_SERVER['REQUEST_METHOD'] === 'POST')
//     {
//     if ($_POST['command'] === 'return')
//         {
//         insertPaket();
//         }


?>
