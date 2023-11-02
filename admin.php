<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Admin-Sistem Management Surat</title>

        <link href="css/metro.css" rel="stylesheet">
        <link href="css/metro-icons.css" rel="stylesheet">
        <link href="css/metro-responsive.css" rel="stylesheet">
        <link href="css/metro-schemes.css" rel="stylesheet">

        <link href="css/docs.css" rel="stylesheet">

        <script src="jquery.js"></script>
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
if(!isset($_SESSION['admin'])) {
header("location:login.php"); }
else{
    $username = $_SESSION['admin'];
}
 require_once("koneksi.php");
$sql = "SELECT fullname, level FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $fullname = $row["fullname"];
        $level = $row["level"];
?>
<body class="bg-steel">
    <div class="app-bar fixed-top darcula" data-role="appbar">
        <a class="app-bar-element branding"><span class="mif-mail mif-2x"></span> SMS (Sistem Management Surat)</a>
        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span> <?php echo $fullname;?></span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-grayLighter" data-role="dropdown" data-no-close="true" style="width: 220px">
                <h2 class="text-light">Quick settings</h2>
                <ul class="unstyled-list fg-grayLighter">
                    <li><a href="" class="fg-white1 fg-hover-yellow">Profile</a></li>
                    <li><a href="" class="fg-white2 fg-hover-yellow">Security</a></li>
                    <li><a href="keluar.php" class="fg-white3 fg-hover-yellow">Exit</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="cell size-x200" id="cell-sidebar" style="background-color: #3C3F41; height: 100%">
                <div>
                    
                </div>
                    <ul class="sidebar darcula">
                        <li><a href="#">
                            <span class="mif-apps icon"></span>
                            <span class="title">all items</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-vpn-publ icon"></span>
                            <span class="title">websites</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li class="active"><a href="#button1">
                            <span class="mif-drive-eta icon"></span>
                            <span class="title">Virtual machines</span>
                            <span class="counter">2</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-cloud icon"></span>
                            <span class="title">Cloud services</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-database icon"></span>
                            <span class="title">SQL Databases</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-cogs icon"></span>
                            <span class="title">Automation</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-apps icon"></span>
                            <span class="title">all items</span>
                            <span class="counter">0</span>
                        </a></li>
                    </ul>
                </div>
                <div class="cell auto-size padding20 bg-white" id="cell-content div1">
                    <h1 class="text-light">Virtual machines <span class="mif-drive-eta place-right"></span></h1>
                    <hr class="thin bg-grayLighter">
                    <button class="button primary" onclick="pushMessage('info')"><span class="mif-plus"></span> Create...</button>
                    <button class="button success" onclick="pushMessage('success')"><span class="mif-play"></span> Start</button>
                    <button class="button warning" onclick="pushMessage('warning')"><span class="mif-loop2"></span> Restart</button>
                    <button class="button alert" onclick="pushMessage('alert')">Stop all machines</button>
                    <hr class="thin bg-grayLighter">
                    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false" data-searching="true">
                        <thead>
                        <tr>
                            <td style="width: 20px">
                            </td>
                            <td class="sortable-column sort-asc" style="width: 100px">ID</td>
                            <td class="sortable-column">Machine name</td>
                            <td class="sortable-column">Address</td>
                            <td class="sortable-column" style="width: 20px">Status</td>
                            <td style="width: 20px">Switch</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <label class="input-control checkbox small-check no-margin">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </td>
                            <td>123890723212</td>
                            <td>Machine number 1</td>
                            <td><a href="http://virtuals.com/machines/123890723212">link</a></td>
                            <td class="align-center"><span class="mif-checkmark fg-green"></span></td>
                            <td>
                                <label class="switch-original">
                                    <input type="checkbox" checked>
                                    <span class="check"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="input-control checkbox small-check no-margin">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </td>
                            <td>123890723212</td>
                            <td>Machine number 2</td>
                            <td><a href="http://virtuals.com/machines/123890723212">link</a></td>
                            <td class="align-center"><span class="mif-stop fg-red"></span></td>
                            <td>
                                <label class="switch-original">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
}
    ?>
</body>
</html>