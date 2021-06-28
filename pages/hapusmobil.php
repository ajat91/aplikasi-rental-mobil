<?php
     include "koneksi.php";
     mysqli_query($koneksi,"DELETE from tb_mobil WHERE id_mobil='{$_GET['id_mobil']}'");
     echo "<script>
            window.location.href='?pages=mobil';
            </script>"
?>