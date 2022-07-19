<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
require_once('db.php');
$MaSan = $_GET['MaSan'];
$IdUser = $_SESSION['id'];
$name = $_SESSION['name'];
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt sân</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        div.infor {
            border: 1px solid gray;
            box-shadow: 5px 7px gray;
            border-radius: 2px;
        }

        img {
            max-width: 1500px;
            max-height: 400px;
        }
    </style>
</head>

<body>
    <!-- Header - Nav bar -->
    <div class="navbar-fixed">
        <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
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
                        <li class="nav-item"><a class="nav-link" href="Info.php?IdUser=<?php echo $IdUser ?>">Thông tin tài khoản</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Đặt sân</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php
    // Lấy thông tin người đặt
    $conn = open_database();
    $sql = "SELECT * FROM user WHERE IdUser = $IdUser";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['FirstName'] . $row['LastName'];
    $sdt = $row['Sdt'];

    // Lay thong tin đặt sân 
    $error = "";
    $NgayDat = "";
    $thanhtoan = "";
    
    if (
        isset($_POST['name']) && isset($_POST['sdt']) && isset($_POST['date']) && isset($_POST['id']) && 
        isset($_POST['masan']) && isset($_POST['tongtien']) && isset($_POST['thanhtoan'])
        ) {
        $date = $_POST['date'];
        $thanhtoan = $_POST['thanhtoan'];
        $IdUser = $_POST['id'];
        $name =$_POST['name'];
        $sdt =$_POST['sdt'];
        $MaSan =$_POST['masan'];
        $TongTien =$_POST['tongtien'];
        $trangthai = "Chưa duyệt";
      
        if (empty($date)) {
            $error = "Vui lòng chọn ngày đặt";
        } else if (empty($thanhtoan)) {
            $error = "Vui lòng chọn phương thức thanh toán";
        } else {
            $result = datsan($IdUser, $name, $sdt, $date, $MaSan, $TongTien, $thanhtoan,$trangthai);
            if ($result['code'] == 0) {
                header('Location:Info.php');
                exit();
            } else if ($result['code'] == 1) {
                $error = 'This email is already exists';
            } else {
                $error = 'An error occured. Please try again later';
            }
        }
    }
    ?>
    <div class="container">
        <?php
        // Hiên thị thông tin sân
        $conn = open_database();
        $sql1 = "SELECT * FROM san WHERE MaSan = $MaSan";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $TongTien = $row1['GiaThue'];


        ?>
        <div>
            <img class="d-block w-100" src="<?php echo $row1['AnhSan'] ?>" alt="Ảnh sân">
        </div>

        <form action="" method="POST">

            <div class="container mt-3">
                <h5 class="text-center">ĐẶT SÂN</h5>
                <h4>Thông tin đặt sân</h4>
                <input type="hidden" name="idHD" value="<?php echo $idhd ?>"><!--Ẩn id hoa don -->
                <input type="hidden" name="id" value="<?php echo $IdUser ?>"> <!--Ẩn id người dùng -->
                <input type="hidden" name="masan" value="<?php echo $MaSan ?>"> <!--Ẩn id sân -->
                <input type="hidden" name="name" value="<?php echo $name ?>"> <!--Ẩn tên người dùng -->
                <input type="hidden" name="sdt" value="<?php echo $sdt ?>"> <!--Ẩn sdt -->
                <input type="hidden" name="tongtien" value="<?php echo $TongTien ?>"> <!--Ẩn tiền-->

                <label for="date">Ngày đặt</label>
                <input type="datetime-local" class="form-control" id="date" name="date">

                <label for="name">Phương thức thanh toán</label>
                <div class="input-group">
                    <select class="input-group" name="thanhtoan">
                        <option value="Tiền mặt" <?php echo $thanhtoan == "Tiền mặt" ? "selected" : "" ?>>Tiền mặt</option>
                        <option value="Chuyển khoản" <?php echo $thanhtoan == "Chuyển khoản" ? "selected" : "" ?>>Chuyển khoản</option>
                    </select>
                </div>
                <div>
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <button type="submit" class="btn btn-primary my-3">Đặt sân</button>
                </div>
        </form>

    </div>

    </div>



</body>

</html>