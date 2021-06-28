<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <!-- data table end -->
                    <!-- Primary table start -->
                    <form method="POST">
                    <input type="date" name="dari">
                    <input type="date" name="sampai">
                    <button type="submit" name="submit">Cari</button>
                    </form>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Data Mobil</h4>
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Image</th>
                                                <th>Car Code</th>
                                                <th>Merk</th>
                                                <th>Type</th>
                                                <th>Color</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            include 'koneksi.php';
                                            if(isset($_POST['submit'])){
                                                $tgl1=date("Y-m-d", strtotime($_POST['dari']));;
                                                $tgl2=date("Y-m-d", strtotime($_POST['sampai']));;
                                                $data=mysqli_query($koneksi,"SELECT * FROM tb_mobil WHERE DATE_FORMAT(create_date,'%Y-%m-%d') BETWEEN '$tgl1' AND '$tgl2'");
                                            }else{
                                                $data=mysqli_query($koneksi,"SELECT * FROM tb_mobil order by create_date DESC");
                                            }
                                            while ($result=mysqli_fetch_object($data)) :
                                                ?>
                                                <tr>
                                                    <td align="center"><img src="img/<?php echo $result->gambar ?>"width="50px"></td>
                                                    <td><?php echo $result->id_mobil ?></td>
                                                    <td><?php echo $result->merk ?></td>
                                                    <td><?php echo $result->type ?></td>
                                                    <td><?php echo $result->warna ?></td>
                                                    <td><?php echo $result->harga ?></td>
                                                    <td>
                                                        <a href="?pages=mobil&action=edit&id_mobil=<?php echo $result->id_mobil?>"><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm ('Yakin akan menghapus ??')" 
                                                            href="?pages=mobil&action=hapus&id_mobil=<?php echo $result->id_mobil?>"><i class="fas fa-trash-alt" class="fas fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Primary table end -->
                    <!-- Dark table start -->
                    
                    <!-- Dark table end -->
                </div>
            </div>
            

  

    
