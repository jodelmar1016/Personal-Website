<?php 
    session_start();
    if(!isset($_SESSION['access'])){
        header("location: access.php");
    }

    include("../config.php");

    // update profile pic
    if(isset($_POST['change'])){
        $sql="SELECT * FROM profile WHERE profile_id=1";
        $stmt=$conn->query($sql);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        unlink("../upload/".$row['profile_pic']);

        $name=$_FILES['pic']['name'];
        $sql="UPDATE profile SET profile_pic='$name' WHERE profile_id=1";
        $stmt=$conn->query($sql);

        $target="../upload/".basename($_FILES['pic']['name']);
        move_uploaded_file($_FILES['pic']['tmp_name'], $target);
        header("location: dashboard.php");
    }

    // update info
    if(isset($_POST['save'])){
        $email=$_POST['email'];
        $phone=$_POST['cnumber'];
        $fb=$_POST['fb'];
        $yt=$_POST['yt'];
        $sql="UPDATE profile SET gmail='$email',phone='$phone',facebook='$fb',youtube='$yt' WHERE profile_id=1";
        $stmt=$conn->query($sql);
        header("location: dashboard.php");
    }

    // add skill
    if(isset($_POST['add'])){
        $name=$_POST['name'];
        $percent=$_POST['percent'];
        $category=$_POST['category'];

        $sql="INSERT INTO skills (name, percent, category) VALUES ('$name', '$percent', '$category')";
        $stmt=$conn->query($sql);
        header("location: dashboard.php");
    }

    // update skill
    if(isset($_POST['update'])){
        $id=$_POST['update_id'];
        $name=$_POST['update_name'];
        $percent=$_POST['update_percent'];
        $category=$_POST['update_category'];

        $sql="UPDATE skills SET name='$name', percent='$percent', category='$category' WHERE id='$id'";
        $stmt=$conn->query($sql);
        header("location: dashboard.php");
    }

    // delete skill
    if(isset($_POST['del'])){
        $id=$_POST['del_id'];
        $sql="DELETE FROM skills WHERE id='$id'";
        $stmt=$conn->query($sql);
        header("location: dashboard.php");
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

    <title>Jodelmar's Website</title>

    <style>
        .pic{
            width: 100%;
            height: 400px;
            border-radius: 10px;
        }
        @media all and (min-width: 768px){
            .pic{
                width: 85%;
            }
        }
        @media all and (min-width: 1024px){
            .pic{
                width: 60%;
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
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="project_list.php">Projects</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <?php
        $sql="SELECT * FROM visitors";
        $stmt=$conn->query($sql);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $count=$stmt->rowCount();

        $sql="SELECT * FROM profile";
        $stmt=$conn->query($sql);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container-fluid" style="margin-top: 70px;">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h4 class="d-inline">Welcome, <?php echo $_SESSION['access'] ?></h4>
                <h4 class="float-right d-inline">Visitors: <?php echo $count ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="../upload/<?php echo $row['profile_pic']; ?>" alt="" class="pic">
                        <button class="btn btn-outline-primary d-block" style="margin: 0 auto;" data-toggle="modal" data-target="#changeModal">Change Profile</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary float-right" onclick="enabled_textbox()"><i class="fas fa-pencil-alt"></i></button>
                        <br>
                        <form action="" method="POST">
                            <label for="">Email</label>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $row['gmail'] ?>" name="email" id="email">
                            </div>
                            <label for="">Contact number</label>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $row['phone'] ?>" name="cnumber" id="cnumber">
                            </div>
                            <label for="">Facebook link</label>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $row['facebook'] ?>" name="fb" id="fb">
                            </div>
                            <label for="">Youtube link</label>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $row['youtube'] ?>" name="yt" id="yt">
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-outline-success" name="save">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container">
                <h3 class='text-center'>Skill set
                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><span class="fas fa-plus"></span></button>
                </h3>
                <div class="row">
                <div class="col-md-4">
                        <h5 style="margin-top: 15px;">Programming Language</h5>
                        <?php
                            $arr=array("#ffb163","#c1ff63","#fa70ff","#70fffa","#7aff70");
                            $sql="SELECT * FROM skills WHERE category='PL'";
                            $stmt=$conn->query($sql);
                            $temp=0;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <table class="table table-hover table-dark" style="width: 100%;">
                            <tr style="width: 100%">
                                <td style="width: 50%;">
                                    <div class="form-group">
                                        <p style="color: <?php echo $arr[$temp]; ?>;"><?php echo $row['name']; ?></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $row['percent']; ?>%; background-color: <?php echo $arr[$temp]; ?>;" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 25%">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#updateModal" onclick="getdata(<?php echo $row['id'] ?>,
                                                                                                                                            '<?php echo $row['name'] ?>',
                                                                                                                                            <?php echo $row['percent'] ?>,
                                                                                                                                            '<?php echo $row['category'] ?>')"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delModal" onclick="delId(<?php echo $row['id'] ?>)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </table>
                        <?php
                                $temp+=1;
                                if($temp==count($arr)){
                                    $temp=0;
                                }
                            }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <h5 style="margin-top: 15px;">Server Side</h5>
                        <?php
                            $arr=array("#70d9ff","#ffc370","#ff70e0","#ff7070","#70ffbc");
                            $sql="SELECT * FROM skills WHERE category='Server Side'";
                            $stmt=$conn->query($sql);
                            $temp=0;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <table class="table table-hover table-dark" style="width: 100%;">
                            <tr style="width: 100%">
                                <td style="width: 50%;">
                                    <div class="form-group">
                                        <p style="color: <?php echo $arr[$temp]; ?>;"><?php echo $row['name']; ?></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $row['percent']; ?>%; background-color: <?php echo $arr[$temp]; ?>;" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 25%">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#updateModal" onclick="getdata(<?php echo $row['id'] ?>,
                                                                                                                                            '<?php echo $row['name'] ?>',
                                                                                                                                            <?php echo $row['percent'] ?>,
                                                                                                                                            '<?php echo $row['category'] ?>')"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delModal" onclick="delId(<?php echo $row['id'] ?>)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </table>
                        <?php
                                $temp+=1;
                                if($temp==count($arr)){
                                    $temp=0;
                                }
                            }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <h5 style="margin-top: 15px;">Frameworks and Others</h5>
                        <?php
                            $arr=array("#70ffbc","#9b70ff","#c8ff70","#70cfff","#ff70cf");
                            $sql="SELECT * FROM skills WHERE category='Frameworks'";
                            $stmt=$conn->query($sql);
                            $temp=0;
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <table class="table table-hover table-dark" style="width: 100%;">
                            <tr style="width: 100%">
                                <td style="width: 50%;">
                                    <div class="form-group">
                                        <p style="color: <?php echo $arr[$temp]; ?>;"><?php echo $row['name']; ?></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $row['percent']; ?>%; background-color: <?php echo $arr[$temp]; ?>;" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 25%">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#updateModal" onclick="getdata(<?php echo $row['id'] ?>,
                                                                                                                                            '<?php echo $row['name'] ?>',
                                                                                                                                            <?php echo $row['percent'] ?>,
                                                                                                                                            '<?php echo $row['category'] ?>')"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delModal" onclick="delId(<?php echo $row['id'] ?>)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </table>
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

    <!-- change profile modal -->
    <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="pic">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="change">Save</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- add skill modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Percent</label>
                            <input type="text" class="form-control" name="percent" required>
                        </div>
                        <select name="category" id="" class="form-control" required>
                            <option value="PL" readonly>Programming Language</option>
                            <option value="Server Side" readonly>Server Side</option>
                            <option value="Frameworks" readonly>Frameworks</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- update skill modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="update_name" id="update_name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Percent</label>
                            <input type="text" class="form-control" name="update_percent" id="update_percent" required>
                        </div>
                        <select name="update_category" id="update_category" class="form-control" required>
                            <option value="PL" readonly>Programming Language</option>
                            <option value="Server Side" readonly>Server Side</option>
                            <option value="Frameworks" readonly>Frameworks</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- delete skill modal -->
    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="del_id" id="del_id">
                        <p>Are you sure you want to delete this skill?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="del">YES</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>

<script>
    window.onload=function(){
        document.getElementById("email").disabled=true;
        document.getElementById("cnumber").disabled=true;
        document.getElementById("fb").disabled=true;
        document.getElementById("yt").disabled=true;
    }

    function enabled_textbox(){
        document.getElementById("email").disabled=false;
        document.getElementById("cnumber").disabled=false;
        document.getElementById("fb").disabled=false;
        document.getElementById("yt").disabled=false;
    }

    function getdata(id, name, percent, category){
        document.getElementById("update_id").value=id;
        document.getElementById("update_name").value=name;
        document.getElementById("update_percent").value=percent;
        document.getElementById("update_category").value=category;
    }

    function delId(id){
        document.getElementById("del_id").value=id;
    }
</script>