<?php
session_start();
include "koneksi.php"; 

// if (isset($_SESSION['admin'])|| ($_SESSION['karyawan']) ){
//     header("location:login.php");
//     exit;
// }
// if (@$_SESSION['admin'] || @$_SESSION['karyawan']){
//     header("location:index.php");
//     exit;
// }

    if (@$_SESSION['level']!=""){
        header("location:index.php");
        exit;
    }
    // if (isset($_POST['submit'])){
    //     $username=$_POST['username'];
    //     $alamat=$_POST['alamat'];
    //     $nama=$_POST['nama_lengkap'];
    //     $email=$_POST['email'];
    //     $pass=md5($_POST['password']);
    //     if ($username=="" || $pass=="" || $alamat=="" || $nama==""|| $jk==""){
    //                 echo "<script>
    //                         alert('Data Harus Diisi');
    //                       </script>";
    //     }else{
    //         $result=mysqli_query($koneksi,"INSERT INTO tb_login VALUES ('','$username','$nama','karyawan','$pass','$alamat','$jk')");
    //         if($result){
    //             echo "<script>
    //             alert('Registrasi Berhasil, Silahkan Login');
    //             window.location='login.php';
    //           </script>";
    //         }
    //     }
    // } 
     
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign up - srtdash</title>
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="297785405139-amtbk5cgtimsea59rhga1505famc48km.apps.googleusercontent.com" >
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="" method="POST">
                    <div class="login-form-head">
                        <h4>Sign up</h4>
                        <p>Hello there, Sign up and Join with Us</p>
                    </div>
                    <div class="login-form-body">
                        <div>
                            <?php
                                if (isset($_POST['submit'])) {
                                    //ambil data dari form   
                                    $username=$_POST['username'];
                                    $password=md5($_POST['password']);
                                    $nama=$_POST['nama_lengkap'];
                                    $email=$_POST['email'];
                                    $alamat=$_POST['alamat'];
                                    //buat token
                                    $token=hash('sha256', md5(date('Y-m-d'))) ;
                                    //cek user terdaftar
                                    $sql_cek=mysqli_query($koneksi,"SELECT * FROM tb_login WHERE email='".$email."'");
                                    $r_cek=mysqli_num_rows($sql_cek);
                                    if ($r_cek>0) {
                                      echo '<div class="alert alert-warning">
                                              Email anda sudah pernah terdaftar!
                                            </div>';
                                    }else{
                                      //jika data kosong maka insert ke tabel;
                                      //aktif =0 user belum aktif
                                      $insert=mysqli_query($koneksi,"INSERT INTO tb_login VALUES('','$username','$nama','karyawan','$password','$alamat','$email','$token','0','')");
                                      //include kirim email
                                      include("mail.php");
                                      if ($insert) {
                                        echo '<div class="alert alert-success">
                                            Pendaftaran anda berhasil, silahkan cek email anda untuk aktivasi. 
                                        </div>';
                                        } 
                                  
                                    }                  
                                }  
                            ?>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputName1">Username</label>
                            <input type="text" id="exampleInputName1" name="username">
                            <i class="fas fa-user-tie"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" id="exampleInputEmail1" name="nama_lengkap">
                            <i class="fas fa-signature"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" id="exampleInputPassword1" name="email">
                            <i class="fas fa-at"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" name="password">
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label>Alamat</label>
                            <input type="text" name="alamat">
                            <i class="fas fa-igloo"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="submit">Submit <i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">
                                <div class="col-md-12" align="center">
                                    <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                </div>
                            </div>
                            <div class="form-footer text-center mt-5">
                                <p class="text-muted">Have an account? <a href="login.php">Sign In</a></p>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
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