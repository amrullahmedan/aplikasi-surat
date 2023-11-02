<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Disposisi-Sistem Management Surat</title>

        <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">

    <link href="css/docs.css" rel="stylesheet">

    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/docs.js"></script>
    <script src="js/prettify/run_prettify.js"></script>
    <script src="js/ga.js"></script>

    <style>
        html, body {
            height: 100%;
        }
        body {
        	background-color: #F0F0F0;
            overflow: hidden;
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

        #btnhapus{
            width: 100px;
        }
        #tableuser{
            font-size: 16px;
            background-color: white;
            padding-bottom: 50px;
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

        function showDialog(id){
            var dialog = $("#"+id).data('dialog');
            if (!dialog.element.data('opened')) {
                dialog.open();
            } else {
                dialog.close();
            }
        }
        $(function(){
            $('#example_table').dataTable();
        });

    </script>
</head>
<body>
<?php 
 require_once("koneksi.php");
//BUAT INPUT LOGIN

//BUAT VALIDATION SESSION
session_start();
if(!isset($_SESSION['username'])) {
header("location:login.php"); }
else{
    $username = $_SESSION['username'];
}
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

    <?php
    require_once("judul.php");
    ?>

    <div class="page-content">
        <div class="flex-grid no-responsive-future container" style="height: 100%;">
            <div class="row" style="height: 100%">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1" style="overflow: scroll;">
                    <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-paper-plane"></span></span>
                                <span class="window-caption-title">Disposisi</span>
                            </div>
                            <div class="window-content bg-grayLighter padding20" style="height: auto;">
                            <a href="laporan/lapdispos.php" target="_blank"><button class="button success text-shadow" onclick="return confirm('Cetak Laporan?')" ><span class="mif-print"></span> Laporan</button></a>
                                    <table class="table dataTable striped hovered cell-hovered border bordered" data-role="datatable" data-searching="true" id="tableuser" >
                                        <thead class="bg-blue">
                                        <tr>
                                            <td class="fg-white bg-blue">ID</td>
                                            <td class="fg-white bg-cyan" style="width: 20px;">ID Surat</td>
                                            <td class="fg-white bg-cyan">Tgl Disposisi</td>
                                            <td class="fg-white bg-cyan">Disposisi Oleh</td>
                                            <td class="fg-white bg-cyan">Tanggapan</td>
                                            <td class="fg-white bg-cyan">Keterangan</td>
                                            <td style="width:330px;" class="fg-white bg-cyan">Action</td>
                                        </tr>
                                        </thead>
                                        <?php
                                            $sql = "SELECT * FROM disposition";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {
                                                 // output data of each row
                                                 while($row = $result->fetch_assoc()) {
                                                    $id_disposs = $row["id"];
                                        ?>
                                        <tr>
                                            <td style="width: 15px;"><?php echo $row["id"]; ?></td>
                                            <td><?php echo $row["mailid"] ?></td>
                                            <td><?php echo $row["disposition_at"]; ?></td>
                                            <td><?php echo $row["reply_at"]; ?></td>
                                            <td><?php echo $row["notification"]; ?></td>
                                            <td><?php echo $row["description"]; ?></td>
                                            <td style="width: 50px">
                                            <?php
                                            if ($level == 'pimpinan') {
                                                echo "<a href=\"editdisposisi.php?id=$id_disposs\"><button class=\"image-button small-button bg-lightGreen fg-white text-shadow\">
                                                Edit
                                                <span class=\"icon mif-pencil bg-green\"></span>
                                                </button>";
                                            }else{
                                                
                                            }
                                            ?>
                                                <a href="deletedisposisi.php?id=<?php echo $row["mailid"]; ?>"><button class="image-button small-button bg-red fg-white text-shadow" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus disposisi?')">
                                                Hapus
                                                <span class="icon mif-bin bg-darkRed"></span>
                                                </button></a>
                                                <a href="laporan/disposisi.php?id=<?php echo $row["mailid"]; ?>" target="_blank"><button class="image-button small-button bg-orange fg-white text-shadow" onclick="return confirm('Cetak Laporan?')">
                                                Laporan
                                                <span class="icon mif-print bg-darkOrange"></span>
                                                </button></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            
                                        ?>
                                    </table>
                                    <br />
                                    <br />
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
