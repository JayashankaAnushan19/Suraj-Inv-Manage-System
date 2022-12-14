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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="main.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>                   
                    
                    <li class="nav-item" role="presentation"><a class="nav-link" href="listing.php"><i class="fas fa-user"></i><span>Listing</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link active" href="buyandsell.php"><i class="fas fa-user"></i><span>Buy and Sell</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link" href="report.php"><i class="fas fa-table"></i><span>Report</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link " href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
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
                            Buy and Sell Items&nbsp;&nbsp;
                            <button class="btn btn-primary btn-md" id="btnNew" name="btnNew" onclick="newClicked()">New&nbsp;</button> 
                        </h3>
                        <div class="row mb-5">
                            <div class="col-lg-12">                      
                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                         <div id="topicBG" class="card-header py-3">
                                            <p id="topicText" class="text-primary m-0 font-weight-bold">Buy and Sell Items</p>
                                        </div>
                                        <div class="card-body">
                                            <form id="buySellForm" method="post">
                                                <div class="form-group">
                                                    <input type="hidden" id="txtID" name="txtID">
                                                    <input type="hidden" id="listedItemID" name="listedItemID">
                                                    <label for="txtSoldItemName"><strong>Name</strong></label>
                                                    <input class="form-control" type="text" placeholder="Enter listing Name..." id="txtSoldItemName" name="txtSoldItemName" onkeyup="filterName(this.value);">
                                                </div>
                                                <div class="form-group">
                                                    <table class="table" id="nameSuggestDIV">
                                                    </table>
                                                    <!-- Add list as a table -->
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="txtSoldURL"><strong>URL</strong></label>                                                        
                                                            <!-- <input  type="href" placeholder="Enter buy URL..." value=""> -->
                                                            <a class="form-control" id="txtSoldURL" name="txtSoldURL" href="" target="_blank">Go to the site</a>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSoldListedStatus"><strong>Listed status</strong></label><input class="form-control" type="text" placeholder="..." id="txtSoldListedStatus" name="txtSoldListedStatus" readonly></div>
                                                    </div>                                                       
                                                </div>                                                    
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSoldListedQty"><strong>Listed Qty</strong></label><input class="form-control" type="number" placeholder="00" id="txtSoldListedQty" name="txtSoldListedQty" readonly></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSoldRemainQty"><strong>Remain Qty</strong></label><input class="form-control" type="text" placeholder="00" id="txtSoldRemainQty" name="txtSoldRemainQty" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSoldUnitCost"><strong>Listed Unit Price USD</strong></label><input class="form-control" type="number" placeholder="00" id="txtSoldUnitCost" name="txtSoldUnitCost" readonly></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSoldShippingCost"><strong>Listed Shipping Cost USD</strong></label><input class="form-control" type="number" placeholder="00" id="txtSoldShippingCost" name="txtSoldShippingCost" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSelingUnitCost"><strong>Selling Unit Price USD</strong> 
                                                            <span style="border: 1px solid black; border-radius: 10px" onclick="readChangeSellUnit();">&nbsp;Change&nbsp;</span>
                                                        </label><input class="form-control" type="number" placeholder="00" id="txtSelingUnitCost" name="txtSelingUnitCost" readonly></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSellingShippingCost"><strong>Selling Shipping Cost USD</strong>
                                                            <span style="border: 1px solid black; border-radius: 10px" onclick="readChangeSellShipping();">&nbsp;Change&nbsp;</span>
                                                        </label><input class="form-control" type="number" placeholder="00" id="txtSellingShippingCost" name="txtSellingShippingCost" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSoldDate"><strong>Paid Date</strong></label><input class="form-control" type="date" placeholder="Enter Unit Price USD..." id="txtSoldDate" name="txtSoldDate"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtSoldQty"><strong>Sold Qty</strong></label><input class="form-control" type="number" placeholder="Enter Shipping Cost USD..." id="txtSoldQty" onkeyup="checkQty()" name="txtSoldQty"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtEbayOrderID"><strong>Ebay Order ID</strong></label><input class="form-control" type="text" placeholder="Enter Unit Price USD..." id="txtEbayOrderID" name="txtEbayOrderID"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtAliOrderID"><strong>Ali Order ID</strong></label><input class="form-control" type="text" placeholder="Enter Shipping Cost USD..." id="txtAliOrderID" name="txtAliOrderID"></div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtTrackingID"><strong>Tracking ID</strong></label><input class="form-control" type="text" placeholder="Enter Unit Price USD..." id="txtTrackingID" name="txtTrackingID"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtCarrier"><strong>Carrier</strong></label><input class="form-control" type="text" placeholder="Enter Shipping Cost USD..." id="txtCarrier" name="txtCarrier"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtPaypalCharge"><strong>Paypal chrage USD</strong></label><input class="form-control" type="number" placeholder="Enter Unit Price USD..." id="txtPaypalCharge" name="txtPaypalCharge"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="txtUSD_LKR_Rate"><strong>USD LKR Rate</strong></label><input class="form-control" type="number" placeholder="Enter Shipping Cost USD..." id="txtUSD_LKR_Rate" name="txtUSD_LKR_Rate"></div>
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
                <h3 class="text-dark mb-4">Sold Item List</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label>
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
                                        <th>Sold Date</th>
                                        <th>Sold Qty</th>
                                        <th>Selling Unit Cost USD</th>
                                        <th>Edit / Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="dataBody">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><strong>#</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Sold Date</strong></th>
                                        <th><strong>Sold Qty</strong></th>
                                        <th><strong>Selling Unit Cost USD</strong></th>
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

            function filterName(name) {
                if (name.length > 1) {

                    $.ajax({
                        type: 'post',
                        url: 'controll/buySellController.php', 
                        data: {
                            txtFilterName : 1,
                            name : name.toLowerCase(),
                        },
                        success: function (response) {
                            document.getElementById("nameSuggestDIV").innerHTML = response;
                        }
                    });
                }
                else{
                    var element = document.getElementById("nameSuggestDIV");
                    element.removeChild(element.firstElementChild);
                }
            }

            function loadDataToText(idToTXT) {
                if (idToTXT) {
                    $.ajax({
                        type: 'post',
                        url: 'controll/buySellController.php', 
                        data: {
                            loadDataToTXT : 1,
                            idToTXT : idToTXT,
                        },
                        success: function (response) {
                            var obj = JSON.parse(response);

                            document.getElementById("listedItemID").value = obj[0];
                            document.getElementById("txtSoldItemName").value = obj[1];

                            document.getElementById("txtSoldURL").value = obj[2];

                            var a = document.getElementById('txtSoldURL');
                            a.href =  obj[2];

                            document.getElementById("txtSoldListedQty").value = obj[3];
                            document.getElementById("txtSoldListedStatus").value = obj[4];
                            document.getElementById("txtSoldUnitCost").value = document.getElementById("txtSelingUnitCost").value = obj[5];
                            document.getElementById("txtSoldShippingCost").value = document.getElementById("txtSellingShippingCost").value = obj[6];



                            document.getElementById("txtSoldRemainQty").value = obj[3] - obj[7];
                            if ((obj[3] - obj[7])<1) {
                                var form = document.getElementById("buySellForm");
                                var elements = form.elements;
                                for (var i = 0, len = elements.length; i < len; ++i) {
                                    elements[i].readOnly = true;
                                }
                            }

                            var el = document.getElementById("nameSuggestDIV");
                            el.removeChild(el.firstElementChild);
                        }
                    });
                }
            }

            function checkQty() {
                var remainQty = document.getElementById("txtSoldRemainQty").value;
                var curent = document.getElementById("txtSoldQty");

                if (parseInt(remainQty) < parseInt(curent.value)) {
                    alert("Invalid Qty. Please enter valid qty");
                    curent.value = "00";
                }
                else if (parseInt(curent.value) < 0) {
                    alert("Invalid Qty. Please enter valid qty");
                    curent.value = "00";
                }

            }

            function readChangeSellUnit(){
                var ele = document.getElementById("txtSelingUnitCost");
                if (ele.readOnly == false) {
                    ele.readOnly = true;
                }
                else{
                    ele.readOnly = false;
                }
            }
            function readChangeSellShipping() {
                var ele = document.getElementById("txtSellingShippingCost");
                if (ele.readOnly == false) {
                    ele.readOnly = true;
                }
                else{
                    ele.readOnly = false;
                }                        
            }

            function addData(){
                var txtSoldDate = document.getElementById("txtSoldDate").value;
                var txtEbayOrderID = document.getElementById("txtEbayOrderID").value;
                var txtAliOrderID = document.getElementById("txtAliOrderID").value;
                var txtTrackingID = document.getElementById("txtTrackingID").value;
                var txtCarrier = document.getElementById("txtCarrier").value;
                var txtSoldQty = document.getElementById("txtSoldQty").value;
                var txtSelingUnitCost = document.getElementById("txtSelingUnitCost").value;
                var txtSellingShippingCost = document.getElementById("txtSellingShippingCost").value;
                var txtPaypalCharge = document.getElementById("txtPaypalCharge").value;
                var txtUSD_LKR_Rate = document.getElementById("txtUSD_LKR_Rate").value;
                var listedItemID = document.getElementById("listedItemID").value;

                var x = "1";
                if (txtSoldDate == "")
                {
                    x = "Sold Date feild is empty. Enter Product Sold Date."
                }
                else if (txtEbayOrderID == "") 
                {
                    x = "Ebay OrderID feild is empty. Enter Ebay OrderID."
                }
                else if (txtAliOrderID == "") 
                {
                    x = "Ali OrderID feild is empty. Enter Ali OrderID."
                }
                else if (txtTrackingID == "") 
                {
                    x = "Tracking ID feild is empty. Enter Tracking ID."
                }
                else if (txtCarrier == "") 
                {
                    x = "Carrier feild is empty. Enter Carrier)."
                }
                else if (txtSoldQty == "") 
                {
                    x = "Sold Qty feild is empty. Enter Sold Qty."
                }
                else if (txtSelingUnitCost == "" || txtSelingUnitCost<0) 
                {
                    txtSelingUnitCost = 0;
                    x = "Unit Seling Cost invalid. Enter valide Seling Unit Cost)."
                }
                else if (txtSellingShippingCost == "" || txtSellingShippingCost<0) 
                {
                    txtSellingShippingCost = 0;
                    x = "Shipping Cost invalid. Enter valide Shipping Cost)."
                }
                else if (txtPaypalCharge == "" || txtPaypalCharge < 0) 
                {
                    txtPaypalCharge = 0;
                    x = "Paypal Charge invalid. Enter valide Paypal Charge)."
                }
                else if (txtUSD_LKR_Rate == "" || txtUSD_LKR_Rate<0) 
                {
                    txtUSD_LKR_Rate = 1;
                    x = "USD_LKR_Rate invalid. Enter valid USD_LKR_Rate)."
                }
                if (x != 1) 
                {
                    alert(x);
                }
                if (x == "1") 
                {
                    $.ajax({
                        type: 'post',
                        url: 'controll/buySellController.php', 
                        data: {
                            btnAdd : 1,
                            txtSoldDate : txtSoldDate,
                            txtEbayOrderID : txtEbayOrderID,
                            txtAliOrderID : txtAliOrderID,
                            txtTrackingID : txtTrackingID,
                            txtCarrier : txtCarrier,
                            txtSoldQty : txtSoldQty,
                            txtSelingUnitCost : txtSelingUnitCost,
                            txtSellingShippingCost : txtSellingShippingCost,
                            txtPaypalCharge : txtPaypalCharge,
                            txtUSD_LKR_Rate : txtUSD_LKR_Rate,
                            listedItemID : listedItemID,
                        },
                        success: function (response) {
                            if (response == "0") {
                                alert("Details saved Successfully.");
                                clearAll();
                            }
                            else{
                                alert(response);
                            }
                        }
                    });
                }
            }
            function clearAll(){
                document.getElementById("txtID").value = "";
                document.getElementById("listedItemID").value = "";
                document.getElementById("txtSoldItemName").value = "";
                document.getElementById("txtSoldURL").value = "";
                document.getElementById("txtSoldListedStatus").value = "";
                document.getElementById("txtSoldListedQty").value = "";
                document.getElementById("txtSoldRemainQty").value = "";
                document.getElementById("txtSoldUnitCost").value = "";
                document.getElementById("txtSoldShippingCost").value = "";                            
                document.getElementById("txtSoldDate").value = "";
                document.getElementById("txtEbayOrderID").value = "";
                document.getElementById("txtAliOrderID").value = "";
                document.getElementById("txtTrackingID").value = "";
                document.getElementById("txtCarrier").value = "";
                document.getElementById("txtSoldQty").value = "";
                document.getElementById("txtSelingUnitCost").value = "";
                document.getElementById("txtSellingShippingCost").value = "";
                document.getElementById("txtPaypalCharge").value = "";
                document.getElementById("txtUSD_LKR_Rate").value = "";
                document.getElementById("listedItemID").value = "";

                var element = document.getElementById("nameSuggestDIV");
                if (element.firstElementChild) {
                    element.removeChild(element.firstElementChild);
                }                    
                searchData(0);
            }

            function newClicked() {                    
                document.getElementById("btnNew").style.visibility = "hidden";
                document.getElementById("btnAdd").style.visibility = "visible";
                document.getElementById("btnUpdate").style.visibility = "hidden";
                document.getElementById("btnDelete").style.visibility = "hidden";

                $("#txtSoldItemName").prop('disabled', false);

                document.getElementById("topicText").innerHTML = "Buy and Sell Items";
                document.getElementById("topicBG").style.backgroundColor = "";
                clearAll();
            }
            
            searchData(0);
            function searchData(data) {
                $.ajax({
                    type: 'post',
                    url: 'controll/buySellController.php', 
                    data: {
                        txtSearch : 1,
                        searchData : data,
                    },
                    success: function (response) {
                        document.getElementById("dataBody").innerHTML = response;
                    }
                });
            }

            function modifySearchU(id){           
                clearAll();                 
                document.getElementById("btnNew").style.visibility = "visible";
                document.getElementById("btnAdd").style.visibility = "hidden";
                document.getElementById("btnUpdate").style.visibility = "visible";
                document.getElementById("btnDelete").style.visibility = "hidden";

                $("#buySellForm").find('input').each(function () {
                    $(this).attr('disabled', false);
                });
                $("#buySellForm").find('select').each(function () {
                    $(this).attr('disabled', false);
                });

                document.getElementById("topicText").innerHTML = "Update the Item";
                document.getElementById("topicBG").style.backgroundColor = "#ffb347";

                modifySearch(id);                             
            }
            function modifySearchD(id){
                clearAll();
                document.getElementById("btnNew").style.visibility = "visible";
                document.getElementById("btnAdd").style.visibility = "hidden";
                document.getElementById("btnUpdate").style.visibility = "hidden";
                document.getElementById("btnDelete").style.visibility = "visible";

                $("#buySellForm").find('input').each(function () {
                    $(this).attr('disabled', true);
                });
                $("#buySellForm").find('select').each(function () {
                    $(this).attr('disabled', true);
                });

                document.getElementById("topicText").innerHTML = "Delete the Item";
                document.getElementById("topicBG").style.backgroundColor = "#f69697";

                modifySearch(id); 
            }

            function modifySearch(id) {

                if (id || id == "0") {
                    $.ajax({
                        type: 'post',
                        url: 'controll/buySellController.php', 
                        data: {
                            idSearch : 1,
                            id : id,
                        },
                        success: function (response) {
                            if (response) {
                                var obj = JSON.parse(response);

                                document.getElementById("txtID").value = obj[0];
                                document.getElementById("txtSoldItemName").value = obj[1];
                                document.getElementById("txtSoldURL").value = obj[2];
                                var status;
                                if (obj[3] == 0) {
                                    status = "Fix";
                                }
                                else if (obj[3] == 1) {
                                    status = "Auction";
                                }
                                document.getElementById("txtSoldListedStatus").value = status;
                                document.getElementById("txtSoldListedQty").value = obj[4];
                                document.getElementById("txtSoldRemainQty").value = obj[5];
                                document.getElementById("txtSoldUnitCost").value = obj[6];
                                document.getElementById("txtSoldShippingCost").value = obj[7];
                                document.getElementById("txtSelingUnitCost").value = obj[8];
                                document.getElementById("txtSellingShippingCost").value = obj[9];
                                document.getElementById("txtSoldDate").valueAsDate = new Date(obj[10]);
                                document.getElementById("txtSoldQty").value = obj[11];
                                document.getElementById("txtEbayOrderID").value = obj[12];
                                document.getElementById("txtAliOrderID").value = obj[13];
                                document.getElementById("txtTrackingID").value = obj[14];
                                document.getElementById("txtCarrier").value = obj[15];
                                document.getElementById("txtPaypalCharge").value = obj[16];
                                document.getElementById("txtUSD_LKR_Rate").value = obj[17];

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

            function updateData(){
                var txtID = document.getElementById("txtID").value;
                var txtSoldDate = document.getElementById("txtSoldDate").value;
                var txtEbayOrderID = document.getElementById("txtEbayOrderID").value;
                var txtAliOrderID = document.getElementById("txtAliOrderID").value;
                var txtTrackingID = document.getElementById("txtTrackingID").value;
                var txtCarrier = document.getElementById("txtCarrier").value;
                var txtSoldQty = document.getElementById("txtSoldQty").value;
                var txtSelingUnitCost = document.getElementById("txtSelingUnitCost").value;
                var txtSellingShippingCost = document.getElementById("txtSellingShippingCost").value;
                var txtPaypalCharge = document.getElementById("txtPaypalCharge").value;
                var txtUSD_LKR_Rate = document.getElementById("txtUSD_LKR_Rate").value;

                var x = "1";
                if (txtSoldDate == "")
                {
                    x = "Sold Date feild is empty. Enter Product Sold Date."
                }
                else if (txtEbayOrderID == "") 
                {
                    x = "Ebay OrderID feild is empty. Enter Ebay OrderID."
                }
                else if (txtAliOrderID == "") 
                {
                    x = "Ali OrderID feild is empty. Enter Ali OrderID."
                }
                else if (txtTrackingID == "") 
                {
                    x = "Tracking ID feild is empty. Enter Tracking ID."
                }
                else if (txtCarrier == "") 
                {
                    x = "Carrier feild is empty. Enter Carrier)."
                }
                else if (txtSoldQty == "") 
                {
                    x = "Sold Qty feild is empty. Enter Sold Qty."
                }
                else if (txtSelingUnitCost == "" || txtSelingUnitCost<0) 
                {
                    txtSelingUnitCost = 0;
                    x = "Unit Seling Cost invalid. Enter valide Seling Unit Cost)."
                }
                else if (txtSellingShippingCost == "" || txtSellingShippingCost<0) 
                {
                    txtSellingShippingCost = 0;
                    x = "Shipping Cost invalid. Enter valide Shipping Cost)."
                }
                else if (txtPaypalCharge == "" || txtPaypalCharge < 0) 
                {
                    txtPaypalCharge = 0;
                    x = "Paypal Charge invalid. Enter valide Paypal Charge)."
                }
                else if (txtUSD_LKR_Rate == "" || txtUSD_LKR_Rate<0) 
                {
                    txtUSD_LKR_Rate = 1;
                    x = "USD_LKR_Rate invalid. Enter valid USD_LKR_Rate)."
                }
                if (x != 1) 
                {
                    alert(x);
                }
                if (x == "1") 
                {
                    $.ajax({
                        type: 'post',
                        url: 'controll/buySellController.php', 
                        data: {
                            btnUpdate : 1,
                            txtID : txtID,
                            txtSoldDate : txtSoldDate,
                            txtEbayOrderID : txtEbayOrderID,
                            txtAliOrderID : txtAliOrderID,
                            txtTrackingID : txtTrackingID,
                            txtCarrier : txtCarrier,
                            txtSoldQty : txtSoldQty,
                            txtSelingUnitCost : txtSelingUnitCost,
                            txtSellingShippingCost : txtSellingShippingCost,
                            txtPaypalCharge : txtPaypalCharge,
                            txtUSD_LKR_Rate : txtUSD_LKR_Rate,
                        },
                        success: function (response) {
                            if (response == "0") {
                                alert("Details updated Successfully.");
                                searchData(0);
                                clearAll();
                                $('html,body').scrollTop(1);
                            }
                            else{
                                alert(response);
                            }
                        }
                    });
                }
            }

            function deleteData() {
                var txtID = document.getElementById("txtID").value;
                var txtSoldItemName = document.getElementById("txtSoldItemName").value;
                var txtSoldQty = document.getElementById("txtSoldQty").value;
                var txtSoldDate = document.getElementById("txtSoldDate").value;

                if (confirm("You are trying to delete following selling record. \n         - Item Name : (" + txtSoldItemName +") \n         - Sold Qty     : (" + txtSoldQty +") \n         - Sold Date   : (" + txtSoldDate +") \n Are you sure to delete this record ?")) {

                    $.ajax({
                        type: 'post',
                        url: 'controll/buySellController.php', 
                        data: {
                            btnDelete : 1,
                            txtID : txtID,
                        },
                        success: function (response) {
                            if (response == "0") {
                                alert("\""+ txtSoldItemName + "\"" + " record deleted Successfully.");
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