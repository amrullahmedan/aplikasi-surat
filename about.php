<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>About-Sistem Management Surat</title>

        <link href="css/metro.css" rel="stylesheet">
        <link href="css/metro-icons.css" rel="stylesheet">
        <link href="css/metro-responsive.css" rel="stylesheet">
        <link href="css/metro-schemes.css" rel="stylesheet">

        <link href="css/docs.css" rel="stylesheet">

        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/metro.js"></script>
        <script src="js/docs.js"></script>
        <script src="js/prettify/run_prettify.js"></script>
        <script src="js/ga.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>

    <style>
        html, body {
            height: 100%;
        }
        body {
        	background-color: #FFFFFF;
        }
        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }
        @media screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }

    
    </style>

    <script>



        function pushMessage(t){
            var mes = 'Info|Implement independently';
            $.Notify({
                caption: mes.split("|")[0],
                content: mes.split("|")[1],
                type: t
            });
        }

        $(function(){
            $('.sidebar').on('click', 'li', function(){
                if (!$(this).hasClass('active')) {
                    $('.sidebar li').removeClass('active');
                    $(this).addClass('active');
                }
            });
        });

    </script>
</head>
<?php 
session_start();
if(!isset($_SESSION['username'])) {
header("location:login.php"); }
else{
    $username = $_SESSION['username'];
}
 require_once("koneksi.php");
$sql = "SELECT id, fullname, level, picture FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $fullname = $row["fullname"];
        $level = $row["level"];
        $picture = $row["picture"];
        $user_id =  $row["id"];
    }
}
?>
<body>
    <?php
    require_once("judul.php");
    ?>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content"> 
                    <div class="bg-grayLighter auto-size margin10 padding40 no-padding-top shadow" style="margin-top: 25px;  height: 92%;">
                                    <br />
                                    <br />
                                    <br />
                                    <h1 style="font-size: 4.5rem; line-height: 1" class="text-shadow metro-title text-light">Aplikasi Management Surat</h1>
                                    
                                    <p class="uppercase" style="padding-top: 20px;">
                                     Pengelolaan surat merupakan hal yang penting bagi sebuah organisasi. Melalui surat setiap bagian dari organisasi baik 
                                    yang berada di dalam maupun di luar organisasi melakukan komunikasi. Surat yang terdapat pada organisasi tersebut 
                                    berupa surat masuk dan surat keluar.  Di PELINDO Medan didapatkan pengelolaan surat masuk dan surat keluar masih 
                                    menggunakan metode pencatatan pada buku register. Meningkatnya jumlah surat masuk dan surat keluar dari tahun 
                                    ketahun membuat pengelolaan surat masuk dan surat keluar menjadi meningkat pula, sedangkan selama ini proses 
                                    pengelolaan surat masuk dan surat keluar dilakukan secara manual.
                                    Dengan aplikasi Management surat ini dapat  mempercepat proses pengarsipan  surat, pendistribuasian  surat
                                    dan  mempermudah  proses tindak lanjut  hasil disposisi.Implementasi dari pembangunan aplikasi ini menggunakan
                                    PHP dan menggunakan database MySQLI.</p>

                                    <div class="margin30" style="position: absolute; bottom: 8px; left: 0; width: 100%; text-align: center;">
                                        <center>Copyright &copy; 2022 Panca Budi</center>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
