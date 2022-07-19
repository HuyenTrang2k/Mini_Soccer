<?php
$MaSan = $_GET['MaSan'];
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
                        <li class="nav-item"><a class="nav-link" href="register.php">đăng ký</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">đăng nhập</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
        <div class="container mt-5">
            <div class="row py-4">
                
                <?php
                require_once 'db.php';
                $conn = open_database();
                $sql1 = "SELECT * FROM san WHERE MaSan = $MaSan";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        
                ?>
                        <div class="col-sm-12 col-md-12 col-lg-7">
                            <img  class="d-block w-100" src="<?php echo $row1['AnhSan'] ?>" alt="First slide">
                        </div>

                        <div class="infor col-sm-12 col-md-12 col-lg-5">
                            <div>
                                <h4 class="text-center mb-3"><?php echo $row1['TenSan'] ?></h4>
                                <i class="fas fa-map-marker-alt mr-3"  style='font-size:24px'></i>
                                <span><?php echo $row1['DiaChi'] ?></span>
                            </div>
                            <div>
                                <i class='fas fa-users mr-3 py-3' style='font-size:24px'></i>
                                <span><?php echo $row1['MoTa'] ?></span> <br>
                                <i class='fas fa-calendar-alt mr-3 py-3' style='font-size:24px'></i>
                                <span>Từ 7:00 -> 20:00</span>
                               
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <i class="fas fa-phone-alt mr-3" style='font-size:24px'></i>
                                    <span>Liên hệ:</span>
                                </div>
                                <div class="col-8">
                                    <p>0123 888 999</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <i class="fas fa-dollar-sign mr-3" style='font-size:24px'></i>
                                    <span>Giá thuê sân:</span>
                                </div>
                                <div class="col-8">
                                    <p><?php echo $row1['GiaThue'] ?></p>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="nav-link" href="datsan.php?MaSan=<?php echo $MaSan ?>">Đặt sân</a>
                            </div>
                            
                            
                        </div>
                <?php

                    }
                } else {
                    echo '<div class="text-center text-success"> <h3> Hiện tại không có sân!!!</h3></div>';
                }
                ?>
            </div>

        </div>
        <!--Form đặt sân-->
</body>

</html>