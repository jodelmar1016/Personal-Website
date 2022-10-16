<?php
    session_start();
    if(!isset($_SESSION['access'])){
        header("location: access.php");
    }
    include("../config.php");

    if(isset($_POST['add'])){
        // Directory
        $target=array("../upload/".basename($_FILES['image1']['name']),
                      "../upload/".basename($_FILES['image2']['name']),
                      "../upload/".basename($_FILES['image3']['name']),
                      "../upload/".basename($_FILES['image4']['name']),
                      "../upload/".basename($_FILES['image5']['name']),
                      "../upload/".basename($_FILES['image6']['name']));
        // Temp dir
        $tmp=array($_FILES['image1']['tmp_name'],
                    $_FILES['image2']['tmp_name'],
                    $_FILES['image3']['tmp_name'],
                    $_FILES['image4']['tmp_name'],
                    $_FILES['image5']['tmp_name'],
                    $_FILES['image6']['tmp_name']);
    
        // insert all in database
        $sql="INSERT INTO projects (title,image1,image2,image3,image4,image5,image6, description, features, programming_language,db,date_created,link) VALUES (:title,:img1,:img2,:img3,:img4,:img5,:img6,:desc, :fet,:pl,:db,:date_created,:link)";
        $stmt=$conn->prepare($sql);
        $stmt->execute([':title'=>$_POST['title'],
                        ':img1'=>$_FILES['image1']['name'],
                        ':img2'=>$_FILES['image2']['name'],
                        ':img3'=>$_FILES['image3']['name'],
                        ':img4'=>$_FILES['image4']['name'],
                        ':img5'=>$_FILES['image5']['name'],
                        ':img6'=>$_FILES['image6']['name'],
                        ':desc'=>$_POST['description'],
                        ':fet'=>$_POST['features'],
                        ':pl'=>$_POST['PL'],
                        ':db'=>$_POST['db'],
                        ':date_created'=>$_POST['date_created'],
                        ':link'=>$_POST['link']]);

        // upload images to folder
        for ($x = 0; $x < 6; $x++) {
            move_uploaded_file($tmp[$x], $target[$x]);
        }
        header("location: project_list.php");
    }

    // update project
    if(isset($_POST['update'])){
        $sql="UPDATE projects SET title=:title,description=:desc,features=:fet,programming_language=:PL,db=:db,date_created=:date_created,link=:link WHERE id=:id";
        $stmt=$conn->prepare($sql);
        $stmt->execute([':title'=>$_POST['update_title'],
                        ':desc'=>$_POST['update_description'],
                        ':fet'=>$_POST['update_features'],
                        ':PL'=>$_POST['update_PL'],
                        ':db'=>$_POST['update_db'],
                        ':date_created'=>$_POST['update_date_created'],
                        ':link'=>$_POST['update_link'],
                        ':id'=>$_POST['update_id']]);
        header("location: project_list.php");
    }

    // delete project
    if(isset($_POST['del'])){
        $id=$_POST['delId'];
        $sql="SELECT * FROM projects WHERE id=$id";
        $stmt=$conn->query($sql);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        unlink("../upload/".$row['image1']);
        unlink("../upload/".$row['image2']);
        unlink("../upload/".$row['image3']);
        unlink("../upload/".$row['image4']);
        unlink("../upload/".$row['image5']);
        unlink("../upload/".$row['image6']);

        $sql="DELETE FROM projects WHERE id=$id";
        $stmt=$conn->query($sql);
        header("location: project_list.php");
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
        .con{
            margin-top: 80px;
            margin-left: 10px;
            margin-right: 10px;
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
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="project_list.php">Projects <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="con">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h4>My projects
                    <span><button class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><span class="fas fa-plus"></span></button></span>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-hover table-dark table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Features</th>
                        <th scope="col">Programming language</th>
                        <th scope="col">Database</th>
                        <th scope="col">Date created</th>
                        <th scope="col">Link</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql="SELECT * FROM projects";
                            $stmt=$conn->query($sql);
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo str_replace(";","<br>",$row['features']) ?></td>
                            <td><?php echo $row['programming_language'] ?></td>
                            <td><?php echo $row['db'] ?></td>
                            <td><?php echo $row['date_created'] ?></td>
                            <td><?php echo $row['link'] ?></td>
                            <td>
                                <div class="button-group" role="group">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#updateModal" onclick="getData(<?php echo $row['id'] ?>,
                                                                                                                                            '<?php echo $row['title'] ?>',
                                                                                                                                            '<?php echo $row['description'] ?>',
                                                                                                                                            '<?php echo $row['features'] ?>',
                                                                                                                                            '<?php echo $row['programming_language'] ?>',
                                                                                                                                            '<?php echo $row['db'] ?>',
                                                                                                                                            '<?php echo $row['date_created'] ?>',
                                                                                                                                            '<?php echo $row['link'] ?>')"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal" onclick="getId(<?php echo $row['id']; ?>)"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Add modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <input type="file" name="image1">
                        </div>
                        <div class="form-group">
                            <input type="file" name="image2">
                        </div>
                        <div class="form-group">
                            <input type="file" name="image3">
                        </div>
                        <div class="form-group">
                            <input type="file" name="image4">
                        </div>
                        <div class="form-group">
                            <input type="file" name="image5">
                        </div>
                        <div class="form-group">
                            <input type="file" name="image6">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" placeholder="Decription">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="features" placeholder="Features">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="PL" placeholder="Programming Language">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="db" placeholder="Database">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="date_created" placeholder="Date created">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="link" placeholder="Link">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">
                            <input type="text" class="form-control" name="update_title" id="update_title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <input type="text" name="update_description" class="form-control" id="update_description" placeholder="Decription">
                        </div>
                        <div class="form-group">
                            <input type="text" name="update_features" class="form-control" id="update_features" placeholder="Features">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="update_PL" id="update_PL" placeholder="Programming Language">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="update_db" id="update_db" placeholder="Database">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="update_date_created" id="update_date_created" placeholder="Date created">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="update_link" id="update_link" placeholder="Link">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Delete modal -->
     <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="delId" id="delId" >
                        <p>Are you sure you want to delete the project?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-primary" name="del">YES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>

<script>
    function getId(x){
        document.getElementById("delId").value=x;
    }

    function getData(id,title,description,features,PL,db,date_created,link){
        document.getElementById("update_id").value=id;
        document.getElementById("update_title").value=title;
        document.getElementById("update_description").value=description;
        document.getElementById("update_features").value=features;
        document.getElementById("update_PL").value=PL;
        document.getElementById("update_db").value=db;
        document.getElementById("update_date_created").value=date_created;
        document.getElementById("update_link").value=link;
    }
</script>