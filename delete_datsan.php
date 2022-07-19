<?php
    require_once 'db.php';
    if(isset($_GET['iddeleteDs'])){
	    if($_GET['iddeleteDs'] != ""){
	        $idhd = $_GET['iddeleteDs'];
	    }
	}
    $conn = open_database(); 
    $sql = "DELETE FROM datsan WHERE idHoaDon = $idhd";
    if($conn->query($sql) === TRUE){
        header('Location: Info.php');
    }else{
        echo 'Không xóa thông tin được';
    }
?>