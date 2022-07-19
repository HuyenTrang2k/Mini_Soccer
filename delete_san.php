<?php
    require_once 'db.php';
    if(isset($_GET['iddeleteSan'])){
        if($_GET['iddeleteSan'] != ""){
            $MaSan = $_GET['iddeleteSan'];
        }
	}
    $conn = open_database(); 
    $sql = "DELETE FROM san WHERE MaSan = $MaSan";
    if($conn->query($sql) === TRUE){
        header('Location: QuanLySan.php');
    }else{
        echo 'Không xóa thông tin được';
    }
?>