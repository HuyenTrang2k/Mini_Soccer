<?php
session_start();
if (isset($_SESSION['user'])  && ($_SESSION['role'] == "Admin") || $_SESSION['role'] == "Staff") {
    $role = $_SESSION['role'];
    $IdUser = $_SESSION["id"];
    $masan = $_GET['MaSan'];
    $idhd = $_GET['IdHoaDon'];
} else {
    header("location: login.php");
    exit();
}
require_once 'db.php';

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Thêm người dùng</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .btn {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Darker background on mouse-over */
        .btn:hover {
            background-color: RoyalBlue;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                <li class="nav-item"><a class="nav-link" href="logout.php">Đăng xuất</a></li>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/logo.jpg" alt="King Sport Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">King Sport</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/ky.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Huyền Trang</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="QuanLyUser.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Quản lý người dùng

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="QuanLySan.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Quản lý sân bóng

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="QuanLyDatSan.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Quản lý đặt sân

                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Sửa trạng thái đơn đặt sân</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <?php

            
            // Lấy thông tin đặt sân từ bảng đặt sân
            $conn = open_database();
            $sql = "SELECT * FROM datsan WHERE idHoaDon = $idhd";
            $result1 = $conn->query($sql);
            $row1 = $result1->fetch_assoc();
            $error = '';
            $iduser =  $row1['IdUser'];
            $name =  $row1['HoTen'];
            $sdt =  $row1['Sdt'];
            $ngaydat =  $row1['NgayDat'];
            $masan =  $row1['MaSan'];
            $tongtien =  $row1['TongTien'];
            $thanhtoan =  $row1['ThanhToan'];
            $trangthai =  '';

            if (
                isset($_POST['idHD']) && isset($_POST['IdUser']) && isset($_POST['name'])
                && isset($_POST['sdt']) && isset($_POST['date']) && isset($_POST['MaSan'])&& isset($_POST['tongtien'])
                && isset($_POST['thanhtoan'])  && isset($_POST['trangthai'])
            ) {
                $idhd = $_POST['idHD'];
                $iduser = $_POST['IdUser'];
                $name = $_POST['name'];
                $sdt = $_POST['sdt'];
                $ngaydat = $_POST['date'];
                $masan = $_POST['MaSan'];
                $tongtien = $_POST['tongtien'];
                $thanhtoan = $_POST['thanhtoan'];
                $trangthai = $_POST['trangthai'];
                
                if (empty($trangthai)) {
                    $error = 'Vui lòng nhập tình trạng xử lý đơn đặt sân';
                } else {
                    // register a new account
                    $result = datsan($iduser,$name,$sdt,$ngaydat,$masan,$tongtien,$thanhtoan,$trangthai);
                    if ($result['code'] == 0) {
                        echo '<h3 class="text-success text-center">Đã sửa trạng thái đặt sân thành công</h3>';
                        echo '<br><a href="QuanLyDatSan.php" class="badge badge-success  text-center">Quay lại </a>';
                        exit();
                    } else if ($result['code'] == 2) {
                        $error = 'Không thể sửa ';
                    } else {
                        $error = 'Đã xảy ra lỗi! Vui lòng thử lại';
                    }
                }
            }
            ?>
            <div class="container">
            <form method="POST" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idHD">IdHD</label>
                            <input  value="<?= $idhd ?>" name="idHD" required class="form-control" type="text" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="IdUser">IdUser</label>
                            <input  value="<?= $iduser ?>" name="IdUser" required class="form-control" type="text" >
                            <div class="invalid-tooltip">Vui lòng nhập tên</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input  value="<?= $name ?>" name="name" required class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input  value="<?= $sdt ?>" name="sdt" required class="form-control" type="text"  id="sdt">
                        
                    </div>
                    <div class="form-group">
                        <label for="date">Ngày đặt</label>
                        <input  value="<?= $ngaydat ?>" name="date" required class="form-control" type="text" id="date">
                        
                    </div>

                    <div class="form-group">
                        <label for="MaSan">Mã sân</label>
                        <input  value="<?= $masan ?>" name="MaSan" required class="form-control" type="text"  id="MaSan">
                        
                    </div>
                    <div class="form-group">
                        <label for="tongtien">Tổng tiền</label>
                        <input  value="<?= $tongtien ?>" name="tongtien" required class="form-control" id="tongtien">
                       
                    </div>
                    <div class="form-group">
                        <label for="thanhtoan">Thanh toán</label>
                        <input  value="<?= $thanhtoan ?>" name="thanhtoan" required class="form-control" type="text" id="thanhtoan">
                        
                    </div>
                    <div class="form-group">
                        <label for="trangthai">Trạng thái</label>
                        <input value="<?= $trangthai ?>" name="trangthai" class="form-control" type="text" id="trangthai">
                        
                    </div>

                    <div class="form-group text-center">
                        <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                        ?>
                        <button type="submit" class="btn btn-success px-5 mt-3 mr-2">Tạo</button>
                        <button type="reset" class="btn btn-outline-success px-5 mt-3">Hủy </button>
                    </div>
                   
                </form>
            </div>


        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>