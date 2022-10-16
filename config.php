<?php
//      try{
//         $conn=new PDO("mysql:host=sql102.epizy.com; dbname=epiz_29049934_jodelmardb","epiz_29049934","TLBjRb5b2wtmHt");
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }
//     catch(PDOException $e){
//          echo "Connection failed".$e->getMessage();
//     }
    try{
        $conn=new PDO("mysql:host=epiz_32163735; dbname=epiz_32163735_myWebsite","sql201.epizy.com","eZltdOKLDIyNbh");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
         echo "Connection failed".$e->getMessage();
    }
?>