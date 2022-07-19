<?php
session_start();
require_once('db.php');
$role = $_SESSION['role'];
$IdUser = $_SESSION['id'];
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
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
    
    <?php // Lấy thông tin khách hàng hiển thị lên form sửa thông tin
    $conn = open_database();
    $sql = "SELECT * FROM user WHERE IdUser=$IdUser";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $first = $row["FirstName"];
    $last = $row["LastName"];
    $address = $row["Address"];
    $sdt = $row["Sdt"];
    $email = $row["Email"];
    $user = $row["UserName"];
    $pass = "";
    $file = "";
    $avt ="";
    
    if ( // Kiểm tra dữ liệu được cập nhật
        isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])
        && isset($_POST['sdt']) && isset($_POST['address']) && isset($_POST['user']) && isset($_FILES['image'])
        && isset($_POST['pass'])
    ) {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $file = $_FILES['image'];
        $avt = $file['name'];
        $linkimage = "img/" . $file['name'];
        
        if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
            move_uploaded_file($file['tmp_name'], 'img/' . $avt);
        }
        if (empty($first)) {
            echo $first . $last .$email . $sdt . $linkimage;
            $error = 'Vui lòng nhập họ';
        } else if (empty($last)) {
            $error = 'Vui lòng nhập tên';
        } else if (empty($email)) {
            $error = 'Vui lòng nhập email';
        } else if (empty($sdt)) {
            $error = 'Vui lòng nhập số điện thoại';
        } else if (empty($address)) {
            $error = 'Vui lòng nhập địa chỉ';
        } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'Vui lòng nhập email hợp lệ';
        } else if (empty($user)) {
            $error = 'Vui lòng nhập tên tài khoản';
        } else if (empty($pass)) {
            $error = 'Vui lòng nhập mật khẩu';
        } else if (strlen($pass) < 6) {
            $error = 'Vui lòng nhập mật khẩu lớn hơn 6 ký tự';
        } else if (empty($avt)) {
            $error = 'Vui lòng chọn ảnh đại diện';
        } else if ($file['type'] != 'image/jpeg' && $file['type'] != 'image/jpg' && $file['type'] != 'image/png') {
            $error = 'Vui lòng chọn file ảnh';
        } else {
            // register a new account
            $result = updateInfo($user, $first, $last, $email, $sdt, $address, $pass, $role, $linkimage);
            if ($result['code'] == 0) {
                header('Location:Info.php?IdUser='.$IdUser.'');
                exit();
            } else if ($result['code'] == 1) {
                $error = 'This email is already exists';
            } else {
                $error = 'An error occured. Please try again later';
            }
        }
    }


    ?>
    <h3 class="text-center mt-3 text-info">Cập nhật thông tin của bạn</h3>
    <div class="container w-50 mt-5">

        <form method="post" action="" novalidate enctype="multipart/form-data">
            <div class="form-group">
            <label for="user">Tên tài khoản</label>
                <input value="<?= $user ?>" type="text" class="form-control" id="user" name="user" placeholder="Tên tài khoản">

                <label for="HoTen">Họ</label>
                <input value="<?= $first ?>" type="text" class="form-control" id="first" name="first" placeholder="Họ">

                <label for="HoTen">Tên</label>
                <input value="<?= $last ?>" type="text" class="form-control" id="last" name="last" placeholder="Tên">

                <label for="address">Địa chỉ</label>
                <input value="<?= $address ?>" type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ">

                <label for="sdt">Số điện thoại</label>
                <input value="<?= $sdt ?>" type="text" class="form-control" id="sdt" name="sdt" placeholder="Số điện thoại">

                <label for="email">Email</label>
                <input value="<?= $email ?>" type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="pass">Mật khẩu</label>
                <input value="<?= $pass ?>" type="password" class="form-control" id="pass" name="pass" placeholder="Password">
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
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</body>

</html>