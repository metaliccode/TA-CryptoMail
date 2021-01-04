<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <script src="Asset/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Asset/sweetalert/sweetalert.css">
</head>

<body>
</body>

</html>
<?php
//cek jika di klik
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (isset($_POST['login'])) {
    $usermail = $_POST['email'];
    $password = $_POST['password'];

    //cek mail server yang digunkan port 993 (IMAP)
    if (strpos($usermail, "@yahoo") == true || strpos($usermail, "@ymail") == true) {
        $hostname = '{imap.mail.yahoo.com:993/imap/ssl}';
    } elseif (strpos($usermail, "@gmail") == true || strpos($usermail, "@student.uinsgd") == true) {
        $hostname = '{imap.gmail.com:993/imap/ssl}';
    } elseif (strpos($usermail, "@aol") == true) {
        $hostname = '{imap.aol.com:993/imap/ssl}';
    } else {
        echo "<script>
            setTimeout(function() {
            swal({
                title: 'Akses ditolak',
                text: 'Hanya akun email Google, Yahoo dan AOL Mail yang diperbolehkan',
                type: 'error'
            }, function() {
                window.location = 'login.php';
            });
            });
            </script>";
    }

    //validasi email dan password
    if ($usermail == '') {
        echo "<script>
            setTimeout(function() {
            swal({
                title: 'Akses ditolak',
                text: 'Harap Masukan Email !',
                type: 'error'
            }, function() {
                window.location = 'login.php';
            });
            });
            </script>";
        exit();
    } else if ($password == '') {
        echo "<script>
            setTimeout(function() {
            swal({
                title: 'Akses ditolak',
                text: 'Harap Masukan Password !',
                type: 'error'
            }, function() {
                window.location = 'login.php';
            });
            });
            </script>";
        exit();
    }

    //get data dari mail server dengan imap
    if (imap_open($hostname, $usermail, $password)) {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        //membuat season
        $_SESSION['email'] = $usermail;
        $_SESSION['password'] = $password;

        echo "<script>
            setTimeout(function() {
            swal({
                title: 'Akses diterima',
                text: 'Anda akan diarahkan ke sistem dalam waktu 3 detik..',
                type: 'success',
                timer: 3000,
                showConfirmButton: false
            }, function() {
                window.location = 'index.php';
            });
            });
            </script>";
    } else {

        echo "<script>
                setTimeout(function() {
                swal({
                    title: 'Akses ditolak',
                    text: 'Pastikan User Email dan Password Benar!',
                    type: 'error'
                }, function() {
                    window.location = 'login.php';
                });
                });
            </script>";
    }

    //jika tidak di tekan    
} else {
    echo "<script>
      setTimeout(function() {
      swal({
          title: 'Akses ditolak',
          text: 'Form tidak diset dengan baik.',
          type: 'error'
      }, function() {
          window.location = 'login.php';
      });
      });
      </script>";
}
?>