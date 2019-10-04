<!DOCTYPE html>
<!-- saved from url=(0044)https://capitolmedical.helpdeskprojects.com/ -->
<html lang="en-US" >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <title>Online Result - Capitol Medical Center | Quezon Ave., Quezon City</title>
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
    <link rel="icon" href="/img/capitol/favicon-32x32.png" sizes="32x32">
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
                                    <a href="https://capitolmedical.helpdeskprojects.com/"><img src="/img/capitol/cmci-logo.png" alt="" data-no-retina=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 text-right hidden-xs">
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
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-color: #2a32c5; height: 20px;">
            </div>
        </header>
        <div id="main-content">
            <!-- #main (do not remove this comment) -->
            <?php if($this->Session->read('User.role') == 'ROLE_ADMIN'){?>
               <nav class="navbar navbar-default">
                 <div class="container-fluid">
                   <ul class="nav navbar-nav">
                     <li><a href="/admin/audit_logs/index">Audit Logs</a></li>
                     <li><a href="/admin/audit_logs/utilization">Utilization Report</a></li>
                     <li><a href="/admin/users/index">Users</a></li>
                   </ul>
                 </div>
               </nav>
            <?php } ?>
            <?php echo $this->Session->flash();?>
                <?php if($this->Session->read('User.isAuthorized')):?>
                    <div class="container" style="width: 100%; min-width: 320px;min-height: 100%;max-width: 1380px; padding: 20px 0px 0px 0px;">
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
                                <h2 class="page-title" itemprop="name">Online Laboratory Results</h2>
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    
                <?php endif;?>
            
            <!-- content -->
                 <?php echo $content_for_layout ?>
             <?php echo $this->element('change_password');?>
            <!-- /content -->
               <!-- / #main (do not remove this comment) -->
         </div>
        <footer class="wraper_footer style-eleven">
            <!-- <div class="wraper_footer_main">
                <div class="container">
                    <div class="row footer_main">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer_main_item matchHeight" style="height: 387px;">
                                <section id="custom_html-3" class="widget_text widget widget_custom_html">
                                    <div class="textwidget custom-html-widget"><img style="padding: 0 10% 10px 10%; width:75% !important; height:auto;" src="/img/capitol/footer-logo.png" border="0" alt="Capitol Medical Center, Inc." data-no-retina="">
                                        <br><strong>CAPITOL MEDICAL CENTER, INC.</strong>
                                        <br> Quezon Avenue Cor. Scout Magbanua
                                        <br>Street, Quezon City, Philippines, 1103
                                        <br>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer_main_item matchHeight" style="height: 387px;">
                                <section id="rpwe_widget-2" class="widget rpwe_widget recent-posts-extended">
                                    <h5 class="widget-title">Latest News</h5>
                                    <div class="rpwe-block ">
                                        <ul class="rpwe-ul">
                                            <li class="rpwe-li rpwe-clearfix">
                                                <a class="rpwe-img" href="https://capitolmedical.helpdeskprojects.com/latest-news/promos-and-packages/promo-sample-post/" rel="bookmark"><img class="rpwe-alignleft rpwe-thumb" src="/img/capitol/Successful-Cardiovascular-Surgery-at-CMC-75x75.png" alt="Promo Sample Post" data-no-retina=""></a>
                                                <h3 class="rpwe-title"><a href="https://capitolmedical.helpdeskprojects.com/latest-news/promos-and-packages/promo-sample-post/" title="Permalink to Promo Sample Post" rel="bookmark">Promo Sample Post</a></h3>
                                                <time class="rpwe-time published" datetime="2019-02-09T14:23:58+08:00">February 9, 2019</time>
                                            </li>
                                            <li class="rpwe-li rpwe-clearfix">
                                                <a class="rpwe-img" href="https://capitolmedical.helpdeskprojects.com/latest-news/articles-and-blogs/successful-cardiovascular-surgery-at-cmc/" rel="bookmark"><img class="rpwe-alignleft rpwe-thumb" src="/img/capitol/Successful-Cardiovascular-Surgery-at-CMC-75x75.png" alt="Successful Cardiovascular Surgery at CMC" data-no-retina=""></a>
                                                <h3 class="rpwe-title"><a href="https://capitolmedical.helpdeskprojects.com/latest-news/articles-and-blogs/successful-cardiovascular-surgery-at-cmc/" title="Permalink to Successful Cardiovascular Surgery at CMC" rel="bookmark">Successful Cardiovascular Surgery at CMC</a></h3>
                                                <time class="rpwe-time published" datetime="2019-01-09T14:15:57+08:00">January 9, 2019</time>
                                            </li>
                                        </ul>
                                    </div>
                                </section>
                                <section id="text-7" class="widget widget_text">
                                    <div class="textwidget">
                                        <p><strong>Learn More About</strong></p>
                                        <p>
                                            <a href="http://mtgracehospitals.com.ph/" target="_blank" rel="noopener noreferrer"><img title="Mount Grace Hospitals, Inc." src="/img/capitol/mgh-logo-colored.png" alt="Capitol Medical Center, Inc." width="50%" height="auto" border="0" data-no-retina=""></a>
                                        </p>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer_main_item matchHeight" style="height: 387px;">
                                <section id="text-10" class="widget widget_text">
                                    <div class="textwidget">
                                        <h5 class="widget-title" style="padding-left: 25% !important;">Main Menu</h5>
                                        <ul style="padding-left: 25% !important;">
                                            <li><a href="https://capitolmedical.helpdeskprojects.com/about-us">About Us</a></li>
                                            <li style="line-height: 35px !important;"><a href="https://capitolmedical.helpdeskprojects.com/services">Our Services</a></li>
                                            <li style="line-height: 35px !important;"><a href="https://capitolmedical.helpdeskprojects.com/find-a-doctor">Our Doctors</a></li>
                                            <li style="line-height: 35px !important;"><a href="https://capitolmedical.helpdeskprojects.com/patients/patients-guide">Patient’s Guide</a></li>
                                            <li style="line-height: 35px !important;"><a href="https://capitolmedical.helpdeskprojects.com/news">News, Promos &amp; Articles</a></li>
                                            <li style="line-height: 35px !important;"><a href="https://capitolmedical.helpdeskprojects.com/careers">Join Us</a></li>
                                            <li style="line-height: 35px !important;"><a href="https://capitolmedical.helpdeskprojects.com/contact-us">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer_main_item matchHeight" style="height: 387px;">
                                <section id="text-3" class="widget widget_text">
                                    <div class="textwidget">
                                        <h5 class="widget-title" style="padding-left: 15% !important;">Contact Us</h5>
                                        <div style="padding-left: 15% !important;">
                                            Capitol Medical Center, Inc.
                                            <br> Trunkline: <a href="te:(+632) 372-3825">(+632) 372-3825 to 44</a>
                                            <br> Fax No.: <a href="https://capitolmedical.helpdeskprojects.com/(+632)%20411-4320">(+632) 411-4320</a>
                                            <br> Email: <a href="mailto:info@capitolmedical.org">info@capitolmedical.org</a></div>
                                        <p></p>
                                        <div style="padding-left: 15% !important;">
                                            Capitol Medical Center
                                            <br> College of Nursing
                                            <br> No. 4 Sto. Domingo Avenue, Quezon City, Philippines 1100</div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="wraper_footer_copyright">
                <div class="container">
                    <div class="row footer_copyright">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="footer_copyright_item text-left">
                                <p>Copyright © 2019 - Capitol Medical Center, Inc.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="footer_copyright_item text-right">
                                <div class="menu-footer-menu-container">
                                    <ul id="menu-footer-menu" class="menu rt-mega-menu-transition-slide">
                                        <li id="menu-item-6054" class="menu-item menu-item-type-custom menu-item-object-custom menu-flyout rt-mega-menu-hover item-6054"><a href="https://capitolmedical.helpdeskprojects.com/#" data-ps2id-api="true">Terms &amp; Conditions</a></li>
                                        <li id="menu-item-8537" class="menu-item menu-item-type-post_type menu-item-object-page menu-flyout rt-mega-menu-hover item-8537"><a href="https://capitolmedical.helpdeskprojects.com/privacy-policy/" data-ps2id-api="true">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
   
    
</body>

</html>