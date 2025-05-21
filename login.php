<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIM Penjualan</title>

  <!-- Favicon -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">

  <style>
    body {
      background: linear-gradient(45deg, #afeeee, #e0ffff);
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
        <div class="card shadow rounded p-4">
          <div class="card-body">
            <h2 class="card-header mb-3"><b>Login</b></h2>
            <p class="text-muted card-text mb-3">Masukkan Username & Password Anda</p>
            <form class="needs-validation" novalidate>
              <div class="input-group mb-3">
                <span class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </span>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus autocomplete="off" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
              </div>
              <div class="col-sm-12 text-center">
                <button type="button" id="submit" class="btn btn-outline-dark">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#submit').click(function() {
        var form = $('.needs-validation')[0];
        if (form.checkValidity() === false) {
          form.reportValidity();
        } else {
          $.ajax({
            type: "POST",
            url: "system/cek_login.php",
            dataType: "json",
            data: {
              username: $('#username').val(),
              password: $('#password').val()
            },
            success: function(data) {
              if (data.status === "sukses") {
                window.location = "index.php";
              } else {
                alert(data.message);
                location.reload();
              }
            }
          });
        }
        $(form).addClass("was-validated");
      });

      $('.needs-validation').keydown(function(e) {
        if (e.key === "Enter") {
          e.preventDefault();
          $('#submit').click();
        }
      });
    });
  </script>
</body>

</html>