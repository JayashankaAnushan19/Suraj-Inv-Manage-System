<!DOCTYPE html>
<html>
<?php 
if (session_status() === PHP_SESSION_NONE || $_SESSION["id"] == "") {
    session_start();
}
if (!(isset($_SESSION["id"]))) {
    header('Location: index.php');
}
print_r($_SESSION);
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link " href="main.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>                   
                    
                    <li class="nav-item" role="presentation"><a class="nav-link" href="listing.php"><i class="fas fa-user"></i><span>Listing</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link" href="buyandsell.php"><i class="fas fa-user"></i><span>Buy and Sell</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link" href="report.php"><i class="fas fa-table"></i><span>Report</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link active" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
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
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo (isset($_SESSION['uname'])) ? $_SESSION['uname'] : 'User'; ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div
                                    class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i><span onclick="logout();">&nbsp;Logout</span></a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Profile</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header ">
                                            <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for=""><strong>Username</strong></label><input class="form-control" type="text" placeholder="User name" id="txtUserName" name="txtUserName" ></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="userLvl"><strong>User Level</strong></label><input class="form-control" type="text" placeholder="User Level" id="userLvl" name="userLvl" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button id="saveUserName" class="btn btn-primary btn-sm" onclick="changeUName();" type="button">Save Settings</button></div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <br>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    <strong>Change Password</strong>                              
                                                                </label>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <input id="chngPassChkBox" onchange="chngChkBox();" type="checkbox" name="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>



                                        <div id="changeSection" class="card shadow mb-3">
                                            <div class="card-header ">
                                                <p class="text-primary m-0 font-weight-bold">Password Settings</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="oldPass"><strong>Old Password</strong></label><input class="form-control" type="text" placeholder="Old Password" id="oldPass" name="oldPass" ></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="newPass"><strong>New Password</strong></label><input class="form-control" type="text" placeholder="New Password" id="newPass" name="newPass" ></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="retypePass"><strong>Re-type Password</strong></label><input class="form-control" type="text" placeholder="Re-type Password" id="retypePass" name="retypePass"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><button class="btn btn-primary btn-sm" onclick="changePassword();" type="submit">Change Password</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    loadData();
                    function loadData() {
                        $.ajax({
                            type: 'post',
                            url: 'controll/profileController.php', 
                            data: {
                                loadData : 1,
                            }, 
                            success: function (response) 
                            {
                                if (response) {
                                // alert(response);
                                var obj = JSON.parse(response);
                                document.getElementById("txtUserName").value = obj[0];
                                document.getElementById("userLvl").value = obj[1];
                            }
                            else{
                                alert("Connection Error. Please check the connect and try again.");
                            }
                        }
                    });
                    }

                    document.getElementById("changeSection").style.visibility = "hidden";
                    function chngChkBox() { 
                        var changeSection = document.getElementById("changeSection");
                        var chngPassChkBox = document.getElementById("chngPassChkBox");
                        if (chngPassChkBox.checked == true) {
                            changeSection.style.visibility = "visible";
                        }
                        else{
                            changeSection.style.visibility = "hidden";
                        }
                    }

                    var saveChanges = document.getElementById("txtUserName");
                    saveChanges.addEventListener("change", function(event) {
                        document.getElementById("saveUserName").innerHTML = "Update";
                        document.getElementById("saveUserName").classList.add("btn-warning");
                    });

                    function changeUName() {
                        var UsrName = document.getElementById("txtUserName").value;

                        $.ajax({
                            type: 'post',
                            url: 'controll/profileController.php', 
                            data: {
                                changeUName : 1,
                                UsrName : UsrName,
                            }, 
                            success: function (response) 
                            {
                                if (response) {
                                    alert(response);
                                    document.getElementById("saveUserName").reset();
                                }
                                else{
                                    alert("Connection Error. Please check the Connection and try again.");
                                }
                            }
                        });
                    }

                    function changePassword() {
                        var oldPass = document.getElementById("oldPass").value;
                        var newPass = document.getElementById("newPass").value;
                        var retypePass = document.getElementById("retypePass").value;

                        if (newPass != retypePass) {
                            alert("Newly entered Passwords are not matched. Please re-enter valid passwords. Err(Passwords not matched.)");
                            document.getElementById("oldPass").value = document.getElementById("newPass").value = "";
                            document.getElementById("retypePass").value = "";
                        }
                        else{
                            $.ajax({
                                type: 'post',
                                url: 'controll/profileController.php', 
                                data: {
                                    changePass : 1,
                                    oldPass : oldPass,
                                    newPass : newPass,
                                }, 
                                success: function (response) 
                                {
                                    if (response) {
                                        if (response = "ok") {
                                            alert("Password changed successfully. Please re-login.");
                                            window.location.href = "index.php";
                                        }
                                        else{
                                            alert(response);
                                            document.getElementById("oldPass").value = "";
                                            document.getElementById("newPass").value = "";
                                            document.getElementById("retypePass").value = "";
                                        }
                                    }
                                    else{
                                        alert("Connection Error. Please check the connect and try again.");
                                    }
                                }
                            });
                        }
                    }

                </script>

                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © Brand 2020</span></div>
                    </div>
                </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>

            <script type="text/javascript">
                function logout(){
                    window.location.href = "index.php?logout=1";
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