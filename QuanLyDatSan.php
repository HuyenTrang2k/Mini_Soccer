<?php
session_start();
if (isset($_SESSION['user']) && ($_SESSION['role'] == "Admin") || $_SESSION['role'] == "Staff") {
    $role = $_SESSION['role'];
    $IdUser = $_SESSION['id'];
    $name = $_SESSION['name'];
} else {
    header("location: login.php");
    exit();
}
require_once('db.php');


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Quản lý đặt sân</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <?php
    $conn = open_database();
    $sql = "SELECT * FROM user WHERE IdUser = $IdUser";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    ?>
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
            <a href="trangChu.php" class="brand-link">
                <img src="dist/img/logo.jpg" alt="King Sport Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">King Sport</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo $row['Avt'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $row['FirstName'] . ' ' . $row['LastName'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
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
                            <a href="#" class="nav-link">
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
                            <h1 class="m-0 text-dark">Quản lý đặt sân</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>


            <!--Table Information User-->
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">IdHD</th>
                        <th scope="col">IdUser</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Mã sân</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php
                $conn = open_database();
                $sql1 = "SELECT * FROM datsan";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $idhd = $row1['idHoaDon'];
                ?>
                <tbody>

                    <tr class="table-active">
                        <input type="hidden" name="idHD" value="<?php echo $idhd ?>">
                        <td scope="col"><?php echo $row1['idHoaDon'] ?></td>
                        <td scope="col"><?php echo $row1['IdUser'] ?></td>
                        <td scope="col"><?php echo $row1['HoTen'] ?></td>
                        <td scope="col"><?php echo $row1['Sdt'] ?></td>
                        <td scope="col"><?php echo $row1['NgayDat'] ?></td>
                        <td scope="col"><?php echo $row1['MaSan'] ?></td>
                        <td scope="col"><?php echo $row1['TongTien'] ?></td>
                        <td scope="col"><?php echo $row1['ThanhToan'] ?></td>
                        <td scope="col"><?php echo $row1['TrangThai'] ?></td>
                        <td scope="col">
                            <a
                                href="duyet.php?MaSan=<?php echo $row1['MaSan'] ?>&IdHoaDon=<?php echo $idhd ?>">Duyệt</a>
                        </td>
                    </tr>

                </tbody>
                <?php

                    }
                } else {
                    echo '<div class="text-center text-success"> <h3> Hiện tại chưa ai đặt sân!!!</h3></div>';
                }
                ?>
            </table>
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