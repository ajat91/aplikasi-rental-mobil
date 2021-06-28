<?php
session_start();
include "koneksi.php"; 
    if (@$_SESSION['level']!=""){
        header("location:index.php");
        exit;
    }

        if (isset($_POST['submit'])){
            $username=$_POST['username'];
            $password=md5($_POST['password']);
            $result=mysqli_query($koneksi,"SELECT * FROM tb_login WHERE username='$username' and password='$password'");
            if (mysqli_num_rows($result)=== 1){
                $row=mysqli_fetch_assoc($result);

                if($row['level']=="admin"){
                    // buat session login dan username
                    $_SESSION['id']=$row['id_user'];
                    $_SESSION['nama'] =$row['nama'];
                    $_SESSION['username'] = $username;
                    $_SESSION['gambar'] = $row['gambar'];
                    $_SESSION['level'] = "admin";
                    echo "<script>
                            alert('Selamat Datang ".$_SESSION['nama']."');
                            window.location.href = 'index.php';
                          </script>";
                    //header("location:index.php");
                }else if($row['level']=="karyawan"){ // cek jika user login sebagai pegawai
                    // buat session login dan username
                    $_SESSION['nama'] =$row['nama'];
                    $_SESSION['id']=$row['id_user'];
                    $_SESSION['username'] = $username;
                    $_SESSION['gambar'] = $row['gambar'];
                    $_SESSION['level'] = "karyawan";

                    echo "<script>
                            alert('Selamat Datang ".$_SESSION['nama']."');
                            window.location.href = 'index.php';
                          </script>";
                }else{
                    // alihkan ke halaman login kembali
                         echo "<script>
                                alert('Level Karyawan Tidak Ditemukan');
                              </script>";
                    
                    //header("location:login.php");
                    
                }            
            }else{
                // alihkan ke halaman login kembali
                echo "<script>
                    alert('Username atau Password Tidak Ditemukan');
                    window.location.href = 'login.php';
                    </script>";
                //$error=true;
                 
                }
            
        }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="502134613689-mllab5mfeh7vbt3q6monsltkapomcu6e.apps.googleusercontent.com" >
</head>
<body>
<div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--60">
            
                <form action="" method="POST">
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start your journey</p>
                    </div>
                        <?php if(isset($error)): ?>
                            <p align="center"style="color:red;font-style:italic;">Username/Password salah</p>
                        <?php endif; ?>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" id="exampleInputEmail1" name="username">
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="submit">Submit <i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">
                                <div class="col-md-12" align="center">
                                    <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                </div>
                            </div>
                            <div class="form-footer text-center mt-5">
                                <p class="text-muted">Don't have an account? <a href="register.php">Sign Up</a></p>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>