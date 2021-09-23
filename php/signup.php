<?php
SESSION_start();

include('dbcon.php');
$msg = "";

if ($connect) {
    if (isset($_POST['submit'])) {
        $U_name = $_POST['name'];
        $U_mail = $_POST['email'];
        $U_address = $_POST['address'];
        $U_password = $_POST['password'];
        $U_phone = $_POST['phone'];

        $sqlfind = "SELECT * FROM signup where email='$U_mail'";
        $resfind = mysqli_query($connect, $sqlfind);
        if (mysqli_num_rows($resfind) > 0) {
            $msg = "This Email is already existed";
        } else {
            $sql = "INSERT INTO signup(id,name,email,address,password,phone)
   VALUES (NULL,'$U_name','$U_mail','$U_address','$U_password','$U_phone')";
            $res = mysqli_query($connect, $sql);
            if ($res) {
                $_SESSION['email'] = $U_mail;
                header('location:signup.php');
            } else {
                echo "not added";
            }
        }
    }
} else {
    echo "not added";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/signup.css">
</head>

<body>
    
    <div class="bg">
        <?php if (strcmp($msg, 'This Email is already existed') == 0) { ?>
            <div class="alert alert-danger">
                <strong style="color:white;">Wrong! This Email already exists.</strong>
            </div>
        <?php
        }
        ?>
        <div class="wrapper">
            <div class="header-area">
                <h2>Sign Up As User</h2>
                <p>Or join with</p>
            </div>
            <div class="social-area">
                <i class="fa fa-facebook"></i>
                <i class="fa fa-google"></i>
                <i class="fa fa-linkedin"></i>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-area">
                    <i class="fa fa-user"></i>
                    <input type="text" name="name" placeholder="Enter Username" required>
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter Email Address" required>
                    <i class="fa fa-location-arrow"></i>
                    <input type="text" name="address" placeholder="Enter Address" required>
                    <i class="fa fa-key"></i>
                    <input type="password" name="password" placeholder="Enter Password" required>
                    <i class="fa fa-phone"></i>
                    <input type="text" name="phone" placeholder="Enter Phone Number" required>
                    <input type="checkbox">
                    <p class="terms">I will accept terms and conditions</p>
                    <button type="submit" name="submit" value="">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>