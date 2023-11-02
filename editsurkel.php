<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Surat Keluar-Sistem Management Surat</title>

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
        #miniform{
            width: 525px;
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kd_surat = test_input($_POST["kd_surat"]);
  $tgl_surat = test_input($_POST["tgl_surat"]);
  $surat_untuk = test_input($_POST["surat_untuk"]);
  $subjek_surat = test_input($_POST["subjek_surat"]);
  $deksripsi = test_input($_POST["deskripsi"]);
  $tipe_surat = test_input($_POST["tipe_surat"]);
  $no_id = test_input($_POST["no_id"]);

   $sql = "UPDATE mail_out SET mail_code='$kd_surat', mail_date='$tgl_surat', mail_to='$surat_untuk', mail_subject='$subjek_surat', description='$deksripsi', mail_typeid='$tipe_surat' WHERE id='$no_id'";

    if ($conn->query($sql) == TRUE) {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'success', caption: 'Berhasil', content: \"Data Berhasil Di tambahkan\"});
                    }, 30);
                });
            </script>";
        header("location:suratkeluar.php");
    } else {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal', content: \"Data Gagal di tambahkan\"});
                    }, 30);
                });
            </script>";
        header("location:suratkeluar.php");
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
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

<div data-role="dialog" id="dialog" class="padding20" data-close-button="true">
    
</div>

    <?php
    require_once("judul.php");
    ?>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1">
                     <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-pencil"></span></span>
                                <span class="window-caption-title">Edit Surat Keluar</span>
                                <a href="suratkeluar.php"><span class="btn-close bg-grayDark fg-white"></span></a>
                            </div>
                            <?php
                            $x = $_REQUEST['id'];
                            $sql = "SELECT * FROM mail_out WHERE id='$x'";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                 // output data of each row
                                 $row = $result->fetch_assoc();
                            ?>
                            <div class="window-content bg-white padding20" style="height: auto;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000" enctype="multipart/form-data">
            <input type="hidden" name="no_id" value="<?php echo $row['id']; ?>">
            <div class="input-control text mini-size" data-role="input" id="miniform">
                <label for="kd_surat">Kode Surat:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="kd_surat" id="kd_surat" value="<?php echo $row['mail_code'];?>">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd" id="miniform">
            <label for="tgl_surat">Tanggal Surat:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_surat" id="tgl_surat"  value="<?php echo $row['mail_date'];?>">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control text mini-size" data-role="input" id="miniform">
                <label for="surat_untuk">Surat Untuk:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="surat_untuk" id="surat_untuk" value="<?php echo $row['mail_to'];?>">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <div class="input-control text mini-size" data-role="input" id="miniform">
                <label for="subjek_surat">subjek Surat:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="subjek_surat" id="subjek_surat" value="<?php echo $row['mail_subject'];?>">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="deksripsi">deskripsi:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="deskripsi" id="deskripsi" value="<?php echo $row['description'];?>">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control file full-size" data-role="input">
                <label for="file_upload">File Upload:</label>
                <input type="file"
                name="data_upload" id="file_upload" placeholder="<?php echo $row['file_upload'];?>">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control select full-size">
                <label for="class">Tipe Surat:</label>
                <select id="class" name="tipe_surat">
                <?php
                $mail_id = $row["mail_typeid"];
                $sql1 = "SELECT id, type FROM mail_type WHERE id = '$mail_id'";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    $row1 = mysqli_fetch_assoc($result1);
                    $value1 = $row1["id"];
                    $type1 = $row1["type"];
                echo "<option value=\"$value1\">$type1</option>";
            }
        }
                $sql = "SELECT id, type FROM mail_type";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["type"]; ?></option>
                    <?php
                }
            }
                    ?>
                </select>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary" name="btnUpload">Finish</button>
                <a href=""><button type="button" class="button link">Cancel</button></a>
            </div>
        </form>
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
