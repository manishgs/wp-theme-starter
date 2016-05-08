<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

        <link rel="stylesheet" type="text/css" href="<?php echo theme_url('css/bootstrap.min.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo theme_url('css/font-awesome.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo theme_url('css/basic.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo theme_url('css/app.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo theme_url('css/responsive.css');?>">

    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 logo">
                <a href="<?php echo home_url(); ?>">Logo</a>
            </div>
            <div class="col-sm-6 pull-right col-md-8">
            <div class="social-links col-xs-12 col-sm-10">
                            <ul class="social-icons hidden-xs">
                                <li>
                            <a href="http://facebook.com" target="_blank"><i style="color:#45619D" class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="http://plus.google.com" target="_blank"><i style="color:#DD4E41" class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="http://twitter.com" target="_blank"><i style="color:#659FCB" class="fa fa-twitter"></i></a>
                                </li>
                                  <li>
                                    <a href="http://youtube.com" target="_blank"><i style="color:#CC181E" class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
            </div>
        </div>
    </div>
</header>
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
            <nav class="main-nav">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo home_url();?>">Home</a></li>
                    <li><a href="<?php echo site_url('about-us');?>">About Us</a></li>
                    <li><a href="<?php echo site_url('members');?>">Members</a></li>
                    <li><a href="<?php echo site_url('donate');?>">Donate</a></li>
                    <li><a href="<?php echo site_url('contact-us');?>">Contact us</a></li>
                </ul>
            </nav>
            <nav class="nav" role="navigation">
			     <?php get_wp_menu('Header Menu'); ?>
			</nav>
        </div>
    </div>
</div>
