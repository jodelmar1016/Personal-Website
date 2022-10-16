<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: index.php");
    }

    include("config.php");

    $id=$_SESSION['id'];
    $sql="SELECT * FROM projects WHERE id=$id";
    $stmt=$conn->query($sql);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/view.css">

    <title>View Details</title>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Jodelmar's Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="projects.php">Projects <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resume.php">Resume</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
            </ul>
        </div>
    </nav>

    <div style="margin-top: 80px; margin-left: 20px;">
        <h3><b><?php echo $row['title'] ?></b>
            <span><a href="<?php echo $row['link'] ?>" role="button" class="btn btn-secondary">Demo</a></span>
        </h3>
        <div class="row">
            <div class="col-sm-8">
                <div class="con">
                    <div class="mySlides">
                        <img src="upload/<?php echo $row['image1']; ?>" style="width:100%" alt="image1">
                    </div>

                    <div class="mySlides">
                        <img src="upload/<?php echo $row['image2']; ?>" style="width:100%" alt="image2"> 
                    </div>

                    <div class="mySlides">
                        <img src="upload/<?php echo $row['image3']; ?>" style="width:100%" alt="image3">
                    </div>

                    <div class="mySlides">
                        <img src="upload/<?php echo $row['image4']; ?>" style="width:100%" alt="image4">
                    </div>

                    <div class="mySlides">
                        <img src="upload/<?php echo $row['image5']; ?>" style="width:100%" alt="image5">
                    </div>

                    <div class="mySlides">
                        <img src="upload/<?php echo $row['image6']; ?>" style="width:100%" alt="image6">
                    </div>

                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                    <!-- Image text -->
                    <div class="caption-container">
                        <p id="caption"></p>
                    </div>

                    <!-- Thumbnail images -->
                    <div class="row">
                        <div class="column">
                            <img class="demo cursor" src="upload/<?php echo $row['image1']; ?>" style="width:100%" onclick="currentSlide(1)" alt="1 / 6">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="upload/<?php echo $row['image2']; ?>" style="width:100%" onclick="currentSlide(2)" alt="2 /6">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="upload/<?php echo $row['image3']; ?>" style="width:100%" onclick="currentSlide(3)" alt="3 / 6">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="upload/<?php echo $row['image4']; ?>" style="width:100%" onclick="currentSlide(4)" alt="4/ 6">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="upload/<?php echo $row['image5']; ?>" style="width:100%" onclick="currentSlide(5)" alt="5 / 6">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="upload/<?php echo $row['image6']; ?>" style="width:100%" onclick="currentSlide(6)" alt="6 / 6">
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $desc=explode(";",$row['description']);
                $features=explode(";",$row['features']);
            ?>

            <div class="col-sm-4">
                <h4 class=text-center>Details</h4>
                <p><b>DESCRIPTION</b></p>
                    <?php foreach($desc as $val){ ?>
                        <ul>
                            <li><?php echo $val; ?></li>
                        </ul>
                    <?php } ?>
                <p><b>FEATURES</b></p>
                    <?php foreach($features as $val){ ?>
                        <ul>
                            <li><?php echo $val; ?></li>
                        </ul>
                    <?php } ?>
                <p><b>PROGRAMMING LANGUAGE</b></p>
                    <ul>
                        <li><?php echo $row['programming_language']; ?></li>
                    </ul>
                <p><b>DATABASE</b></p>
                    <ul>
                        <li><?php echo $row['db']; ?></li>
                    </ul>
                <p><b>DATE CREATED</b></p>
                    <ul>
                        <li><?php echo $row['date_created']; ?></li>
                    </ul>
            </div>  
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>

<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>