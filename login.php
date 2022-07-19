<?php
    session_start();
    require_once('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php
    $error = '';
    $user = '';
    $pass = '';
    require_once 'db.php';
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        if (empty($user)) {
            $error = 'Vui lòng nhập username';
        }
        else if (empty($pass)) {
            $error = 'Vui lòng nhập mật khẩu';
        }
        else if (strlen($pass) < 6) {
            $error = 'Mật khẩu ít nhất 6 ký tự';
        }
        else {
            
            
            $result = login($user,$pass);
            if($result['code']==0){
                $data= $result['data'];
                $_SESSION['user'] = $data['UserName'];
                $_SESSION['role'] = $data['Role'];
                $_SESSION['id'] = $data['IdUser'];
                $_SESSION['email'] = $data['Email'];
                $_SESSION['sdt'] = $data['Sdt'];
                $_SESSION['address'] = $data['Address'];
                $_SESSION['name'] = $data['FirstName']. ' '. $data['LastName'];
                if (($_SESSION['role'] =="Admin" || $_SESSION['role']=="Staff")) {
                    header('Location: QuanLySan.php');
                    
                }else {
                    header('Location: Info.php');
                    
                }
                exit();
            }else{
                $error = $result['error'];
            }
        }

    }
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h3 class="text-center text-secondary mt-5 mb-3">Đăng nhập</h3>
            <form method="post" action="" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input value="<?= $user ?>" name="user" id="user" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="pass" value="<?= $pass ?>" id="password" type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group custom-control custom-checkbox">
                    <input <?= isset($_POST['remember']) ? 'checked' : '' ?> name="remember" type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Remember login</label>
                </div>
                <div class="form-group text-center">
                    <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button class="btn btn-success px-5">Login</button>
                </div>
                <div class="form-group">
                    <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>.</p>
                    
                </div>
            </form>
            
        </div>
    </div>
</div>

</body>
</html>
