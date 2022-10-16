<?php
    session_start();

    include("config.php"); 

    if(isset($_POST['view'])){
        $_SESSION['id']=$_POST['view'];
        header("location: view.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Jodelmar's Website</title>

    <style>
        .container{
            margin-top: 20px;
            width: 100%;
        }
        img{
            width: 100%;
            margin-top: 10px;
        }
        @media all and (min-width: 768px){
            .container{
                margin-top: 20px;
                width: 70%;
            }
            img{
                margin-top: 10px;
            }   
        }
        @media all and (min-width: 1200px){
            .container{
                margin-top: 20px;
                width: 75%;
            }
            img{
                margin-top: 10px;
            }   
        }
    </style>
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
    <div style="margin-top: 60px;"></div>
    <?php
        $sql="SELECT * FROM projects ORDER BY id DESC";
        $stmt=$conn->query($sql);
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="container">
        <h3 class="text-center font-weight-bold"><?php echo $row['title']; ?>
            <span>
                <form action="" method="POST">
                    <button type="submit" value="<?php echo $row['id']; ?>" name="view" class="btn btn-secondary">View Details</button>
                </form>
            </span>
            <img src="upload/<?php echo $row['image1']; ?>" alt="">
        </h3>
        <p class="text-center"><b>Date created:</b> <?php echo $row['date_created'] ?></p>
    </div>
    <?php } ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>