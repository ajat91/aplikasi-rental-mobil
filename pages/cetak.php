<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            cetak Laporan
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
                        </div>
                        <div class="modal-body">
                            <form action="report.php" target="_blank" method="POST">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Dari Tanggal</label>
                                        <input type="date" class="form-control" name="dari">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Sampai Tanggal</label>
                                        <input type="date" class="form-control" name="sampai">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Cetak</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>