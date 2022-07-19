<?php
session_start();
if (!isset($_SESSION['user']) && ($_SESSION['role'] == "Customer")) {
    header('Location: login.php');
    exit();
}
require_once('db.php');
$role = $_SESSION['role'];
$IdUser = $_SESSION['id'];
$name = $_SESSION['name'];
if(isset($_GET['iddeleteDs'])){
    if($_GET['iddeleteDs'] != ""){

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    // Lấy thông tin người dùng
    $conn = open_database();
    $sql1 = "SELECT * FROM user WHERE IdUser=$IdUser";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    ?>
    <!-- Header - Nav bar -->

    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white" style="position: relative">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a href="trangChu.php" class="navbar-brand py-1 ml-2">
                    <img src="img/logo.jpg" alt="Logo" style="width: 60px; height: 35px;" />
                </a>
                <h4>King Sport</h4>
            </div>
            <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <div id="navbarCollapse" class="collapse navbar-collapse mr-3">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="Info.php">Thông tin tài khoản</a></li>
                    <li class="nav-item"><a class="nav-link" href="trangChu.php">Đặt sân</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- End Header - Nav bar -->
    <div class="container" style="position: absolute; margin-left: 10%; margin-top: 50px;">
        <div class="row text-center">
            <div class="col-3">
                <div class="" style="background-color: rgb(241, 241, 241); border-right: darkgray;">
                  
                        <img src="<?php echo $row1['Avt'] ?>" alt="Anh dai dien" style="width:100px; height:100px; margin-top: 50px;">
                        <p style="margin:0px 40px;"><?php echo $name ?></p>
                  
                    <hr>
                    
                </div>
                <div class="" style="margin-left: 10%;">
                    <h5>THÔNG TIN TÀI KHOẢN</h5>

                    <div class="form-group">
                        <label for="HoTen">Họ và Tên: <?php echo $row1['FirstName'] . ' ' . $row1['LastName'] ?></label>
                        <br>
                        <label for="address">Địa chỉ: <?php echo $row1['Address'] ?></label>
                        <br>
                        <label for="sdt">Số điện thoại: <?php echo $row1['Sdt'] ?></label>
                        <br>
                        <label for="exampleInputEmail1">Email: <?php echo $row1['Email'] ?></label>

                    </div>

                    <a class="btn btn-success" href="UpdateInfo.php?IdUser=<?php echo $IdUser ?>">Cập nhật</a>

                </div>

            </div>

            <div class="col-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên sân</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <?php
                    $conn = open_database();
                    $sql1 = "SELECT * FROM datsan WHERE IdUser = $IdUser";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $MaSan = $row1['MaSan'];
                            //Lấy thông tin sân
                            $sql = "SELECT * FROM san WHERE MaSan = $MaSan";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $ngaydat = $row1['NgayDat'];
                    ?>
                                <tbody>
                                    <tr class="table-active">
                                        <td scope="col"><?php echo $row['TenSan'] ?></td>
                                        <td scope="col"><?php echo $row['DiaChi'] ?></td>
                                        <td scope="col"><?php echo $row1['NgayDat'] ?></td>
                                        <td scope="col"><?php echo $row1['TongTien'] ?></td>
                                        <td scope="col"><?php echo $row1['ThanhToan'] ?></td>
                                        <td scope="col"><?php echo $row1['TrangThai'] ?></td>
                                        <?php
                                        $date = getdate();
                                        $date = date('Y-m-d');
                                        if($ngaydat > $date){
                                            echo '<td scope="col"><a href="datsan.php?IdHoaDon='.$row1['idHoaDon'].'&MaSan='.$MaSan.'">Đổi lịch đặt sân</a>|| <a onclick="
                                            return checkOk()" href="delete_datsan.php?iddeleteDs='.$row1['idHoaDon'].'">Xóa</a></td>';
                                        }else{
                                            echo '<td scope="col"></td>';
                                        }
                                        
                                        ?>

                                    </tr>

                                </tbody>
                    <?php

                            }
                        }
                    } else {
                        echo 'Bạn chưa đặt sân.';
                    }

                    ?>

                </table>

            </div>
        </div>

     

</body>
<script>
    function checkOk(){
        var result = confirm("Xác nhận hủy sân");
        if(result){
            return true;
        }else{
            return false;
        }
    }
</script>  
</html>