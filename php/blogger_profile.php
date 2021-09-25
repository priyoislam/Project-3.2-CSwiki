<?php
include('dbcon.php');
session_start();
if (isset($_SESSION['Author_ID'])) {
    $sql = "SELECT * from blog inner join author using(Author_ID) where Author_ID='$_SESSION[Author_ID]'";
    $res = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/blogger_profile.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
</head>

<body>

<?php include("navbar.php");?>
    <div class="blog_banner">
        <!-- <img src="../image/blogging.jpg" class="img-fluid banner" alt="Banner image for blog"> -->
    </div>

    <div class="container author m-5 text-center">
        <img class="author_pp" src="../image/<?php echo $row['Author_Image'];?>" alt="not found" style="width: 175px; height: 175px;">
        <h3><?php echo $row['Author_Name'];?></h3>
        <p><?php echo $row['Description']; ?></p>
    </div>
    
    <div class="product container mt-5">
        <h5>All blogs by <?php echo $row['Author_Name']; ?></h5>
        <?php
        if ($connect) {
            $art = "SELECT * from blog inner join author using(Author_ID) where Author_ID='$_SESSION[Author_ID]'";
            $res = mysqli_query($connect, $art);
        ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                while ($row = mysqli_fetch_assoc($res)) :
                ?>
                    <div class="col">
                        <div class="card blog">
                            <img class="card-img-top" src="../image/<?php echo $row['Image']; ?>" style="width: 100%" alt="Card image cap"> 
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
                                <h5 class="blog-title"><a href="what_is_research.html" rel="bookmark"><?php echo $row['Title']; ?></a></h5>
                                <div class="d-flex align-items-center justify-content-between blog-list">
                                    <div class="author d-flex align-items-center">

                                        <a class="fw-bold" style="font-size: 13px;" href="blog.php?author=<?php echo $row['Author_ID']; ?>">
                                            <span><?php echo $row['Author_Name']; ?></span>
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
    <?php include("footer.php");?>

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