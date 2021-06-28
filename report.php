<?php

require_once __DIR__ . '/vendor2/autoload.php';
include "koneksi.php";
include ("cetak.php");

$mpdf = new \Mpdf\Mpdf();
$html=
    '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Report Data Mobil</title>
    </head>
    <body>
        <table align="center">
            <tr>
                <td>
                    <h3>Daftar Data Mobil</h3>
                </td>
            </tr>
        </table>
        <table align="center" width="80%" border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>No</th>
                    <th>Kode Mobil</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Type</th>
                    <th>Warna</th>
                    <th>Gambar</th>
                </tr>';
                if(isset($_POST['submit'])){
                    $tgl1=date("Y-m-d", strtotime($_POST['dari']));;
                    $tgl2=date("Y-m-d", strtotime($_POST['sampai']));;
                    $data=mysqli_query($koneksi,"SELECT * FROM tb_mobil WHERE DATE_FORMAT(create_date,'%Y-%m-%d') BETWEEN '$tgl1' AND '$tgl2'");
                }else {
                    $data=mysqli_query($koneksi,"SELECT * FROM tb_mobil ORDER BY create_date DESC");
                }
                    $i=1;
                    while ($row=mysqli_fetch_object($data)){
            $html .='<tr>
                        <td>'.$i++.'</td>
                        <td>'.$row->id_mobil.'</td>
                        <td>'.$row->merk.'</td>
                        <td>'.$row->harga.'</td>
                        <td>'.$row->type.'</td>
                        <td>'.$row->warna.'</td>
                        <td><img src="img/'.$row->gambar.'" width="50"></td>
            </tr>';
        

                }
        
$html .='</table>
    </body>
    </html>';
$mpdf->WriteHTML($html);
$mpdf->Output('reportDataMobil.pdf',\Mpdf\Output\Destination::INLINE);
?>
