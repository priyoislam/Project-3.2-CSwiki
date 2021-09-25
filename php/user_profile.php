<?php
include('dbcon.php');
session_start();
if (isset($_SESSION['email'])) {
    $sql = "SELECT * from signup where email='$_SESSION[email]'";
    $res = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($res);
    $A_name=$row['name'];
    $A_mail=$row['email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/blogger_profile.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include("navbar.php");?>
    <div class="container">
        <div class="text-center">
            <h3><?php echo $row['name']; ?></h3>
        </div>
        <?php
            $sql2 = "SELECT * FROM author where Author_email='$_SESSION[email]'";
            $res2 = mysqli_query($connect, $sql2);
            $row2 = mysqli_fetch_assoc($res2);
            if (mysqli_num_rows($res2) > 0) {
        ?>
        <div class="card text-center mb-5" style="width: 18rem;">
            <div class="card-body">
                <h6 class="card-title">Do you wanna add a new blog?</h6>
                <?php
                if(isset($_POST['upload_blog'])){
                    $A_ID=$row2['Author_ID'];
                    $_SESSION['Author_ID'] = $A_ID;
                    header('location:upload_blog.php');
                }
                ?>
                <form method="post" action="" enctype="multipart/form-data">
                <button type="submit" class="btn btn-info" name="upload_blog"><i class="fas fa-plus-circle"></i></button>
                </form>
                <!-- <a href="#" class="btn btn-info"><i class="fas fa-plus-circle"></i></a> -->
            </div>
        </div>
        <?php
    } else 
    {
        ?>
        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h6 class="card-title">Do you wanna add a new blog?</h6>
                <?php
                if(isset($_POST['upload'])){
                    $query="INSERT into author(Author_Name,Author_Email,Author_Image,Description)
                    values ('$A_name','$A_mail','','')";
                    $insertequery=mysqli_query($connect,$query);
                    if($insertequery){
                        header('location:user_profile.php');
                    }
                    else{
                        echo "not added";
                    }
                }
                ?>
                <form method="post" action="" enctype="multipart/form-data">
                <button type="submit" class="btn btn-info" name="upload">Join as an author</button>
                </form>
            </div>
        </div>
        <?php
    }
    ?>
    </div>

    <div class="product container ">
        <?php
        if ($connect) {
            $art = "SELECT * from blog inner join author using(Author_ID) where Author_ID='$row2[Author_ID]';";
            $res = mysqli_query($connect, $art);
        ?>  
            <?php 
            if (mysqli_num_rows($res) > 0){
                ?>
            <h6>All blogs written by <?php echo $row['name'];?></h6>
            <?php } ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                while ($row = mysqli_fetch_assoc($res)) :
                ?>
                    <div class="col pt-3">
                        <div class="card blog">
                            <div class="card-body">
                                <div class="blog-list">
                                    <div>
                                        <a href="#" title="blog about education"><?php echo $row['Topic']; ?></a>
                                    </div>
                                    <span><i class="fa fa-calendar me-1"></i>
                                        <?php echo $row['Date']; ?></span>
                                    </a>
                                    </span>
                                </div>
                                <h5 class="blog-title"><a href="blog.php?article=<?php echo $row['Article_ID'];?>" rel="bookmark"><?php echo $row['Title']; ?></a></h5>
                                <div class="d-flex align-items-center justify-content-between blog-list">
                                    <div class="author d-flex align-items-center">
                        
                                        <a class="fw-bold" style="font-size: 13px;" href="blog.php?author=<?php echo $row['Author_ID'];?>">
                                            <span><?php echo $row['Author_Name'];?></span>
                                        </a>
                                    </div>
                                
                                    <a href="blog.php?article=<?php echo $row['Article_ID'];?>" class="btn btn-primary btn-info text-light btn-sm" tabindex="-1" role="button" aria-disabled="true">Read full blog</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../js/wow.js"></script>
    <script>
    new WOW.init();
    </script>
    <script src="../js/main.js"></script>
</body>

</html>