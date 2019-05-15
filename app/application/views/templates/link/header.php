<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- HTML META TAGS -->
    <meta property="fb:app_id" content="1729790310650565"/>
    <meta property="language" content="spanish" />
    <meta property="article:publisher" content="https://www.facebook.com/NotiFreshCom" />
    <meta name="title" content="<?php echo $title; ?>" />

	<link rel="canonical" href="<?php echo $og_url; ?>">
	<meta property="og:url" content="<?php echo $og_url; ?>" />

    <meta name="description" content="<?php echo $og_description; ?>" />

    <meta property="og:title" content='<?php echo $title; ?>' />
    <meta property="og:type" content="website" />

    <meta property="og:description" content='<?php echo $og_description; ?>' />
    <meta property="og:image" content="<?php echo $og_image; ?>" />

     <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106542506-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-106542506-1');
    </script>

    <!-- Default Statcounter code for NotiFresh.com https://www.notifresh.com -->
    <script type="text/javascript">
    var sc_project=11999705;
    var sc_invisible=1;
    var sc_security="e4b7b36d";
    var sc_https=1;
    </script>
    <script type="text/javascript"
    src="https://www.statcounter.com/counter/counter.js" async></script>
    <noscript><div class="statcounter"><a title="Web Analytics"
    href="https://statcounter.com/" target="_blank"><img class="statcounter"
    src="https://c.statcounter.com/11999705/0/e4b7b36d/1/" alt="Web
    Analytics"></a></div></noscript>
    <!-- End of Statcounter Code -->

    <!-- domain verifications -->
    <meta name="yandex-verification" content="a6ee87a72b0e462e" />
    <meta name="msvalidate.01" content="4806DD58CCF6A59780F1E6412A4D283B" />

    <!-- favicon -->
    <link rel="icon" type="image/png" href="<?php echo assets_url('images/favicon.png'); ?>" />

    <!-- CSS -->
	<link href="<?php echo assets_url('css/bootstrap.min.css'); ?>" rel='stylesheet' type='text/css' />
	<link href="<?php echo assets_url('fonts/main.css'); ?>" rel='stylesheet' type='text/css'>
	<link href="<?php echo assets_url('css/style.css'); ?>" rel='stylesheet' type='text/css' />

    <script src="<?php echo assets_url('js/jquery-1.11.1.min.js'); ?>"></script>
</head>
<body onload="init_counter()">

<div class="header" id="ban">

    <div class="container">
        <div class="header_right <?php if ($active == 'index') { ?> <?php } ?>" style="visibility: visible;">
            <nav class="navbar navbar-default">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                    <nav class="link-effect-7" id="link-effect-7">
                        <ul class="nav navbar-nav">
                            <?php if (!isset($active)) {
                                $active = "";
                            } ?>
                            <li <?php if ($active == 'index') {
                                echo 'class="active act"';
                            } ?>><a href="<?php echo site_url('site/index'); ?>">Principal</a></li>
                            <li <?php if ($active == 'science') {
                                echo 'class="active act"';
                            } ?>><a href="<?php echo site_url('site/science'); ?>">Ciencia</a></li>
                            <li <?php if ($active == 'curiosity') {
                                echo 'class="active act"';
                            } ?>><a href="<?php echo site_url('site/curiosity'); ?>">Curiosidades</a></li>
                            <li <?php if ($active == 'health') {
                                echo 'class="active act"';
                            } ?>><a href="<?php echo site_url('site/health'); ?>">Salud</a></li>
                            <li <?php if ($active == 'videos') {
                                echo 'class="active act"';
                            } ?>><a href="<?php echo site_url('site/videos'); ?>">Videos</a></li>
                            <li <?php if ($active == 'tech') {
                                echo 'class="active act"';
                            } ?>><a href="<?php echo site_url('site/tech'); ?>">Tecnología</a></li>
                            <li <?php if ($active == 'unusual') {
                                echo 'class="active act"';
                            } ?>><a href="<?php echo site_url('site/unusual'); ?>">Insólito</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
        <div class="nav navbar-nav navbar-right social-icons">
            <a href="https://www.notifresh.com"><img class="logo2" src="<?php echo assets_url('images/logo.png'); ?>"></a>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
