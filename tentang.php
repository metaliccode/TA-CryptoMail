<?php
include('config/cek.php');
?>
<!--banner-->
<div class="banner">
    <h2>
        <a href="index.php">Home</a>
        <i class="fa fa-angle-right"></i>
        <span>Tentang</span>
    </h2>
</div>
<!--//banner-->
<div class="blank">
    <div class="blank-page">
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <div class="card-block">
                        <div class="grid-form">
                            <div class="card-block">
                                <h2>Tentang Aplikasi</h2>
                                <hr>
                                <p style="text-align:justify">Halo <code><?php echo $_SESSION['email']; ?></code>!<br><br>
                                    <b><code>Cryptografi Mail App</code></b> merupakan Aplikasi pengiriman email yang sederhana barbasis Website.
                                    Dan dilengkapi dengan fitur keamanan berbasis Kriptografi, untuk mencegah terjadinya serangan dari para pihak yang
                                    tidak memiliki hak atas informasi pesan yang dikirim.
                                    <br><br>
                                    Aplikasi <code>Cryptografi Mail</code> ini dibuat menggunakan bahasa pemrograman PHP
                                    dan meggunakan kombinasi Algoritma <i>Advanced Encryption Standard</i> (AES) dan Algoritma <i>Huffman</i> untuk menjaga kerahasiaan pesan.
                                    <br><br>
                                    Terima kasih.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>