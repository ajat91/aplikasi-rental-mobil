<?php
session_start();
include "koneksi.php";

 // cek apakah yang mengakses halaman ini sudah login
 if ((@$_SESSION['level']=='')){
    header("location:login.php");
    exit;
}
 
$data=mysqli_query($koneksi,"SELECT * FROM tb_login WHERE id_user={$_SESSION['id']}");
$row=mysqli_fetch_object($data);


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sistem Informasi Pendataan Mobil</title>
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
    <!-- batas -->
 
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="assets/css/profile.css">
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
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <?php if (@$_SESSION['level']=='admin'):  ?>
                            <li class="active">
                                <a href="?page=" aria-expanded="true"><i class="ti-palette"></i><span>dashboard</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="index.php?pages=mobil">Lihat Data</a></li>
                                    <li><a href="?pages=mobil&action=tambah">Tambah Data</a></li>
                                    <li><a href="?pages=mobil&action=cetak">Report Filter</a></li>
                                    <li><a href="report.php" target="_blank">Report Rekap</a></li>
                                    <li><a href="?pages=mobil&action=laporan">Laporan</a></li>
                                    <li><a href="?pages=mobil&action=data">Data</a></li>
                                    <li><a href="?pages=mobil&action=filter">Filter</a></li>
                                </ul>
                            </li>
                            <?php elseif (@$_SESSION['level']=='karyawan') : ?>
                            <li class="active">
                                <a href="" aria-expanded="true"><i class="ti-dashboard"></i><span>Data Pelanggan</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="?pages=pelanggan">Lihat Data</a></li>
                                    <li><a href="">Tambah Data</a></li>
                                </ul>
                             </li>
                             <li class="active">
                                <a href="" aria-expanded="true"><i class="ti-palette"></i><span>Paket Kredit</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="?pages=paketkredit">Lihat Data</a></li>
                                    <li><a href="">Tambah Data</a></li>
                                </ul>
                             </li>
                        </ul>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-12 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="photo/<?php echo $row->gambar ?>" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $row->nama ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="?pages=mobil&action=editprofil">Profil</a>
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <?php
                $page=@$_GET['pages'];
                $action=@$_GET['action'];


                if($page=="mobil"){
                    //membatasi hak akses user
                    if($_SESSION['level']=='admin'){
                        if($action == ""){
                            include "pages/mobil.php";
                        }else if($action== "tambah") {
                            include "pages/tambah.php";
                        }else if($action== "edit") {
                            include "pages/edit.php";
                        }else if($action== "hapus") {
                            include "pages/hapusmobil.php";
                        }else if($action== "editprofil") {
                            include "pages/editprofil.php";
                        }else if($action== "cetak") {
                            include "pages/cetak.php";
                        }
                        else if($action== "laporan") {
                            include "pages/laporan.php";
                        } else if($action== "data") {
                            include "pages/data.php";
                        }
                        else if($action== "filter") {
                            include "pages/filter.php";
                        }
                    }elseif($_SESSION['level']=='karyawan'){
                        if($action == "editprofil"){
                            include "pages/editprofil.php";
                        }
                    }else {
                        echo "anda tidak memiliki akses";
                    }
                    
                    
                }else if($page=="pelanggan"){
                    echo "ini halaman pelanggan";
                }else if($page=="paketkredit"){
                    echo "ini halaman paketkredit";
                }else if($page==""){
                    echo "Selamat datang dihalaman utama {$_SESSION['nama']}";
                }else{
                    echo"404 halaman tidak ditemukan";
                }
                ?>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    
 

    <!-- batas -->
  

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="komponen/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
                
</body>
</html>
