<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Edit Data Mobil</h4>
                </div>
                <?php
                include "koneksi.php";
                $q = mysqli_query($koneksi,"SELECT * FROM tb_mobil WHERE id_mobil='{$_GET['id_mobil']}'");
                $data=mysqli_fetch_object($q);
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Car Code</label>
                        <input type="text" class="form-control" name="id_mobil" value="<?php echo $data->id_mobil?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Merk</label>
                        <input type="text" class="form-control" name="merk" value="<?php echo $data->merk?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Type</label>
                        <input type="text" class="form-control" name="type" value="<?php echo $data->type?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Color</label>
                        <input type="text" class="form-control" name="warna" value="<?php echo $data->warna?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Price</label>
                        <input type="text" class="form-control" name="harga"value="<?php echo $data->harga?>">
                    </div>
                    <div class="col-md-12">
                    <label class="labels">Image</label><br>
                        <img src="img/<?php echo $data->gambar ?>" alt="" width="80" id="image-preview"><br>
                        <input type="file" class="form-control"  name="gambar" id="image-source" onchange="previewImage()" >
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
             if ($merk=='' || $warna=='' || $harga=='' || $type==''){
                echo "<script>
                        alert ('Data Harus Diisi');
                    </script>";
            }
            else {
                if($nama_gambar==""){
                    mysqli_query($koneksi,"UPDATE tb_mobil SET merk='$merk',type='$type',warna='$warna',harga='$harga' WHERE id_mobil='$id_mobil' "); 
                    echo  "<script>
                                window.location.href='index.php?pages=mobil';
                            </script>";
                }else {
                    $pindah=move_uploaded_file($sumber,$target.$nama_gambar);
                    if ($pindah){
                    //echo "UPDATE tb_mobil SET merk='$merk',type='$type',warna='$warna',harga='$harga',gambar='$nama_gambar' WHERE id_mobil='$id_mobil' ";
                    mysqli_query($koneksi,"UPDATE tb_mobil SET merk='$merk',type='$type',warna='$warna',harga='$harga',gambar='$nama_gambar' WHERE id_mobil='$id_mobil' ");
                    echo  "<script>
                                alert ('Data Berhasil diubah');
                                window.location.href='?pages=mobil';
                            </script>";
                    }else {
                        echo  "<script>
                                    alert ('Gambar gagal ditambahkan');
                                </script>";
                    }
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