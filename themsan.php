<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['role'] == "Admin") {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sân</title>
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

</head>

<body>
    <div class="text-center mt-4">
        <h3>Thêm sân bóng</h3>
    </div>
    <div class="container w-50 mt-5 boder border-danger">
        <?php
        $tensan = "";
        $masan = "";
        $chinhanh = "";
        $gia = "";
        $address = "";
        $mota = "";
        $avt= "";
        $file = "";
        $error = "";

        if (isset($_POST['tensan']) && isset($_POST['chinhanh']) && isset($_POST['gia']) 
        && isset($_POST['address']) && isset($_POST['mota']) && isset($_FILES['image'])
        ) {
            $tensan = $_POST['tensan'];
            $chinhanh = $_POST['chinhanh'];
            $gia = $_POST['gia'];
            $address = $_POST['address'];
            $mota = $_POST['mota'];
            $file = $_FILES['image'];
            $avt = $file['name'];
            $linkimage = "img/" . $file['name'];

            if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
                move_uploaded_file($file['tmp_name'], 'img/' . $avt);
            }
            if (empty($tensan)) {
                $error = 'Vui lòng nhập tên sân';
              } else if (empty($chinhanh)) {
                $error = 'Vui lòng chọn chi nhánh';
              } else if (empty($gia)) {
                $error = 'Vui lòng nhập giá thuê';
              } else if (empty($address)) {
                $error = 'Vui lòng nhập địa chỉ';
              }else if (empty($mota)) {
                $error = 'Vui lòng nhập mô tả';
              } else if (empty($avt)) {
                $error = 'Vui lòng chọn ảnh sân';
              } else if ($file['type'] != 'image/jpeg' && $file['type'] != 'image/jpg' && $file['type'] != 'image/png') {
                $error = 'Vui lòng chọn file ảnh';
              } else {
                // register a new san bong
              $result = createSan($tensan,$chinhanh,$gia,$address,$mota,$linkimage);
                if ($result1['code'] == 0) {
                  // successful
                  header('Location: QuanLySan.php');
                  exit();
                } else if ($result1['code'] == 2) {
                  $error = "Không thể thêm lớp học";
                } else {
                  $error = "Đã xảy ra lỗi vui lòng thử lại";
                }
              }

        }
        // Hien thi thong tin san khi bam nut sua
        if(isset($_GET['MaSan'])){
          $conn = open_database();
          $masan=$_GET['MaSan'];
          $sql = "SELECT * FROM san WHERE MaSan=$masan";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $tensan = $row["TenSan"];
          $chinhanh = $row["ChiNhanh"];
          $gia = $row["GiaThue"];
          $address = $row["DiaChi"];
          $mota = $row["MoTa"];
          $avt = $row["AnhSan"];
          
        }
    ?>

        <form method="post" action="" novalidate enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="MaSan" value="<?php echo $masan ?>">
                <label for="tensan">Tên sân</label>
                <input value="<?= $tensan ?>" type="text" class="form-control" id="tensan" name="tensan" placeholder="Tên sân">

                <label for="chinhanh">Chi nhánh</label>
                <input value="<?= $chinhanh ?>" type="text" class="form-control" id="chinhanh" name="chinhanh" placeholder="Chi nhánh">

                <label for="gia">Giá thuê</label>
                <input value="<?= $gia ?>" type="text" class="form-control" id="gia" name="gia" placeholder="Giá thuê">

                <label for="address">Địa chỉ</label>
                <input value="<?= $address ?>" type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ">

                <label for="mota">Mô tả</label>
                <input value="<?= $mota ?>" type="text" class="form-control" id="mota" name="mota" placeholder="Mô tả">

            </div>

            <div class="form-group">
                <label for="image">Ảnh sân:</label>
                <input type="file" class="form-control" placeholder="Chọn ảnh" id='image' name='image'>
            </div>

            <div class="form-group text-center">
                <?php
                if (!empty($error)) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                ?>
                <button type="submit" class="btn btn-primary">Thêm sân</button>
            </div>
        </form>
    </div>
</body>

</html>