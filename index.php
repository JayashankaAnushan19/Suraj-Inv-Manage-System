<!DOCTYPE html>
<html>
<?php 
if (isset($_GET['logout'])) {
   if ($_GET['logout'] == 1) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    ?>
    <script type="text/javascript">
        window.location.replace("index.php");
    </script>
    <?php
}
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

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/dogs/image3.jpeg&quot;);"></div>
                            </div>
                            
                            <div class="col-lg-6"><br><br>
                                <div class="p-5"><br>
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="txtInputEmail" placeholder="Enter User Name..." name="txtInputEmail"></div>
                                        
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="txtInputPassword" placeholder="Password" name="txtInputPassword"></div>
                                        

                                    </form>
                                    <button id="btnLog" class="btn btn-primary btn-block text-white btn-user" type="button" onclick="checkLogin();">Login</button>
                                    <hr>
                                    <div class="text-center">
                                        <div class="small">
                                            Developed by JMax Solution.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function checkLogin(){
            var UName = document.getElementById("txtInputEmail").value;
            var Password = document.getElementById("txtInputPassword").value;            

            if (UName == "" ) {
                alert("Enter valid User name.");
            }
            else if (Password == "") {
                alert("Enter valid Password.");
            }
            else {
                $.ajax({
                    type: 'post',
                    url: 'controll/loginController.php', 
                    data: {
                        loginCheck : 1,
                        UName : UName,
                        Password : Password,
                    }, 
                    success: function (response) 
                    {
                        if (response) {
                            // alert(response);
                            if (response == 1) {
                                window.location.href = "main.php";
                            }
                            else{
                                // alert(response);
                                alert("Invalid user name or password. Please enter valid user name and password.");
                            }
                        }
                        else{
                            alert("Connection Error. Please check the connect and try again.");
                        }
                    }
                });
            }
        }

        var input = document.getElementById("txtInputPassword");
        input.addEventListener("keypress", function(event) {
          if (event.key === "Enter") 
          {
            event.preventDefault();
            document.getElementById("btnLog").click();
            }
        });
</script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>
</body>

</html>