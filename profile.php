<?php
    session_start();
    include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Jodelmar's Website</title>
    <style>
        .head{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .pic{
            width: 100%;
            height: 400px;
            border-radius: 10px;
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
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projects.php">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resume.php">Resume</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
        $sql="SELECT * FROM profile WHERE profile_id=1";
        $stmt=$conn->query($sql);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container-fluid" style="margin-top: 80px;">
        <h3 class="text-center head"><b>Welcome to my Website</b></h3>

        <div class="row text-center">
            <div class="col-md-3">
                <img src="upload/<?php echo $row['profile_pic']; ?>" alt="" class="pic">
            </div>
            <div class="col-md-5">
                <p class="text-justify" style="margin-top: 30px;">
                    Hi welcome to my website my name is Jodelmar Beltran and this website 
                    contains everything about my work progress and how I improved myself. 
                    To my fellow programmers, I hope I did inspired you for visiting this website, 
                    this would help you to get some ideas to make and develop your own program. 
                    You are always welcome to visit my website. Thanks for visiting and have a nice day.
                </p>
                <p class="text-left">
                    For more information here's my gmail account and phone number<br>
                    Gmail : <?php echo $row['gmail']; ?><br>
                    Phone # : <?php echo $row['phone']; ?>
                </p>
                <div>
                    <b>OR</b>
                    <p class="text-left">you can visit my youtube and facebook by clicking the button</p>
                </div>
                <div class="row">
                    <div class="col"><a href="<?php echo $row['facebook'] ?>" role="button" class="btn btn-primary w-100"><i class="fa fa-facebook-square"></i> Facebook</a></div>
                    <div class="col"><a href="<?php echo $row['youtube'] ?>" role="button" class="btn btn-danger w-100"><i class="fa fa-youtube-play"></i> Youtube</a></div>
                </div>
                <br>
            </div>
            <div class="col-md-4">
                <div class="card text-left bg-dark text-white">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Skill set</h4>
                    </div>
                    <div class="card-body">
                        <h5>Programming Language</h5>
                        <?php
                            $arr=array("#ffb163","#c1ff63","#fa70ff","#70fffa","#7aff70");
                            $sql="SELECT * FROM skills WHERE category='PL'";
                            $stmt=$conn->query($sql);
                            $temp=0;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="form-group">
                            <p style="color: <?php echo $arr[$temp]; ?>;"><?php echo $row['name']; ?></p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $row['percent']; ?>%; background-color: <?php echo $arr[$temp]; ?>;" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <?php
                                $temp+=1;
                                if($temp==count($arr)){
                                    $temp=0;
                                }
                            }
                        ?>
                        <h5 style="margin-top: 15px;">Server Side</h5>
                        <?php
                            $arr=array("#70d9ff","#ffc370","#ff70e0","#ff7070","#70ffbc");
                            $sql="SELECT * FROM skills WHERE category='Server Side'";
                            $stmt=$conn->query($sql);
                            $temp=0;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="form-group">
                            <p style="color: <?php echo $arr[$temp]; ?>;"><?php echo $row['name']; ?></p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $row['percent']; ?>%; background-color: <?php echo $arr[$temp]; ?>;" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <?php
                                $temp+=1;
                                if($temp==count($arr)){
                                    $temp=0;
                                }
                            }
                        ?>
                        <h5 style="margin-top: 15px;">Frameworks and Others</h5>
                        <?php
                            $arr=array("#70ffbc","#9b70ff","#c8ff70","#70cfff","#ff70cf");
                            $sql="SELECT * FROM skills WHERE category='Frameworks'";
                            $stmt=$conn->query($sql);
                            $temp=0;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="form-group">
                            <p style="color: <?php echo $arr[$temp]; ?>;"><?php echo $row['name']; ?></p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $row['percent']; ?>%; background-color: <?php echo $arr[$temp]; ?>;" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <?php
                                $temp+=1;
                                if($temp==count($arr)){
                                    $temp=0;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>