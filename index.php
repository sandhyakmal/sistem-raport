<?php
session_start();
require 'koneksi.php';


if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require 'helper.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> Sistem Raport </title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">


  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">


  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          
          </ul>
          
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $_SESSION['username']; ?> </div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="?page=dashboard">Sistem Raport</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="?page=dashboard">SR</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Master</li>

            <li><a class='nav-link' href='?page=dashboard'><i class='fa fa-square'></i> <span>Welcome</span></a></li>

            <?php 

            
             if (isset($allowed['data_siswa']['view']) && $allowed['data_siswa']['view']) {
              echo "<li><a class='nav-link' href='?page=data_siswa'><i class='fa fa-user'></i> <span>Data Siswa</span></a></li>";
            }

            if (isset($allowed['data_guru']['view']) && $allowed['data_guru']['view']) {
              echo "<li><a class='nav-link' href='?page=data_guru'><i class='fa fa-users'></i> <span>Data Guru</span></a></li>";
            }

            if (isset($allowed['data_pelajaran']['view']) && $allowed['data_pelajaran']['view']) {
              echo "<li><a class='nav-link' href='?page=data_pelajaran'><i class='fa fa-book-open'></i> <span>Data Pelajaran</span></a></li>";
            } 

            if (isset($allowed['jadwal_pelajaran']['view']) && $allowed['jadwal_pelajaran']['view']) {
              echo "<li><a class='nav-link' href='?page=jadwal_pelajaran'><i class='fa fa-calendar'></i> <span>Jadwal Pelajaran</span></a></li>";
            } 
            
            if (isset($allowed['input_nilai']['view']) && $allowed['input_nilai']['view']) {
              echo "<li><a class='nav-link' href='?page=nilai'><i class='fa fa-address-card'></i> <span>Input Nilai</span></a></li>";
            }
            if(isset($allowed['laporan']['view']) && $allowed['laporan']['view']) {
              echo " <li><a class='nav-link' href='?page=laporan'><i class='fa fa-book'></i> <span>Laporan Nilai Siswa</span></a></li>";
            }

            if(isset($allowed['cetak_raport']['view']) && $allowed['laporan']['view']) {
              echo " <li><a class='nav-link' href='?page=raport'><i class='fa fa-book'></i> <span>Cetak Raport</span></a></li>";
            }

            // if($_SESSION['role_id'] == '3') {
            //   echo "<li><a class='nav-link' href='?page=menu_permission'><i class='fa fa-unlock'></i> <span>Menu Permission</span></a></li>";
            // }

            ?>  
        
          </ul>
    
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
     
          <?php

          // if (hasPermission('create_siswa')) {
          //   echo "<a href='create_post.php'>Create Post</a><br>";
          // }
          // echo $username;

          $page = $_GET['page'] ?? '';

          // echo $page;
          // echo $_SESSION['user_id'];
        
          if ($page == 'dashboard') {
            include "dashboard.php"; 
          } 
          
          // MENU PERMISSION
          elseif ($page == 'menu_permission') {
            include "pages/menu-permission/menu_permission.php";
          } elseif ($page == 'tambah_menu_permission') {
            include "pages/menu-permission/tambah_menu_permission.php";
          } elseif ($page == 'edit_menu_permission') {
            include "pages/menu-permission/edit_menu_permission.php";
          }

          // DATA SISWA
          elseif ($page == 'data_siswa') {
            include "pages/data-siswa/siswa.php";
          } elseif ($page == 'tambah_data_siswa') {
            include "pages/data-siswa/tambah_data_siswa.php";
          } elseif ($page == 'detail_siswa')  {
            include "pages/data-siswa/detail_data_siswa.php";
          } elseif ($page == 'hapus_data_siswa')  {
            include "pages/data-siswa/hapus_data_siswa.php";
          } elseif ($page == 'edit_data_siswa')  {
            include "pages/data-siswa/edit_data_siswa.php";
          } 
          
          // DATA GURU
          elseif ($page == 'data_guru') {
            include "pages/data-guru/guru.php";
          } elseif ($page == 'tambah_data_guru') {
            include "pages/data-guru/tambah_data_guru.php";
          } elseif ($page == 'detail_guru')  {
            include "pages/data-guru/detail_data_guru.php";
          } elseif ($page == 'hapus_data_guru')  {
            include "pages/data-guru/hapus_data_guru.php";
          } elseif ($page == 'edit_data_guru')  {
            include "pages/data-guru/edit_data_guru.php";
          }

          // DATA PELAJARAN
          elseif ($page == 'data_pelajaran') {
            include "pages/data-pelajaran/pelajaran.php";
          } elseif ($page == 'tambah_data_pelajaran') {
            include "pages/data-pelajaran/tambah_data_pelajaran.php";
          } elseif ($page == 'hapus_data_pelajaran')  {
            include "pages/data-pelajaran/hapus_data_pelajaran.php";
          } elseif ($page == 'edit_data_pelajaran')  {
            include "pages/data-pelajaran/edit_data_pelajaran.php";
          }

          // DATA JADWAL PELAJARAN
          elseif ($page == 'jadwal_pelajaran') {
            include "pages/data-jadwal-pelajaran/jadwal_pelajaran.php";
          } elseif ($page == 'tambah_jadwal_pelajaran') {
            include "pages/data-jadwal-pelajaran/tambah_jadwal_pelajaran.php";
          } elseif ($page == 'hapus_jadwal_pelajaran')  {
            include "pages/data-jadwal-pelajaran/hapus_jadwal_pelajaran.php";
          } elseif ($page == 'edit_jadwal_pelajaran')  {
            include "pages/data-jadwal-pelajaran/edit_jadwal_pelajaran.php";
          }

           // INPUT NILAI
          elseif ($page == 'nilai') {
            include "pages/nilai/nilai.php";
          } elseif ($page == 'input_nilai') {
            include "pages/nilai/input_nilai.php";
          } elseif ($page == 'hapus_nilai')  {
            include "pages/nilai/hapus_nilai.php";
          } elseif ($page == 'edit_nilai')  {
            include "pages/nilai/edit_nilai.php";
          } elseif ($page == 'input_keterangan')  {
            include "pages/nilai/input_keterangan.php";
          } 
          
          // LAPORAN
          elseif ($page == 'laporan') {
            include "pages/laporan/laporan.php";
          } elseif ($page == 'raport' ) {
            include "pages/laporan/raport.php";
          }


          ?>

        </section>
      </div>
      
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/datatables/datatables.min.js"></script>
  <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
  <script src="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="assets/modules/sweetalert/sweetalert.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/modules-datatables.js"></script>
  <script src="assets/js/page/features-post-create.js"></script>
  <script src="assets/js/page/modules-sweetalert.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  
</body>
</html>