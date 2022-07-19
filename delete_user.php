<?php
    require_once 'db.php';
    if(isset($_GET['iddelete'])){
        if($_GET['iddelete'] != ""){
            $IdUser = $_GET['iddelete'];
        }
        
    }
    $conn = open_database(); 
    $sql = "DELETE FROM user WHERE IdUser = $IdUser";
    if($conn->query($sql) === TRUE){
        header('Location: QuanLyUser.php');
    }else{
        echo 'Không xóa thông tin được';
    }

?>