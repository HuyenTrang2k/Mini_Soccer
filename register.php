<?php
    session_start();
    
    if (isset($_SESSION['user'])) {
        $title = "Sửa thông tin tài khoản";
        $IdUser = $_SESSION["id"];
        $btn = "Cập nhật";
    }else{
        $title = "Đăng ký tài khoản";
        $btn = "Đăng ký";
    }

    require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .bg {
            background: #eceb7b;
        }
    </style>
</head>

<body>
    <?php
    
    $error = '';
    $first = '';
    $last = '';
    $sdt = '';
    $email = '';
    $address = '';
    $user = '';
    $pass = '';
    $avt = '';
    $file = '';
    $role = "Customer";
 
    if (
        isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])
        && isset($_POST['sdt']) && isset($_POST['address']) && isset($_POST['user'])&& isset($_FILES['image'])
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
            $result = register($user, $first, $last, $email, $sdt, $address, $pass, $role,$linkimage);
            if ($result['code'] == 0) {
                header('Location:Login.php');
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
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border my-5 p-4 rounded mx-3">
                <h3 class="text-center text-secondary mt-2 mb-3 mb-3"><?php echo $title ?></h3>
                
                <form method="post" action="" novalidate enctype="multipart/form-data">
                    <div class="form-row">
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
                        <button type="submit" class="btn btn-success px-5 mt-3 mr-2"><?php echo $btn ?></button>
                        <button type="reset" class="btn btn-outline-success px-5 mt-3">Hủy </button>
                    </div>
                    <div class="form-group">
                        <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a> ngay bây giờ.</p>
                    </div>
                </form>

            </div>
        </div>

    </div>
</body>

</html>