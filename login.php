<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cyriptografi E-mail</title>
    <!-- css files -->
    <link href="Asset/Login/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="Asset/Login/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //css files -->

    <!--untuk waktu-->
    <script type="text/javascript">
        function displayTime() {
            var time = new Date();
            var h = time.getHours() + "";
            var m = time.getMinutes() + "";
            var s = time.getSeconds() + "";
            document.getElementById("clock").innerHTML = (h.length == 1 ? "0" + h : h) + ":" + (m.length == 1 ? "0" + m : m) + ":" + (s.length == 1 ? "0" + s : s);
        }
    </script>
    <!--endjs-->

</head>

<body>
    <div class="signupform">
        <div class="container">
            <!-- main content -->
            <div class="agile_info">
                <div class="w3l_form">
                    <div class="left_grid_info">
                        <h1>Cryptografi E-mail</h1>
                        <p>Kirim Email Lebih Aman Menggunakan Kriptografi</p>
                        <img src="Asset/Login/images/bumimulia.jpeg" style="margin-top:50px" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">

                    </div>
                </div>
                <div class="w3_info">
                    <h2>Login dengan akun Email anda</h2>
                    <p></p>

                    <form action="auth.php" method="post">
                        <label>Email Address</label>
                        <div class="input-group">
                            <span class="fa fa-envelope" aria-hidden="true"></span>
                            <input type="email" placeholder="Enter Email" name="email" required autofocus autocomplete="off">
                        </div>
                        <label>Password</label>
                        <div class="input-group">
                            <span class="fa fa-lock" aria-hidden="true"></span>
                            <input type="Password" name="password" placeholder="Enter Password" required="">
                        </div>

                        <button name="login" class="btn btn-danger btn-block" type="submit"><i class="fa fa-envelope"></i> Login</button>
                    </form>
                    <!--<p class="account1">Belum Punya Akun ? <a href="#">Register here</a></p>
                                -->
                </div>
            </div>
            <!-- //main content -->
        </div>

        <!-- footer -->
        <div class="footer">
            <div class="card">
                <div class="card-body">
                    <p class="card-text" style="margin-top:100px;">Cy-Mail 2019 By. Ihsan Miftahul Huda</p>
                </div>
            </div>
        </div> <!-- footer -->
    </div>

</body>

</html>