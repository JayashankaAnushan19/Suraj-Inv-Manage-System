<!DOCTYPE html>
<html>
<?php 
if (session_status() === PHP_SESSION_NONE || $_SESSION["id"] == "") {
    session_start();
}
if (!(isset($_SESSION["id"]))) {
    header('Location: index.php');
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
                    
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="listing.php"><i class="fas fa-user"></i><span>Listing</span></a></li>

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
                        <h3 class="text-dark mb-4">
                            Item Listing &nbsp;&nbsp;
                            <button class="btn btn-primary btn-md" id="btnNew" name="btnNew" onclick="newClicked()">New&nbsp;</button> 
                        </h3>
                        <div class="row mb-5">
                            <div class="col-lg-12">                      
                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div id="topicBG" class="card-header py-3">
                                                <p id="topicText" class="text-primary m-0 font-weight-bold">Item Listing</p>
                                            </div>
                                            <div class="card-body">
                                                <form id="dataOperateArea" method="post">
                                                    <div class="form-group">
                                                        <label for="txtName"><strong>Name</strong></label>
                                                        <input type="hidden" id="txtId" name="txtId">
                                                        <input class="form-control" type="text" placeholder="Enter listing Name..." id="txtName" name="txtName">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="txtURL"><strong>URL</strong></label>
                                                        <input class="form-control" type="text" placeholder="Enter buy URL..." id="txtURL" name="txtURL">
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label for="txtListQty"><strong>Listed Qty</strong></label>
                                                                <input class="form-control" type="number" placeholder="Enter Qty..." id="txtListQty" name="txtListQty"></div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">                                                                
                                                                    <label for="email">
                                                                        <strong> Status </strong>
                                                                    </label>
                                                                    <select class="form-control" id="slctStatus" name="slctStatus">
                                                                        <option value="0">Fix</option>
                                                                        <option value="1">Auction</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col">
                                                                <div class="form-group"><label for="txtUnitPriceUSD"><strong>Unit Price USD</strong></label>
                                                                    <input class="form-control" type="text" placeholder="Enter Unit Price USD..." id="txtUnitPriceUSD" name="txtUnitPriceUSD">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group"><label for="txtShippingCostUSD"><strong>Shipping Cost USD</strong></label>
                                                                    <input class="form-control" type="text" placeholder="Enter Shipping Cost USD..." id="txtShippingCostUSD" name="txtShippingCostUSD">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </form>
                                                    <div class="form-group">
                                                        <button class="btn btn-success btn-md" id="btnAdd" name="btnAdd" onclick="addData()">Add New&nbsp;</button>
                                                        <button class="btn btn-warning btn-md" id="btnUpdate"  name="btnUpdate" onclick="updateData()">Update&nbsp;</button>
                                                        <button class="btn btn-danger btn-md" id="btnDelete" name="btnDelete" onclick="deleteData()">Delete&nbsp;</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Listed Item List</h3>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-md-6 text-nowrap">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-right dataTables_filter">
                                            <label>
                                                <input type="text" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" id="searchText" onkeyup="searchData(this.value)"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>URL</th>
                                                    <th>Listed Qty</th>
                                                    <th>Status</th>
                                                    <th>Unit Cost USD</th>
                                                    <th>Shipping Cost USD</th>
                                                    <th>Edit / Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataBody">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th><strong>#</strong></th>
                                                    <th><strong>Name</strong></th>
                                                    <th><strong>URL</strong></th>
                                                    <th><strong>Listed Qty</strong></th>
                                                    <th><strong>Status</strong></th>
                                                    <th><strong>Unit Cost USD</strong></th>
                                                    <th><strong>Shipping Cost USD</strong></th>
                                                    <th><strong>Edit / Delete</strong></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 align-self-center">
                                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing result : First 5 or less.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="testddd"></div>

                        <footer class="bg-white sticky-footer">
                            <div class="container my-auto">
                                <div class="text-center my-auto copyright"><span>Copyright ?? Brand 2020</span></div>
                            </div>
                        </footer>
                    </div>



                    <script type="text/javascript">

                        document.getElementById("btnNew").style.visibility = "hidden";
                        document.getElementById("btnAdd").style.visibility = "visible";
                        document.getElementById("btnUpdate").style.visibility = "hidden";
                        document.getElementById("btnDelete").style.visibility = "hidden";

                        function deleteData() {
                            var txtID = document.getElementById("txtId").value;
                            var txtName = document.getElementById("txtName").value;

                            if (confirm("Are you sure to delete (" + txtName +") ?")) {
                                // alert("You can delete the item of "+ txtName);
                                $.ajax({
                                    type: 'post',
                                    url: 'controll/listingController.php', 
                                    data: {
                                        btnDelete : 1,
                                        txtID : txtID,
                                    },
                                    success: function (response) {
                                        if (response == "0") {
                                            alert("\""+ txtName + "\"" + " deleted Successfully.");
                                            searchData(0);
                                            newClicked();
                                        }
                                        else{
                                            alert("Something is wrong. Contact system admin. \n\n" + response);
                                            searchData(0);
                                            newClicked();
                                        }
                                    }
                                });
                            }
                        }

                        function updateData(){
                            var txtID = document.getElementById("txtId").value;
                            var txtName = document.getElementById("txtName").value;
                            var txtURL = document.getElementById("txtURL").value;
                            var txtListQty = document.getElementById("txtListQty").value;
                            var slctStatus = document.getElementById("slctStatus").value;
                            var txtUnitPriceUSD = document.getElementById("txtUnitPriceUSD").value;
                            var txtShippingCostUSD = document.getElementById("txtShippingCostUSD").value;

                            var x = "1";
                            if (txtName == ""){
                                x = "Name feild is empty. Enter Product Name."
                            }
                            else if (txtURL == "") {
                                x = "URL feild is empty. Enter URL."
                            }
                            else if (txtListQty == "") {
                                x = "Listed Qty feild is empty. Enter Listed Qty."
                            }
                            else if (txtUnitPriceUSD == "") {
                                x = "Unit Price(USD) feild is empty. Enter Unit Price(USD)."
                            }
                            else if (txtShippingCostUSD == "") {
                                x = "Shipping Cost(USD) feild is empty. Enter Shipping Cost(USD))."
                            }
                            if (x != 1) {
                                alert(x);
                            }
                            if (x == "1") { 
                                $.ajax({
                                    type: 'post',
                                    url: 'controll/listingController.php', 
                                    data: {
                                        btnUpdate : 1,
                                        txtID : txtID,
                                        txtName : txtName,
                                        txtURL : txtURL,
                                        txtListQty : txtListQty,
                                        slctStatus : slctStatus,
                                        txtUnitPriceUSD : txtUnitPriceUSD,
                                        txtShippingCostUSD : txtShippingCostUSD,
                                    },
                                    success: function (response) {
                                        if (response == "0") {
                                            alert("Details updated Successfully.");
                                            searchData(0);
                                            newClicked();
                                        }
                                        else{
                                            alert("Something is wrong. Contact system admin. \n\n" + response);
                                            searchData(0);
                                            newClicked();
                                        }
                                    }
                                });
                            }
                        }

                        function newClicked() {
                            document.getElementById("btnNew").style.visibility = "hidden";
                            document.getElementById("btnAdd").style.visibility = "visible";
                            document.getElementById("btnUpdate").style.visibility = "hidden";
                            document.getElementById("btnDelete").style.visibility = "hidden";

                            document.getElementById("txtId").value = "";
                            document.getElementById("txtName").value = "";
                            document.getElementById("txtURL").value = "";
                            document.getElementById("txtListQty").value = "";
                            document.getElementById("slctStatus").selectedIndex = "0";
                            document.getElementById("txtUnitPriceUSD").value = "";
                            document.getElementById("txtShippingCostUSD").value = "";

                            $("#dataOperateArea").find('input').each(function () {
                                $(this).attr('disabled', false);
                            });
                            $("#dataOperateArea").find('select').each(function () {
                                $(this).attr('disabled', false);
                            });

                            document.getElementById("topicText").innerHTML = "Item Listing";
                            document.getElementById("topicBG").style.backgroundColor = "";

                        }

                        function modifySearchU(id) {                            
                            document.getElementById("btnNew").style.visibility = "visible";
                            document.getElementById("btnAdd").style.visibility = "hidden";
                            document.getElementById("btnUpdate").style.visibility = "visible";
                            document.getElementById("btnDelete").style.visibility = "hidden";

                            $("#dataOperateArea").find('input').each(function () {
                                $(this).attr('disabled', false);
                            });
                            $("#dataOperateArea").find('select').each(function () {
                                $(this).attr('disabled', false);
                            });

                            document.getElementById("topicText").innerHTML = "Update the Item";
                            document.getElementById("topicBG").style.backgroundColor = "#ffb347";

                            modifySearch(id);                             
                        }
                        function modifySearchD(id) {
                            document.getElementById("btnNew").style.visibility = "visible";
                            document.getElementById("btnAdd").style.visibility = "hidden";
                            document.getElementById("btnUpdate").style.visibility = "hidden";
                            document.getElementById("btnDelete").style.visibility = "visible";
                            
                            $("#dataOperateArea").find('input').each(function () {
                                $(this).attr('disabled', true);
                            });
                            $("#dataOperateArea").find('select').each(function () {
                                $(this).attr('disabled', true);
                            });

                            document.getElementById("topicText").innerHTML = "Delete the Item";
                            document.getElementById("topicBG").style.backgroundColor = "#f69697";

                            modifySearch(id); 
                        }
                        function modifySearch(id) {
                            // alert(id); 
                            if (id || id == "0") {
                                // alert("ID is not empty"); 
                                $.ajax({
                                    type: 'post',
                                    url: 'controll/listingController.php', 
                                    data: {
                                        idSearch : 1,
                                        id : id,
                                    },
                                    success: function (response) {
                                        if (response) {
                                            // alert(response);

                                            var obj = JSON.parse(response);

                                            document.getElementById("txtId").value = obj[0];
                                            document.getElementById("txtName").value = obj[1];
                                            document.getElementById("txtURL").value = obj[2];
                                            document.getElementById("txtListQty").value = obj[3];
                                            document.getElementById("slctStatus").selectedIndex = obj[4];
                                            document.getElementById("txtUnitPriceUSD").value = obj[5];
                                            document.getElementById("txtShippingCostUSD").value = obj[6];

                                            $('html,body').scrollTop(1);
                                        }
                                    }
                                });
                            }
                            else{
                                alert("ID not empty");
                                newClicked();
                            }
                        }


                        function addData(){   
                            var txtName = document.getElementById("txtName").value;
                            var txtURL = document.getElementById("txtURL").value;
                            var txtListQty = document.getElementById("txtListQty").value;
                            var slctStatus = document.getElementById("slctStatus").value;
                            var txtUnitPriceUSD = document.getElementById("txtUnitPriceUSD").value;
                            var txtShippingCostUSD = document.getElementById("txtShippingCostUSD").value;

                            var x = "1";
                            if (txtName == ""){
                                x = "Name feild is empty. Enter Product Name."
                            }
                            else if (txtURL == "") {
                                x = "URL feild is empty. Enter URL."
                            }
                            else if (txtListQty == "") {
                                x = "Listed Qty feild is empty. Enter Listed Qty."
                            }
                            else if (txtUnitPriceUSD == "") {
                                x = "Unit Price(USD) feild is empty. Enter Unit Price(USD)."
                            }
                            else if (txtShippingCostUSD == "") {
                                x = "Shipping Cost(USD) feild is empty. Enter Shipping Cost(USD))."
                            }
                            if (x != 1) {
                                alert(x);
                            }
                            if (x == "1") {
                                $.ajax({
                                    type: 'post',
                                    url: 'controll/listingController.php', 
                                    data: {
                                        btnAdd : 1,
                                        txtName : txtName,
                                        txtURL : txtURL,
                                        txtListQty : txtListQty,
                                        slctStatus : slctStatus,
                                        txtUnitPriceUSD : txtUnitPriceUSD,
                                        txtShippingCostUSD : txtShippingCostUSD,
                                    },
                                    success: function (response) {
                                        if (response == "0") {
                                            alert("Details saved Successfully.");

                                            document.getElementById("txtName").value = "";
                                            document.getElementById("txtURL").value = "";
                                            document.getElementById("txtListQty").value = "";
                                            document.getElementById("txtUnitPriceUSD").value = "";
                                            document.getElementById("txtShippingCostUSD").value = "";
                                        }
                                    }
                                });
                            }
                        }
                        searchData(1);
                        function searchData(data){
                            $.ajax({
                                type: 'post',
                                url: 'controll/listingController.php', 
                                data: {
                                    txtSearch : 1,
                                    searchData : data,
                                },
                                success: function (response) {
                                    document.getElementById("dataBody").innerHTML = response;
                                }
                            });
                        }
                        function logout(){
                            window.location.href = "index.php?logout=1";
                        }
                    </script>  

                    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
                    <script src="assets/js/jquery.min.js"></script>
                    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                    <script src="assets/js/chart.min.js"></script>
                    <script src="assets/js/bs-init.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
                    <script src="assets/js/theme.js"></script>

                </body>

                </html>
