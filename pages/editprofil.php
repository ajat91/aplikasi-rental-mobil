<?php
        include "koneksi.php";
        $q = mysqli_query($koneksi,"SELECT * FROM tb_login WHERE username='{$_SESSION['username']}'");
        $result=mysqli_fetch_object($q);
?>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" alt="avatar" width="150px"  src="photo/<?php echo $result->gambar ?>">
            <span class="font-weight-bold"><?php echo $result->nama ?></span><span class="text-black-50"><?php echo $result->level ?></span><span> </span></div>
            <input type="file" class="form-control" name="gambar">
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Id</label><input type="text" class="form-control" name="id_user" value="<?php echo $result->id_user?>" readonly></div>
                    <div class="col-md-12"><label class="labels">Username</label><input type="text" class="form-control" name="username" value="<?php echo $result->username?>" readonly></div>
                    <div class="col-md-12"><label class="labels">Nama</label><input type="text" class="form-control" name="nama" value="<?php echo $result->nama?>"></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="email" class="form-control" name="email" value="<?php echo $result->email?>"></div>
                    <div class="col-md-12"><label class="labels">Alamat</label><input type="text" class="form-control" name="alamat" value="<?php echo $result->alamat?>"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" name="submit" type="submit">Save Profile</button></div>
            </div>
        </div>
        </form>
        <div class="col-md-4">
        </div>
    </div>
</div>
</div>
</div>
<?php
          if(isset($_POST ['submit'])){
            $id=$_POST['id_user'];
            $username=$_POST['username'];
            $nama=$_POST['nama'];
            $email=$_POST['email'];
            $alamat=$_POST['alamat'];
            
            // echo "UPDATE tb_login SET username='$username',nama='$nama',password='$pass',alamat='$alamat' WHERE id_user='$id'";exit;
            
            $sumber=$_FILES['gambar']['tmp_name'];
            $target='photo/';
            $nama_gambar=$_FILES['gambar']['name'];
            if ($id=='' || $username=='' || $nama=='' || $email=='' || $alamat=='' ){
                echo "<script>
                        alert ('Data Harus Diisi');
                        window.location.href='?pages=mobil&action=editprofil';
                    </script>";
            }
            else {
                $data=mysqli_query($koneksi,"SELECT * FROM tb_login where id_user='$id'");
                $row=mysqli_fetch_object($data);
                if($nama_gambar==''){
                    $pindah=true;
                    $gambar=$row->gambar;
                }else{
                    $pindah=move_uploaded_file($sumber,$target.$nama_gambar);
                    $gambar=$nama_gambar;
                }
                
                if ($pindah){
                    mysqli_query($koneksi,"UPDATE tb_login SET username='$username',nama='$nama',email='$email',alamat='$alamat',gambar='$gambar' WHERE id_user='$id'");
                echo  "<script>
                            alert ('Profile Berhasil Diupdate');
                            window.location.href='?pages=mobil&action=editprofil';
                        </script>";
                }else {
                    echo  "<script>
                                alert ('Gambar Gagal Ditambahkan');
                            </script>";
                }
            
            }
        }  
    ?>

