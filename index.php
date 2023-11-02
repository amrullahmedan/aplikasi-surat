<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Home-Sistem Management Surat</title>

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
        <div class="tile-area no-padding">
            <div class="tile-container" style="width: auto">
            <a href="suratmasuk.php">
                <div class="tile-wide bg-teal fg-white" data-role="tile">
                <div class="tile-content iconic">
                    <span class="icon mif-folder-download"></span>
                    <span class="tile-badge bg-darkTeal">
                        <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail WHERE status='tidak'";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                        ?>
                    </span>
                    <span class="tile-label">Surat Masuk</span>
                </div>
                </div>
                </a>
                <a href="suratkeluar.php">
                <div class="tile-wide bg-red fg-white" data-role="tile">
                    <div class="tile-content iconic">
                    <span class="icon mif-folder-upload"></span>
                    <span class="tile-badge bg-darkRed">
                        <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail_out";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                        ?>
                    </span>
                    <span class="tile-label">Surat Keluar</span>
                </div>
                </div>
                </a>
                <?php
                if ($level == 'admin') {
                    echo "<a href=\"user.php\">";
                }else{
                    echo "<a href=\"#\">";
                }
                ?>
                <div class="tile bg-lighterBlue fg-white" data-role="tile">
                    <div class="tile-content iconic">
                    <span class="icon mif-users"></span>
                    <span class="tile-badge bg-cobalt">
                        <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM user";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                        ?>
                    </span>
                    <span class="tile-label">User</span>
                </div>
                </div>
                </a>
                <a href="about.php">
                <div class="tile bg-lightGreen fg-white" data-role="tile">
                    <div class="tile-content iconic">
                    <span class="icon mif-info"></span>
                    <span class="tile-label">About</span>
                </div>
                </div>
                </a>
                <?php
                if ($level == 'pimpinan') {
                    echo "<a href=\"#\">";
                }else{
                    echo "<a href=\"pengaturan.php\">";
                }
                ?>
                <div class="tile bg-orange fg-white" data-role="tile">
                    <div class="tile-content iconic">
                    <span class="icon mif-cogs"></span>
                    <span class="tile-badge bg-darkOrange">
                        <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail_type";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                        ?>
                    </span>
                    <span class="tile-label">Pengaturan</span>
                </div>
                </div>
                </a>
                <a href="disposisisurat.php">
                <div class="tile-wide bg-indigo fg-white" data-role="tile">
                    <div class="tile-content iconic">
                    <span class="icon mif-paper-plane"></span>
                    <span class="tile-badge bg-darkIndigo">
                         <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM disposition";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                        ?>
                    </span>
                    <span class="tile-label">Disposisi</span>
                </div>
                </div>
                </a>
                <a href="arsipsurat.php">
                <div class="tile-wide bg-amber fg-white" data-role="tile">
                    <div class="tile-content iconic">
                    <span class="icon mif-drafts"></span>
                    <span class="tile-badge bg-orange">
                        <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail WHERE status='arsip' and disposisi='sudah'";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                        ?>
                    </span>
                    <span class="tile-label">Arsip Surat</span>
                </div>
                </div>
                </a>
                <a href="laporan.php">
                <div class="tile bg-violet fg-white" data-role="tile">
                    <div class="tile-content iconic">
                    <span class="icon mif-printer"></span>
                    <span class="tile-label">Laporan</span>
                </div>
                </div>
                </a>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
