<!DOCTYPE html>
<!-- saved from url=(0044)https://capitolmedical.helpdeskprojects.com/ -->
<html lang="en-US" >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <title>Online PF - Providence Hospital | Quezon Ave., Quezon City</title>
    <!-- CAPITOL JS -->
    <script src="/js/capitol/jquery.js.download" type="text/javascript"></script>
    <!-- DEFAULT JS -->
    <script src="/js/angular.min.js"></script>  
    <script src="/js/angular-resource.min.js"></script>  
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/angularjs/app.module.js"></script>
    <?php echo $this->Html->script('bootstrap.min.js')?>
    <!-- DEFAULT STYLE -->
    <link rel="stylesheet" type="text/css" href="/css/general.css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <?php echo $this->Html->css('bootstrap.min.css')?> 
    <!-- CAPITOL LAYOUT CSS -->
    <link type="text/css" media="all" href="/css/capitol/autoptimize_761b753ec93ff5ed77bc8a0c416a3b69.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/capitol/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- <link rel="icon" href="/img/capitol/favicon-32x32.png" sizes="32x32"> -->
    <link rel="stylesheet" href="/css/capitol/capitol_layout.css">
    
</head>

<body class="home page-template-default page page-id-7860 capitol-medical wpb-js-composer js-comp-ver-5.6 vc_responsive floating-searchbar-active cookies-set cookies-accepted" data-page-transition="0" data-header-style="header-style-twelve" data-nicescroll-cursorcolor="#ffbc13" data-nicescroll-cursorwidth="7px">
    <div class="radiantthemes-website-layout full-width">
        <header class="wraper_header style-twelve static-header">
            <div class="wraper_header_top">
                <div class="container">
                    <div class="row header_top">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-left">
                            <div class="header_top_item">
                                <div class="brand-logo">
                                    <a href="https://capitolmedical.helpdeskprojects.com/"><img src="/img/providence/PHI-logo-1.png" alt="" data-no-retina=""></a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 text-right hidden-xs">
                            <div class="header_top_item">
                                <ul class="contact">
                                    <li class="address hidden-sm">
                                        <div class="has-icon">
                                            <div class="icon"><i class="fa fa-map-marker"></i></div>
                                            <span style="font-size: 13px !important">Quezon Ave. corner, Scout Magbanua Street, <br>Brgy. Paligsahan, Quezon City, Philippines 1103</span></div>
                                    </li>
                                    <li class="timing hidden-sm">
                                        <div class="has-icon">
                                            <div class="icon"><i class="fa fa-clock-o"></i></div>
                                            <span style="font-size: 13px !important">Emergency Hotline 24/7 <br><a href="tel:(+632) 3723825">(+632) 372-3825 to 44</a></span></div>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <div style="background-color: #2a32c5; height: 20px;">
            </div> -->
        </header>
        <div id="main-content">
            
            <!-- <div class="col-sm-12 ">
                <h2 class="page-title" itemprop="name">Online Professional Fee</h2>
            </div> -->
            <div class="container">
                <?php if($this->Session->read('User.isAuthorized')):?>
                    <?php if($this->Session->read('User.role') == 'ROLE_ADMIN'){?>
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#adminNavBar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="#"></a>
                                </div>
                                <div class="collapse navbar-collapse" id="adminNavBar">
                                    <ul class="nav navbar-nav">
                                        <li><a href="/admin/users" class="active">Users</a></li>
                                        <li><a href="/admin/audit_logs">Audit Logs</a></li>
                                        <li><a href="/admin/configurations">Configurations</a></li>
                                        <li><a href="/admin/sms_templates">SMS Template</a></li>
                                        <li><a href="/admin/consultant_types">Consultant Role Types</a></li>
                                        <li><a href="/admin/hmo">Hmo</a></li>
                                        <li><a href="/admin/medical_packages">Medical Package</a></li>
                                        <li><a href="/admin/audit_logs/utilization">Utilization Report</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    <?php } ?>
                
                    <div class="row page-header" style="border-bottom: none; margin: 0px;" >
                        <div class="col-sm-8">
                            <span >
                                <!-- Name of user -->
                       <?php 
                          echo 'Welcome,'.' '.$_SESSION['User']['name'];
                       ?>
                            </span>
                        </div>
                        
                        <div class="col-md-4" style="text-align: right;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a id="change-password" class="btn btn-sm btn-default"><span class="glyphicon glyphicon glyphicon-edit"></span> Change Password</a>
                      <a href="/Users/signout" id="signout" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </div>
                    
                            <!-- <a id="change-password" href="#">CHANGE PASSWORD <span class="glyphicon glyphicon glyphicon-edit"></span></a> -->
                        </div>
                        <div class="col-sm-12 ">
                            <h2 class="page-title" itemprop="name">Online Professional Fee</h2>
                            &nbsp;
                        </div>
                    </div>
                <?php endif;?>
                <!-- content -->
                <?php echo $this->Session->flash();?>
                <?php echo $content_for_layout ?>
                <?php echo $this->element('change_password');?>
                <!-- /content -->
            </div>
         </div>
        
        <div class="footer-basic">
            <footer>
               <!--  <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Home</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">About</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                </ul> -->
                <p class="copyright">Providence Hospital Inc. © 2019</p>
            </footer>
        </div>
    </div>
   
    
</body>

</html>