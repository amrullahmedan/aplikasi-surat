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
 
//BUAT INPUT LOGIN

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_surat = test_input($_POST["id_surat"]);
  $tgl_disposisi = test_input($_POST["tgl_disposisi"]);
  $dispos_oleh = test_input($_POST["dispos"]);
  $tanggap = test_input($_POST["tanggapan"]);
  $ket = test_input($_POST["keterangan"]);
  $id_user = test_input($_POST["no_user"]);

  //kodeotomatis
   $query = "SELECT max(id) as maxKode FROM disposition";
  $hasil = mysqli_query($conn,$query);
  $data = mysqli_fetch_array($hasil);
  $kode_otomatis = $data['maxKode'];

  $noUrut = (int)substr($kode_otomatis, 2, 3);
  $noUrut++;
  $char = "DS";
  $kode_otomatis = $char . sprintf("%03s", $noUrut);
  //=============================================================

    $sql = "INSERT INTO disposition (id, disposition_at, reply_at, description, notification, mailid, userid)
    VALUES ('$kode_otomatis', '$tgl_disposisi', '$dispos_oleh', '$ket', '$tanggap', '$id_surat', '$id_user')";

    if ($conn->query($sql) == TRUE) {
        $sql = "UPDATE mail SET disposisi='sudah' WHERE id='$id_surat'";
        if ($conn->query($sql) == TRUE) {
            header("location:suratmasuk.php"); 
            echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'success', caption: 'Berhasil', content: \"Surat Berhasil di Disposisi\"});
                    }, 30);
                });
            </script>";
        }
        
    } else {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal', content: \"Surat Gagal di Disposisi $conn->error\"});
                    }, 30);
                });
            </script>";
    }
    if ($tanggap == 'balas') {
  //kodeotomatis
  $query = "SELECT max(id) as maxKode FROM mail_out";
  $hasil = mysqli_query($conn,$query);
  $data = mysqli_fetch_array($hasil);
  $kode_otomatis = $data['maxKode'];

  $noUrut = (int)substr($kode_otomatis, 2, 3);
  $noUrut++;
  $char = "SK";
  $kode_otomatis = $char . sprintf("%03s", $noUrut);
  //=============================================================
  $kode_surat = "PT Pelindo".date('d/m/Y');
  $Tanggal_surat = date('Y-m-d');
  $sql = "SELECT * FROM mail WHERE id='$id_surat'";
    $result = mysqli_query($conn, $sql);
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    $mail_to = $row["mail_from"];
    $subjek_surat = "Surat Balasan";
    $file_upload = "Tidak Ada";

    $sql = "INSERT INTO mail_out (id, mail_code, mail_date, mail_to, mail_subject, description, file_upload, mail_typeid, userid)
    VALUES ('$kode_otomatis', '$kode_surat', '$Tanggal_surat', '$mail_to', '$subjek_surat', '$ket', '$file_upload', 'JS005', '$user_id')";

    if ($conn->query($sql) == TRUE) {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'success', caption: 'Berhasil', content: \"Surat Berhasil Dibalas\"});
                    }, 30);
                });
            </script>";
    } else {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal', content: \"Surat Gagal Dibalas\"});
                    }, 30);
                });
            </script>";
    }

    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
                                <span class="window-caption-icon"><span class="mif-paper-plane"></span></span>
                                <span class="window-caption-title">Disposisi</span>
                                <a href="suratmasuk.php"><span class="btn-close bg-grayDark fg-white"></span></a>
                            </div>

                            <?php
                            $x = $_REQUEST['id'];
                            $sql = "SELECT * FROM mail WHERE id='$x'";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                 // output data of each row
                                 while($row = $result->fetch_assoc()) {
                            ?>
                            <div class="window-content bg-white padding20" style="height: auto;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000" enctype="multipart/form-data">
            <input type="hidden" name="no_user" value="<?php echo $user_id; ?>">
            <div class="input-control text mini-size" data-role="input" id="miniform">
                <label for="deksripsi">ID Surat Masuk:</label>
                <input type="hidden" name="no_id" value="<?php echo $user_id; ?>">
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="id_surat" id="deskripsi" value="<?php echo $row['id'];?>" readonly>
                
            </div>
            <br />
            <br />
            <?php
        }
    }
            ?>
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd" id="miniform">
            <label for="tgl_terima">Tanggal Disposisi:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_disposisi" id="tgl_terima">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control select mini-size" id="miniform">
                <label for="class">Disposisi Oleh:</label>
                <select id="class" name="dispos">
                <?php
                $sql = "SELECT * FROM user WHERE id='$user_id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $row["jabatan"]; ?>"><?php echo $row["username"]."-".$row["jabatan"]; ?></option>
                    <?php
                }
            }
                    ?>
                </select>
            </div>
            <br />
            <br />
            <div class="input-control select mini-size" id="miniform">
                <label for="class">Tanggapan:</label>
                <select id="class" name="tanggapan">
                    <option value="balas">Balas Surat</option>
                    <option value="abaikan">Abaikan Surat</option>
                </select>
            </div>
            <br />
            <br />
            <div class="input-control text mini-size" data-role="input" id="miniform">
                <label for="ket">Keterangan:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="keterangan" id="ket">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
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
