<!DOCTYPE html>
<html>
<?php 

if (session_status() === PHP_SESSION_NONE || $_SESSION["id"] == "") {
    session_start();
}
if (!(isset($_SESSION["id"]))) {
    header('Location: index.php');
}
// echo print_r($_SESSION);
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Inventory</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="main.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>                   

                    <li class="nav-item" role="presentation"><a class="nav-link" href="listing.php"><i class="fas fa-user"></i><span>Listing</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link" href="buyandsell.php"><i class="fas fa-user"></i><span>Buy and Sell</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link" href="report.php"><i class="fas fa-table"></i><span>Report</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <div class="input-group-append"></div>
                            </div>
                        </form>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo (isset($_SESSION['uname'])) ? $_SESSION['uname'] : 'User'; ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i><span onclick="logout();">&nbsp;Logout</span></a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Dashboard</h3></div>
                            <div class="row">
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-primary py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Today Sale</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0">$<span id="txtTodaySale">00,000</span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-info py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Monthly Sale</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="text-dark font-weight-bold h5 mb-0 mr-3">$<span id="txtMonthlySale">00,000</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-success py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Inventory item count(Fix)</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span id="txtInvtCountFix">00,000</span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow border-left-success py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Inventory item count(Auc)</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span id="txtInvtCountAuc">00,000</span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <img src="assets/img/MainBG.jpg" width ="100%">
                            </div>
                            <div class="row">
                                <footer class="bg-white sticky-footer">
                                    <div class="container my-auto">
                                        <div class="text-center my-auto copyright"><span>Copyright © Brand 2020</span></div>
                                    </div>
                                </footer>
                            </div>
                            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>

                            <script type="text/javascript">
                                function logout(){
                                    window.location.href = "index.php?logout=1";
                                }
                                loadData();
                                function loadData(){
                                    var x = document.getElementById('tempShow');
                                    $.ajax({
                                        type: 'post',
                                        url: 'controll/dashboardController.php', 
                                        data: {
                                            dashData : 1,
                                        }, 
                                        success: function (response) 
                                        {
                                            if (response) {
                                                // x.innerHTML = response;

                                                var obj = JSON.parse(response);

                                                document.getElementById("txtTodaySale").innerHTML = numberWithCommas(obj[0]);
                                                document.getElementById("txtMonthlySale").innerHTML = numberWithCommas(obj[1]);
                                                document.getElementById("txtInvtCountFix").innerHTML = numberWithCommas(obj[2]);
                                                document.getElementById("txtInvtCountAuc").innerHTML = numberWithCommas(obj[3]);
                                                
                                            }
                                            else{
                                                alert("No came data");
                                            }
                                        }
                                    });
                                }
                                function numberWithCommas(x) {
                                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }
                            </script>


                            <script src="assets/js/jquery.min.js"></script>
                            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                            <script src="assets/js/chart.min.js"></script>
                            <script src="assets/js/bs-init.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
                            <script src="assets/js/theme.js"></script>
                        </body>

                        </html>
