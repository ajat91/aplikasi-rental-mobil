<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Data Mobil</h4>
                </div>
                <?php
                include "koneksi.php";
                $q = mysqli_query($koneksi,"SELECT * FROM tb_mobil");
                //$data=mysqli_fetch_object($q);
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Car Code</label>
                        <input type="text" class="form-control" name="id_mobil" value="<?php echo $data->id_mobil?>">
                    <div class="main-content-inner">
                        <div class="row">
                            <div class="col-12 mt-5">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            cari
                        </button>
                                   <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ID Mobil</h5>
                        </div>
                        <?php  
                            while ($result=mysqli_fetch_object($q)) :
                        ?>
                        <div class="modal-body">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="id_mobil" value="<?php echo $result->id_mobil?>">
                                    </div>
                                </div>
                        </div>
                        <?php endwhile;?>
                </div>
            </div>
        </div>
    </div>
                    </div>
                    </div>
                    </div>
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
                        <img src="img/<?php echo $data->gambar ?>" alt="" width="80"><br>
                        <input type="file" class="form-control"  name="gambar" >
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
 