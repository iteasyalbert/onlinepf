<!DOCTYPE html>
<html lang="en-US" >
<head>
    <meta content="charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online PF - Providence Hospital | Quezon Ave., Quezon City</title>
    <!-- ADDED JS AND CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/providence/jquery-1.11.2.min.js"></script>
    <script src="/js/providence/modernizr.min.js"></script>
    <script src="/js/providence/bootstrap.min.js"></script>

    
    <!-- CUSTOM JS -->
    <script src="/js/providence/accordion_table.js"></script>

    <!-- DEFAULT JS -->
    <script src="/js/angular.min.js"></script>  
    <script src="/js/angular-resource.min.js"></script>  
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/angularjs/app.module.js"></script>
    <link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
    <script type='text/javascript' src='/js/loading-bar.min.js'></script>

    <!-- DEFAULT STYLE -->
    <link rel="stylesheet" type="text/css" href="/css/general.css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    
    <link rel="icon" href="http://providencehospital.com.ph/wp-content/uploads/2018/02/cropped-cropped-PHI-ICON-32x32.png" sizes="32x32">
    <link rel="icon" href="http://providencehospital.com.ph/wp-content/uploads/2018/02/cropped-cropped-PHI-ICON-192x192.png" sizes="192x192">
</head>

<body >
    <div class="container">
        <div id="main-content">
            <?php if($this->Session->read('User.isAuthorized')):?>
                <nav class="navbar navbar-expand-sm navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">PROVIDENCE ONLINE PF</a>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                            </button>
                        </div>
                        <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                            <ul class="nav navbar-nav navbar-left"> 
                                <li class="nav-item">
                                    <a> <?php echo 'Welcome, '.$_SESSION['User']['name']; ?></a>
                                </li>
                                <li>
                                    <a href="/physicians/dashboard"><span class="glyphicon glyphicon-user"></span> My Patients</a>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-lock"></span> Account<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" id="change-password"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li>
                                        <li><a href="/Users/signout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            <?php endif;?>

            <?php echo $content_for_layout ?>
        </div>
    </div>
  
   <!-- Footer -->
</body>
    <footer class="fixed-bottom"> 
        <div class="container-fluid">
            <center>
                <span class="text-muted">
                © 2019 Copyright <a href="http://providencehospital.com.ph/"> Providence Hospital</a>
                </span> 
            </center>
        </div> 
     </footer>
  <!-- <div class="footer navbar-fixed-bottom font-small blue" style="background-color: #222; color: white;">
    <div class="footer-copyright text-center py-3">© 2019 Copyright
      <a href="https://www.providencehospital.com.ph"> Providence Hospital</a>
    </div>
  </div> -->

</html>