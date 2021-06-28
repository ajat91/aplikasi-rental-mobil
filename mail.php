<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username = 'dwi.watisetyo88@gmail.com';
$mail->Password = 'buahjeruk';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom('dwi.watisetyo88@gmail.com', 'Dwi Setiawati');
$mail->addAddress($_POST['email'], $_POST['nama_lengkap']);
$mail->isHTML(true);
$mail->Subject = "Aktivasi pendaftaran Member";
$mail->Body = "Selamat, anda berhasil membuat akun. Untuk mengaktifkan akun anda silahkan klik link dibawah ini.
 <a href='http://localhost/DeployApps/activation.php?t=".$token."'>http://localhost/DeployApps/activation.php?t=".$token."</a>  ";
$mail->send();
//echo 'Message has been sent';