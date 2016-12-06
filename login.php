<?php
if(!isset($_SESSION))
    {
			session_start();
    }
    require_once "./_app/function/function.php";
?>
<!DOCTYPE html>
<!-- Reference: http://www.c-sharpcorner.com/uploadfile/9582c9/script-for-login-logout-and-view-using-php-mysql-and-boots/ -->
<html>
<head lang="en">
    <meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Login</title>
	<style>
		.login-panel {
            margin-top: 50%;
        }
	</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login.php">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>
                                <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="login">

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
$conn = connectDB();

if(isset($_POST['login']))

{
    $user_name=$_POST['username'];
    $user_pass=$_POST['pass'];

	if($user_name == "" || $user_name == null) {
		if($user_pass == "" || $user_pass == null) {
			echo "<script>alert('Username dan Password tidak boleh kosong')</script>";
			echo "<script>window.open('login.php','_self')</script>";
		}
		echo "<script>alert('Username tidak boleh kosong')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}
	if($user_pass == "" || $user_pass == null) {
		echo "<script>alert('Password tidak boleh kosong')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}

    $check_user="SELECT * FROM user WHERE username='$user_name' AND password='$user_pass'";

	$result = mysqli_query($conn, $check_user);

    if(mysqli_num_rows($result))
    {
		$row = mysqli_fetch_assoc($result);
        $_SESSION['role']=$row['role'];
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['login'] = true;

		echo "<script>window.open('view.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Username tidak ditemukan atau password salah')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}
}
?>
