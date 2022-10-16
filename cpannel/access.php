<?php
    session_start();

    if(isset($_POST['submit'])){
        
        $name=$_POST['name'];
        $pass=$_POST['pass'];
        if($name=="Jodelmar"&&$pass=="beltran#1016"){
            $_SESSION['access']=$name;
            header("location: dashboard.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <title>Access Denied</title>

    <style>
        .container{
            margin-top: 30px;
            padding: 10px;
            border-radius: 20px;
            width: 100%;
        }
        @media all and (min-width: 768px){
            .container{
                width: 50%;
            }
        }
        @media all and (min-width: 1200px){
            .container{
                width: 30%;
            }
        }
    </style>
</head>
<body>
    <div class="container bg-dark text-white">
        <form action="" method="POST">
            <h3 class="text-center font-weight-bold">Access Denied</h3>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="pass" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary form-control" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>