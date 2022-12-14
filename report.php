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
    <title>Table - Brand</title>
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

                    <li class="nav-item" role="presentation"><a class="nav-link active" href="report.php"><i class="fas fa-table"></i><span>Report</span></a></li>

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


                    <!-- Stock Availability -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Stock Availability &nbsp;&nbsp;
                                <input type="button" class="btn btn-primary" style="border-radius: 20px;" onclick="callByID('stockSection', this)" value=" Show ">
                            </p>
                        </div>
                        <div class="card-body" id="stockSection" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 text-nowrap"></div>
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label>
                                        <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" onkeyup="stockSearch(this.value)">
                                    </label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Listed Qty</th>
                                            <th>Sold Qty</th>
                                            <th>Remain Qty</th>
                                            <th>Show More</th>
                                        </tr>
                                    </thead>
                                    <tbody id="stockBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Sales -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Daily Sales &nbsp;&nbsp;
                                <input type="button" class="btn btn-primary" style="border-radius: 20px;" onclick="callByID('dailySalesSection', this)" value=" Show ">
                            </p>
                        </div>
                        <div class="card-body" id="dailySalesSection" style="display: none;">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="txtListQty">
                                                    <strong>Items</strong>
                                                </label>
                                                <select class="form-control" id="slctAllNamesForDaily" name="slctAllNamesForDaily">
                                                    <!-- Will load all the names for daily sales -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    <strong> From </strong>
                                                </label>
                                                <input class="form-control" value='2022-01-01'  type="date" id="dailySalesFrom" name="dailySalesFrom">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    <strong> To </strong>
                                                </label>
                                                <input class="form-control" value='2022-01-01'  type="date" id="dailySaleTo" name="dailySaleTo">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    <strong>&nbsp;</strong>
                                                </label>
                                                <button class=" form-control btn btn-success" id="btnAdd" name="btnAdd" onclick="showDailySales()">Show&nbsp;</button>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    Note: All items without even a single sale will be shown as zero value under the current date.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="" id="chartContainerDailySales" style="height: 400px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Sales -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Monthly Sales &nbsp;&nbsp;
                                <input type="button" class="btn btn-primary" style="border-radius: 20px;" onclick="callByID('monthlySalesSection', this)" value=" Show ">
                            </p>
                        </div>
                        <div class="card-body" id="monthlySalesSection" style="display: none;">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="txtListQty">
                                                    <strong>Items</strong>
                                                </label>
                                                <select class="form-control" id="slctAllNamesForMonthly" name="slctAllNamesForMonthly">
                                                    <!-- Will load all the names for daily sales -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    <strong>From</strong>
                                                </label>
                                                <input class="form-control" value='2022-01-01'  type="date" id="MonthlySalesFrom" name="MonthlySalesFrom">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    <strong> To </strong>
                                                </label>
                                                <input class="form-control" value='2022-01-01'  type="date" id="MonthlySaleTo" name="MonthlySaleTo" >
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    <strong>&nbsp;</strong>
                                                </label>
                                                <button class=" form-control btn btn-success" id="btnAdd" name="btnAdd" onclick="showMonthlySales()">Show&nbsp;</button>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">                                      
                                                <label for="email">
                                                    Note: All items without even a single sale will be shown as zero value under the current date.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="" id="chartContainerMonthlySales" style="height: 400px; width: 100%;"></div>
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

        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>

        <script>
            function callByID(id, ele){
                var x = document.getElementById(id);            
                if (x.style.display == 'none') {
                    x.style.display = '';
                    $(ele).attr('value', " Hide ");
                }
                else{
                    x.style.display = 'none';
                    $(ele).attr('value', " Show ");
                    if (id == "dailySalesSection") {
                        document.getElementById("chartContainerDailySales").innerHTML="";
                    }
                }
            }

            stockSearch(1);
            function stockSearch(data){
                if (data == "") {
                    stockSearch(1);
                }
                else{
                    $.ajax({
                        type: 'post',
                        url: 'controll/ReportController.php', 
                        data: {
                            stockSearch : 1,
                            stockSearchTXT : data,
                        },
                        success: function (response) {
                            document.getElementById("stockBody").innerHTML = response;
                        }
                    });
                }
            } 

            function loadNamesToSales(){                
                $.ajax({
                    type: 'post',
                    url: 'controll/ReportController.php', 
                    data: {
                        loadNamesToSales : 1,
                    },
                    success: function (response) {
                        document.getElementById("slctAllNamesForDaily").innerHTML = response;
                        document.getElementById("slctAllNamesForMonthly").innerHTML = response;
                    }
                });
            }
            loadNamesToSales();


            function showDailySales() 
            {
                var From = document.getElementById("dailySalesFrom").value;
                var To = document.getElementById("dailySaleTo").value;
                var select = document.getElementById('slctAllNamesForDaily');
                var selectedItemID = select.options[select.selectedIndex].value;

                $.ajax({
                    type: 'post',
                    url: 'controll/ReportController.php', 
                    data: {
                        showDailySales : 1,
                        From : From,
                        To : To,
                        selectedItemID : selectedItemID,
                    },
                    success: function (response) 
                    {
                        if (response) {
                            console.log("Response arrived");

                            var arr = new Array;
                            var chartLocationID = "chartContainerDailySales";
                            var chartTopic = "Daily sales summery (from :" + From + " To :" + To + ")";
                            var xAxisTitle = "Date";
                            var yAxixTitle = "Qty";
                            var maxY = 0;
                            var XvalueFormat = "YYYY-MMM-D";
                            var intervelTypeX = "day";

                            obj = JSON.parse(response);
                            console.log(obj);
                            console.log("Len:" + obj.length);
                            for (var i = 0; i < obj.length; i++) {
                                var prdtnName = obj[i][0];
                                var newDataSet = new Array;

                                for (var j = 0; j < obj[i][1].length; j++) {

                                    var saleDate = obj[i][1][j][0];
                                    const dataXY = { x: 0, y: 0};
                                    dataXY.x = new Date(obj[i][1][j][0]);
                                    dataXY.y = parseInt(obj[i][1][j][1]);

                                    if (maxY < parseInt(obj[i][1][j][1])) {
                                        maxY += parseInt(obj[i][1][j][1]);
                                    }

                                    newDataSet.push(dataXY);

                                }
                                console.log(newDataSet);

                                arr.push(createDataSet(newDataSet, prdtnName));
                            }
                            console.log(arr);
                            if (maxY == 0) {
                                maxY = 2;
                            }
                            else{
                                maxY += 2;
                            }
                            viewTheChart(chartTopic, xAxisTitle, yAxixTitle, chartLocationID, arr, maxY, XvalueFormat, intervelTypeX);
                        }
                    }
                });
            }

            function showMonthlySales() 
            {
                var From = document.getElementById("MonthlySalesFrom").value;
                var To = document.getElementById("MonthlySaleTo").value;
                var select = document.getElementById('slctAllNamesForMonthly');
                var selectedItemID = select.options[select.selectedIndex].value;


                $.ajax({
                    type: 'post',
                    url: 'controll/ReportController.php', 
                    data: {
                        showMonthlySales : 1,
                        From : From,
                        To : To,
                        selectedItemID : selectedItemID,
                    },
                    success: function (response) 
                    {
                        if (response) {
                            console.log("Response arrived");

                            var arr = new Array;
                            var chartLocationID = "chartContainerMonthlySales";
                            var chartTopic = "Monthly sales summery (from :" + From + " To :" + To + ")";
                            var xAxisTitle = "Month";
                            var yAxixTitle = "Qty";
                            var maxY = 0;
                            var XvalueFormat = "YYYY-MMM";
                            var intervelTypeX = "month";


                            obj = JSON.parse(response);
                            console.log(obj);
                            console.log("Len:" + obj.length);
                            for (var i = 0; i < obj.length; i++) {
                                var prdtnName = obj[i][0];
                                var newDataSet = new Array;

                                for (var j = 0; j < obj[i][1].length; j++) {

                                    var saleDate = obj[i][1][j][0];
                                    const dataXY = { x: 0, y: 0};
                                    dataXY.x = new Date(obj[i][1][j][0]);
                                    dataXY.y = parseInt(obj[i][1][j][1]);

                                    if (maxY < parseInt(obj[i][1][j][1])) {
                                        maxY += parseInt(obj[i][1][j][1]);
                                    }

                                    newDataSet.push(dataXY);

                                }
                                console.log(newDataSet);

                                arr.push(createDataSet(newDataSet, prdtnName));
                            }
                            console.log(arr);
                            if (maxY == 0) {
                                maxY = 2;
                            }
                            else{
                                maxY += 2;
                            }
                            viewTheChart(chartTopic, xAxisTitle, yAxixTitle, chartLocationID, arr, maxY, XvalueFormat, intervelTypeX);
                        }
                    }
                });
            }


            function createDataSet(getData, Name){
                var j = {
                    type:"line",
                    axisYType: "primary",
                    name: Name,
                    showInLegend: true,
                    markerType: "circle",
                    markerSize: 10,
                    connectNullData: true,
                    xValueType: "number",
                    lineThickness: 3,
                    dataPoints: getData,                
                };
                return j;
            }

            function viewTheChart(chartTopic, xAxisTitle, yAxixTitle, chartLocationID, arr, maxY, XvalueFormat, intervelTypeX){

                var chartLocationID = chartLocationID;
                show();
                function show() {
                    var chart = new CanvasJS.Chart(chartLocationID, {
                        animationEnabled: true,
                        title: {
                            text: chartTopic
                        },
                        axisX: {
                            title: xAxisTitle,                      
                            valueFormatString: XvalueFormat,
                            interval:2,
                            intervalType: intervelTypeX
                        },
                        axisY: {
                            title: yAxixTitle,
                            maximum : maxY,
                            minimum: -1,
                            suffix: "",
                            includeZero: true
                        },
                        toolTip: {
                            shared: true
                        },
                        legend: {
                            cursor: "pointer",
                            verticalAlign: "bottom",
                            horizontalAlign: "center",
                            dockInsidePlotArea: false,
                        },
                        data:arr 
                    });
                    chart.render();
                }
            }
            function logout(){
                window.location.href = "index.php?logout=1";
            }

        </script>


        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="assets/js/theme.js"></script>
    </body>

    </html>