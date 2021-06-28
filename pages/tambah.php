<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Tambah Data Mobil</h4>
                </div>
                <?php
                    $q = mysqli_query($koneksi,"SELECT UNIX_TIMESTAMP(NOW()) as nomor");
                    $jumlah=mysqli_fetch_object($q);
                    $urutan=$jumlah->nomor;
                    $no_transaksi="TRX".$urutan;  
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Car Code</label>
                        <input type="text" class="form-control" name="id_mobil" value="<?php echo $no_transaksi?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Merk</label>
                        <input type="text" class="form-control" name="merk" value="">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Type</label>
                        <input type="text" class="form-control" name="type" value="">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Color</label>
                        <input type="text" class="form-control" name="warna" value="">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Price</label>
                        <input type="text" class="form-control" name="harga"value="">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Image</label>
                        <br>
                        <img id="image-preview" width="100">
                        <br>
                        <input type="file" class="form-control" name="gambar" value="" id="image-source" onchange="previewImage()">
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" name="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
</div>
</div>
<?php
    include "koneksi.php";
    //kalau menggunakan button cukup $_POST saja tidak perlu isset
    // if(isset($_POST['submit'])){
    //     $id_mobil=$_POST['id_mobil'];
    //     $merk=$_POST['merk'];
    //     $warna=$_POST['warna'];
    //     $harga=$_POST['harga'];
    //     $reset=$_POST['reset'];
    // }  
    
        if(isset($_POST ['submit'])){
            $id_mobil=$_POST['id_mobil'];
            $merk=$_POST['merk'];
            $warna=$_POST['warna'];
            $type=$_POST['type'];
            $harga=$_POST['harga'];

            //upload gambar

            $sumber=$_FILES['gambar']['tmp_name'];
            $target='img/';
            $nama_gambar=$_FILES['gambar']['name'];
         
            
            if ($id_mobil=='' || $merk=='' || $warna=='' || $harga=='' || $type=='' || $nama_gambar==''){
                echo "<script>
                        alert ('Data Harus Diisi');
                    </script>";
            }
            else {
                $pindah=move_uploaded_file($sumber,$target.$nama_gambar);
                
                if ($pindah){
                    mysqli_query($koneksi,"INSERT INTO tb_mobil (id_mobil, warna, merk, harga, `type`, gambar)
                    VALUES ('$id_mobil','$warna','$merk','$harga','$type','$nama_gambar')");
                    echo  "<script>
                                alert ('Data Berhasil Ditambahkan. ');
                                window.location.href='?pages=mobil';
                            </script>";
                }else {
                    echo  "<script>
                                alert ('Gambar Gagal Ditambahkan');
                            </script>";
                }
            
            }
        }
    ?>
    <script>
        function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

        oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };
    </script>