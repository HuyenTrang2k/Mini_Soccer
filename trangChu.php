<!DOCTYPE html>
<html lang="en">
<?php
$idhd="";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./asset/trangChu.css">
    <style>
    .row {
        margin-top: 50px;
    }
    </style>
</head>
<style>
img.avt {
    display: block;
    max-width: 600px;
    max-height: 300px;
    height: auto;
}

img {
    max-width: 1500px;
    max-height: 300px;
}
</style>

<body>
    <!-- Header - Nav bar -->
    <div class="navbar-fixed">
        <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a href="#" class="navbar-brand py-1 ml-2">
                        <img src="img/logo.jpg" alt="Logo" style="width: 60px; height: 35px;" />
                    </a>
                    <h4>King Sport</h4>
                </div>
                <button type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                <div id="navbarCollapse" class="collapse navbar-collapse mr-3">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="register.php">Đăng ký</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Đăng nhập</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
        Hình ảnh sân bóng
    </div>
    <!-- Carousel -->
    <!-- <div id="carouselExampleIndicators" class="carousel slide container mt-5" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block " src="img/san1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="img/san2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="img/san3.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="img/san4.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div> -->
    <div class="container">
        <div class="carousel-part mt-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner ">
                    <div class="carousel-item active">
                        <img class="d-block w-100 carousel-height" src="img/sanbong1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 carousel-height" src="img/sanbong2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 carousel-height" src="img/sanbong3.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- Giới thiệu -->

        <div class="text-center">
            <h3>Tại sao lại cần King Sport</h3>
            <p>NỀN TẢNG ĐẶT SÂN - CHẤT LƯỢNG SÂN BÓNG HÀNG ĐẦU VIỆT NAM</p>
        </div>
        <div class="row d-flex justify-content-around w3-row-padding">
            <div class="text-center col-sm-12 col-md-6 col-lg-4">
                <i class='fas fa-map-marked-alt ' style='font-size:48px;color:rgb(10, 126, 194)'></i>
                <h5>Tìm kiếm và đặt sân bóng online</h5>
                <p>Thông tin sân gần vị trí của bạn nhất, đặt sân online, dễ dàng và nhanh chóng.</p>
            </div>
            <div class="text-center col-sm-12 col-md-6 col-lg-4">
                <i class='far fa-calendar-alt' style='font-size:48px;color:rgb(10, 126, 194)'></i>
                <h5>Công cụ quản lý sân bóng online</h5>
                <p>Quản lý lịch đặt sân đơn giản, tiếp nhận đặt sân online dễ dàng, lấp đầy sân trống</p>
            </div>
            <div class="text-center col-sm-12 col-md-6 col-lg-4">
                <i class='fas fa-futbol' style='font-size:48px;color:rgb(10, 126, 194)'></i>
                <h5>Chất lượng sân bóng</h5>
                <p>Đa dạng về loại sân, chất lượng được ưu tiên hàng đầu.</p>
            </div>
        </div>
        <!-- Chi nhánh -->
        <div class="row mt-5">
            <div class="col-9">
                <h4>ĐỊA ĐIỂM HÀNG ĐẦU</h4>
                <h5>Hơn 12 sân bóng trên Tp HCM</h5>
            </div>

        </div>
        <!-- Hình ảnh chi nhánh -->
        <div class="row">
            <?php
      require_once 'db.php';
      $conn = open_database();
      $sql1 = "SELECT * FROM san";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
      ?>
            <input type="hidden" name="id" value="<?php echo $row1['MaSan'] ?>">
            <!--Ẩn id sản sân -->
            <div class="card col-sm-12 col-md-6 col-lg-4 mb-3" >
                <a href="detailsan.php?IdHoaDon=<?php echo $idhd ?>&MaSan=<?php echo $row1['MaSan'] ?>">
                    <img class="card-img-top avt" src="<?php echo $row1['AnhSan'] ?>" alt="Card image cap" style="width: 100%; height: 24rem;">

                </a>
                <div class="card-body">
                    <h4 class="card-text"><?php echo $row1['TenSan'] ?></h4>
                    <p class="card-text"><?php echo $row1['DiaChi'] ?></p>
                </div>
                
            </div>

            <?php

        }
      } else {
        echo '<div class="text-center text-success"> <h3> Hiện tại không có sân!!!</h3></div>';
      }
      ?>

        </div>
        <!--Liên hệ-->
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-4">
                <h4>VỀ KING SPORT</h4>
                <p>Giới thiệu King Sport</p>
                <p>Điều khoản sử dụng</p>
                <p>Chính sách bảo mật</p>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4">
                <h4>THÔNG TIN LIÊN HỆ</h4>
                <i class='fab fa-facebook-square mt-2 mr-2' style='font-size:24px'></i>
                <a style="color: black;" href="#">Kingsport</a><br>
                <i class='fas fa-phone-alt mt-3 mr-2' style='font-size:24px'></i>
                <span>01234 888 999</span> <br>
                <i class="fa fa-envelope icon mt-3 mr-2"></i>
                <span>kingsport@gmail.com</span>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4">
                <h4>THANH TOÁN</h4>
                <img style="height: 25px; margin-bottom: 10px"
                    src="https://www.sporta.vn/assets/momo-f2c88c55af645265139d91c8ec6e31182b68283d335ef35dff10bc90da8ddb3b.png" />
                Momo</a></li> <br>
                <i class='far fa-money-bill-alt mt-2' style='font-size:24px'></i>
                <span>Tiền mặt</span> <br>
                <i class='fas fa-money-check-alt mt-3' style='font-size:24px'></i>
                <span>Chuyển khoản ngân hàng</span>
            </div>
        </div>
    </div>
    <!--Footer-->
    <div class="font-weight-light bg-secondary text-white">
        <div class="row align-items-center justify-content-center">
            <div class="py-3 col-md-6 text-center text-md-center">
                <p class="text-sm mb-md-0"><span>© 2019 Bản quyền của Công Ty TNHH Sporta</span><br>
                    <span>Giấy chứng nhận Đăng ký Kinh doanh số 0315485936 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí
                        Minh cấp ngày 17/01/2019</span>
                </p>
            </div>
        </div>
    </div>
</body>

</html>