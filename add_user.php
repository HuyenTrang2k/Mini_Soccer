<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['role'] == "Admin") {
    $role = $_SESSION['role'];
    $IdUser = $_SESSION["id"];
    
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
    <?php
        $conn= open_database();
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
            <a href="index3.html" class="brand-link">
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
                        <a href="#" class="d-block"><?php echo $row['FirstName'] .' '. $row['LastName']?></a>
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
                            <h1 class="m-0 text-dark">Thêm người dùng</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <?php

            $error = "";
            $first = "";
            $last = "";
            $sdt = "";
            $email = "";
            $address = "";
            $user = "";
            $pass = "";
            $avt = "";
            $file = "";
            $role = "";

            if (
                isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])
                && isset($_POST['sdt']) && isset($_POST['address']) && isset($_POST['user'])&& isset($_FILES['image'])
                && isset($_POST['pass']) && isset($_POST['role'])
            ) {
                $first = $_POST['first'];
                $last = $_POST['last'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $file = $_FILES['image'];
                $role = $_POST['role'];
                $avt = $file['name'];
                $linkimage = "img/" . $file['name'];
                
                if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
                    move_uploaded_file($file['tmp_name'], 'img/' . $avt);
                }
                if (empty($first)) {
                    
                    $error = 'Please enter your first name';
                } else if (empty($last)) {
                    $error = 'Please enter your last name';
                } else if (empty($email)) {
                    $error = 'Please enter your email';
                } else if (empty($sdt)) {
                    $error = 'Please enter your phone number';
                } else if (empty($address)) {
                    $error = 'Please enter your address';
                } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                    $error = 'This is not a valid email address';
                } else if (empty($user)) {
                    $error = 'Please enter your username';
                } else if (empty($pass)) {
                    $error = 'Please enter your password';
                } else if (strlen($pass) < 6) {
                    $error = 'Password must have at least 6 characters';
                } else if (empty($avt)) {
                    $error = 'Vui lòng chọn ảnh đại diện';
                } else if ($file['type'] != 'image/jpeg' && $file['type'] != 'image/jpg' && $file['type'] != 'image/png') {
                    $error = 'Vui lòng chọn file ảnh';
                } else {
                    // register a new account
                    $result = register_user($user, $first, $last, $email, $sdt, $address, $pass, $role, $linkimage);
                    if ($result['code'] == 0) {
                        echo '<h3 class="text-success text-center">Đã cập nhật thành công</h3>';
                        echo '<br><a href="QuanLyUser.php" class="badge badge-success  text-center">Quay lại </a>';
                        exit();
                    } else {
                        $error = 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
                    }
                }
            }
            // Hiển thị thông tin người dùng khi bấm nút sửa
                if(isset($_GET['IdUser'])){
                    $conn = open_database();
                    $iduser=$_GET['IdUser'];
                    $sql = "SELECT * FROM user WHERE IdUser=$iduser";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $first = $row['FirstName'];
                    $last = $row['LastName'];
                    $sdt = $row['Sdt'];
                    $email = $row['Email'];
                    $address = $row['Address'];
                    $user = $row['UserName'];
                    $role = $row['Role'];
                    
                }

            ?>


            <div class="container">
            <form method="post" action="" novalidate enctype="multipart/form-data">
                    <div class="form-row">
                    <input type="hidden" name="IdUser" value="<?php echo $iduser ?>">
                        <div class="form-group col-md-6">
                            <label for="first">Họ</label>
                            <input value="<?= $first ?>" name="first" required class="form-control" type="text" placeholder="Nhập họ" id="first">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last">Tên</label>
                            <input value="<?= $last ?>" name="last" required class="form-control" type="text" placeholder="Nhập tên" id="last">
                            <div class="invalid-tooltip">Vui lòng nhập tên</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?= $email ?>" name="email" required class="form-control" type="email" placeholder="Nhập Email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input value="<?= $sdt ?>" name="sdt" required class="form-control" type="text" placeholder="Nhập số điện thoại" id="sdt">
                        <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input value="<?= $address ?>" name="address" required class="form-control" type="text" placeholder="Nhập địa chỉ" id="address">
                        <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                    </div>

                    <div class="form-group">
                        <label for="user">Tên tài khoản</label>
                        <input value="<?= $user ?>" name="user" required class="form-control" type="text" placeholder="Nhập tên tài khoản" id="user">
                        <div class="invalid-feedback">Vui lòng nhập tên tài khoản</div>
                    </div>
                    <div class="form-group">
                        <label for="user">Phân quyền</label>
                        <input value="<?= $role ?>" name="role" required class="form-control" type="text" placeholder="Nhập tên tài khoản" id="user">
                        <div class="invalid-feedback">Vui lòng phân quyền</div>
                    </div>
                    <div class="form-group">
                        <label for="pass">Mật khẩu</label>
                        <input value="<?= $pass ?>" name="pass" required class="form-control" type="password" placeholder="Nhập mật khẩu" id="pass">
                        <div class="invalid-feedback">Sai mật khẩu.</div>
                    </div>
                    <div class="form-group">
                        <label for="image">Ảnh đại diện:</label>
                        <input type="file" class="form-control" placeholder="Chọn ảnh" id='image' name='image'>
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