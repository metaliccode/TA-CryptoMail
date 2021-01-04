<?php
include('config/cek.php');
?>
<!--banner-->
<div class="banner">
    <h2>
        <a href="index.php">Home</a>
        <i class="fa fa-angle-right"></i>
        <span>Kirim Pesan</span>
    </h2>
</div>
<!--//banner-->
<div class="blank">
    <div class="blank-page">
        <div class="grid-form">
            <div class="card-block">
                <form method="post" class="form-horizontal" action="sendmail.php" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-md-2">Tujuan</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="tujuan" required placeholder="contoh: namaemail@domain.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Judul Pesan</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control form-control-line" name="judulpesan" autocomplete="off" required placeholder="contoh: Tugas Akhir Crypto Mail App">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Isi Pesan</label>
                        <div class="col-md-10">
                            <!--<textarea name="isipesan" class="form-control ckeditor" id="ckeditor" required></textarea>-->
                            <textarea name="isipesan" class="form-control" style="resize:vertikal;height:250px;" required></textarea>
                        </div>
                    </div>
                    <div class=" form-group row">
                        <label class="col-md-2">Lampiran</label>
                        <div class="col-md-10">
                            <input type="file" name="file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Kunci</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control form-password" name="kunci" autocomplete="off" required placeholder="contoh: kriptografi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2"></label>
                        <div class="col-md-10">
                            <input type="checkbox" class="form-checkbox"> Tampilkan Kunci
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label class="col-md-2"></label>
                        <div class="col-md-10">
                            <input type="submit" class="btn btn-success" name="kirimemail" value="Kirim Pesan Email">
                            <input type="reset" class="btn btn-danger" value="Reset Form">
                            <a href="index.php" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
    });
</script>