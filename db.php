<?php

define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'cnpm');

function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    $conn->set_charset("utf8");
    if ($conn->connect_error) {
        die('Connect error:' . $conn->connect_error);
    }
    return $conn;
}
function login($user, $pass)
{
    $sql = "SELECT * FROM user WHERE UserName = ?";
    $conn = open_database();

    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $user);

    if (!$stm->execute()) {
        //chay sql that bai vi 1 ly do nao do
        return array('code' => 1, 'error' => 'Không thể thực hiện đăng nhập');
    }

    $result = $stm->get_result();
    // Kiểm tra username có tồn tại không?
    if ($result->num_rows == 0) {
        //user khong ton tai
        return array('code' => 1, 'error' => 'Tài khoản không tồn tại');
    }

    $data = $result->fetch_assoc();
    // check pass
    $hased_password = $data['Pass'];
    if (!password_verify($pass, $hased_password)) {
        // co user nhung sai password
        return array('code' => 2, 'error' => 'Sai mật khẩu');
    } else
        return array('code' => 0, 'error' => '', 'data' => $data);
}
function is_mail_exists($email)
{
    // chuyen lai select username
    $sql = "select UserName from user where email = ?";
    $conn = open_database();

    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $email);

    if (!$stm->execute()) {
        die('Query error' . $stm->error);
    }

    $result = $stm->get_result();
    if ($result->num_rows > 0) {
        return true; // co email
    } else {
        return false;
    }
}
function register($user, $first, $last, $email, $sdt, $address, $pass, $role, $linkimage)
{
    // ma hoa password
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    if (empty($_POST['IdUser'])) {
        if (is_mail_exists($email)) {
            return array('code' => 1, 'error' => 'Email exists');
        }
        $conn = open_database();
        $sql = 'INSERT INTO user(UserName,FirstName, LastName ,Email,Sdt,Address,Pass,Role, Avt) values(?,?,?,?,?,?,?,?,?)';
        $stm = $conn->prepare($sql);
    } else {
        $conn = open_database();
        $IdUser = $_POST['IdUser'];
        $stm = $conn->prepare("UPDATE user SET UserName=?,FirstName=?,LastName=?,Email=?,Sdt=?,Address=?,Pass=?,Role=?,Avt=? WHERE IdUser=$IdUser");
    }

    $stm->bind_param('sssssssss', $user, $first, $last, $email, $sdt, $address, $hash, $role, $linkimage);
    if (!$stm->execute()) {
        return array('code' => 2, 'error' => 'can not execute command');
    }

    return array('code' => 0, 'error' => 'Create account successful');
}
function register_user($user, $first, $last, $email, $sdt, $address, $pass, $role, $linkimage)
{
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    if(empty($_POST['IdUser'])){
        $conn = open_database();
        $sql = 'INSERT INTO user(UserName,FirstName, LastName ,Email,Sdt,Address,Pass,Role, Avt) values(?,?,?,?,?,?,?,?,?)';
        $stm = $conn->prepare($sql);
        
    } else {
        $conn = open_database();
        $IdUser = $_POST['IdUser'];
        $stm = $conn->prepare("UPDATE user SET UserName=?,FirstName=?,LastName=?,Email=?,Sdt=?,Address=?,Pass=?, Role=?, Avt=? WHERE IdUser= $IdUser");
    }
    $stm->bind_param('sssssssss', $user, $first, $last, $email, $sdt, $address, $hash, $role, $linkimage);

    if (!$stm->execute()) {
        return array('code' => 2, 'error' => 'can not execute command');
    }

    return array('code' => 0, 'error' => 'Create account successful');
}

function updateInfo($user, $first, $last, $email, $sdt, $address, $pass, $role, $linkimage)
{
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $conn = open_database();
    $IdUser = $_SESSION['id'];
    $stm = $conn->prepare("UPDATE user SET UserName=?, FirstName=?,Lastname=?,Email=?,Sdt=?,Address=?,Pass=?,Role=?,Avt=? WHERE IdUser=$IdUser");
    $stm->bind_param('sssssssss', $user, $first, $last, $email, $sdt, $address, $hash, $role, $linkimage);
    if (!$stm->execute()) {
        return array('code' => 2, 'error' => 'can not execute command');
    }

    return array('code' => 0, 'error' => 'Create account successful');
}
function createSan($tensan, $chinhanh, $gia, $address, $mota, $linkimage)
{
    if (empty($_POST['MaSan'])) {
        $sql = "INSERT INTO san(TenSan,ChiNhanh,GiaThue,DiaChi,MoTa,AnhSan) values(?,?,?,?,?,?)";
        $conn = open_database();
        $stm = $conn->prepare($sql);
    } else {
        $conn = open_database();
        $masan = $_POST['MaSan'];
        $stm = $conn->prepare("UPDATE san SET TenSan=?,ChiNhanh=?,GiaThue=?,DiaChi=?,MoTa=?,AnhSan=? WHERE MaSan=$masan");
    }
    $stm->bind_param('ssisss', $tensan, $chinhanh, $gia, $address, $mota, $linkimage);

    if (!$stm->execute()) {
        return array('code' => 2, 'error' => 'can not execute command');
    }

    return array('code' => 0, 'error' => 'Create account successful');
}
function datsan($IdUser, $name, $sdt, $NgayDat, $MaSan, $TongTien, $thanhtoan, $trangthai)
{
    // Đặt sân 
    if (empty($_GET['IdHoaDon'])) {
        $sql = "INSERT INTO datsan(IdUser,HoTen,Sdt,NgayDat,MaSan,TongTien,ThanhToan,TrangThai) values(?,?,?,?,?,?,?,?)";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('isssisss', $IdUser, $name, $sdt, $NgayDat, $MaSan, $TongTien, $thanhtoan, $trangthai);

        if (!$stm->execute()) {
            return array('code' => 2, 'error' => 'can not execute command');
        }

        return array('code' => 0, 'error' => 'Create account successful');
    }
    // Đổi lịch đặt sân
    else{
        $conn = open_database();
        $idHoaDon = $_GET['IdHoaDon'];
        $stm = $conn->prepare("UPDATE datsan SET IdUser=?,HoTen=?,Sdt=?,NgayDat=?,MaSan=?,TongTien=?,ThanhToan=?,TrangThai=? WHERE idHoaDon=$idHoaDon");
        $stm->bind_param('isssisss', $IdUser, $name, $sdt, $NgayDat, $MaSan, $TongTien, $thanhtoan, $trangthai);

        if (!$stm->execute()) {
            return array('code' => 2, 'error' => 'can not execute command');
        }

        return array('code' => 0, 'error' => 'Create account successful');
    }
    
    //Duyệt sân đã đặt
    if (isset($_POST['idHD'])) {
        $conn = open_database();
        $idHoaDon = $_POST['idHD'];
        $stm = $conn->prepare("UPDATE datsan SET IdUser=?,HoTen=?,Sdt=?,NgayDat=?,MaSan=?,TongTien=?,ThanhToan=?,TrangThai=? WHERE idHoaDon=$idHoaDon");
        $stm->bind_param('isssisss', $IdUser, $name, $sdt, $NgayDat, $MaSan, $TongTien, $thanhtoan, $trangthai);

        if (!$stm->execute()) {
            return array('code' => 2, 'error' => 'can not execute command');
        }

        return array('code' => 0, 'error' => 'Create account successful');
    }

}
