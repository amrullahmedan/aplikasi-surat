<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Arsip Surat-Sistem Management Surat</title>

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
        
        #tableuser{
            font-size: 14px;
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
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1" style="overflow: scroll">
                     <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-drafts"></span></span>
                                <span class="window-caption-title">Arsip Surat</span>
                            </div>
                            <div class="window-content bg-grayLighter padding20" style="height: auto;">
                            <?php
                            if ($level == 'pimpinan') {
                                
                            }else{
                                echo "<button class=\"button primary text-shadow\" onclick=\"showDialog('dialog')\" ><span class=\"mif-plus\"></span> Tambah</button>";
                            }
                            ?>
                    <table class="table dataTable striped hovered cell-hovered border bordered" data-role="datatable" data-searching="true" id="tableuser">
                        <thead>
                        <tr>
                            <td class="sortable-column sort-asc fg-white bg-blue" style="width: 80px;">ID</td>
                            <td class="fg-white bg-cyan">Diterima Tgl</td>
                            <td class="fg-white bg-cyan">Kode Surat</td>
                            <td class="fg-white bg-cyan">Tgl Surat</td>
                            <td class="fg-white bg-cyan">Asal Surat</td>
                            <td class="fg-white bg-cyan">Subjek Surat</td>
                            <td class="fg-white bg-cyan">File Upload</td>
                            <td class="fg-white bg-cyan">Disposisi</td>
                            <td class="fg-white bg-cyan">Action</td>
                        </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM mail WHERE status='arsip' and disposisi='sudah'";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                 // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                    $id = $row["id"];

                        ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["incoming_at"]; ?></td>
                            <td><?php echo $row["mail_code"]; ?></td>
                            <td><?php echo $row["mail_date"]; ?></td>
                            <td><?php
                            if (strlen($row["mail_from"]) < 10 ) {
                                echo $row["mail_from"];
                            }else{
                                echo substr($row["mail_from"], 0,10).".....";
                            }
                            ?></td>
                            <td><?php echo $row["mail_subject"]; ?></td>
                            <td><?php echo substr($row["file_upload"], 0,15);
                            $jumlahkata = strlen($row["file_upload"]);
                            if ($jumlahkata > 15) {
                                echo "....";
                            }?>
                            </td>
                            <td align="center">
                              <?php
                                if ($row["disposisi"] == 'belum') {
                                    echo "<span class=\"mif-cross fg-red mif-lg\"></span>";
                                }else{
                                    echo "<span class=\"mif-checkmark fg-green mif-2x\"></span>";
                                }
                              ?>  
                            </td>
                            <td>
                            <?php
                            if ($level == 'pimpinan') {
                                if ($row["disposisi"] == 'sudah') {
                                    
                                }else{
                                    echo "<a href=\"disposisi.php?id=$id\"><button class=\"square-button small-button text-shadow bg-green fg-white\" data-role=\"hint\" data-hint-background=\"bg-lightGreen\" data-hint-color=\"fg-white\" data-hint-mode=\"2\" data-hint=\"disposisi\" data-hint-position=\"left\"><span class=\"mif-paper-plane\"></span></button></a>";
                                }
                            }else{
                                if ($row["disposisi"] == 'sudah') {
                                
                                }else{
                                echo "<a href=\"editsurmas.php?id=$id\"><button class=\"square-button small-button text-shadow bg-green fg-white\" data-role=\"hint\" data-hint-background=\"bg-lightGreen\" data-hint-color=\"fg-white\" data-hint-mode=\"2\" data-hint=\"Edit\" data-hint-position=\"left\"><span class=\"mif-pencil\"></span></button></a>";
                                }
                            }
                            ?>                                
                                <a href="deletesurmas.php?id=<?php echo $row["id"]; ?>"><button class="square-button small-button text-shadow bg-darkRed fg-white" data-role="hint" data-hint-background="bg-red" data-hint-color="fg-white" data-hint-mode="2" data-hint="Hapus" data-hint-position="top" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Pesan?')"><span class="mif-bin"></span></button></a>
                                <a href="lihatsurat.php?id=<?php echo $row["id"]; ?>"><button class="square-button small-button text-shadow bg-darkCyan fg-white" data-role="hint" data-hint-background="bg-blue" data-hint-color="fg-white" data-hint-mode="2" data-hint="Lihat" data-hint-position="bottom"><span class="mif-eye"></span></button></a>
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
