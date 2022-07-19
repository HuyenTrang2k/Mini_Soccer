<?php
    session_start();
    session_destroy();
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
      integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>
  <form action="login.php">
    <div class="container">
      <div class="row">

        <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
            <h4>Đăng xuất thành công</h4>
            <p>Tài khoản của bạn đã được đăng xuất khỏi hệ thống.</p>
            <p>Nhấn <a href="login.php">vào đây</a> để trở về trang đăng nhập, hoặc trang web sẽ tự động chuyển hướng sau <span class="text-danger" id="counter">5</span> giây nữa.</p>
            <button class="btn btn-success px-5" type="submit">Đăng nhập</button>
        </div>

      </div>
    </div>
    </form>
    <script>
      let counter = document.getElementById('counter');
      let count = 0;
      let wait = 5;
      
      let id = setInterval(() =>{
        count ++;
        let remain = wait - count;
        
        if (remain >= 0) {
          counter.innerHTML = remain;
        }
        else {
          clearInterval(id); // Huy dem nguoc
          // thuc hien chuyen trang
          window.location.href = 'login.php';
        }
        
      },1000);
    </script>
  </body>
</html>
