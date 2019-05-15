<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Zona de edición</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo assets_url('css/bootstrap.css'); ?>" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="<?php echo assets_url('fonts/main.css'); ?>" rel='stylesheet' type='text/css'>
    <link href="<?php echo assets_url('css/style.css'); ?>" rel='stylesheet' type='text/css' />
    <script src="<?php echo assets_url('js/jquery-1.11.1.min.js'); ?>"></script>
    <script src="<?php echo assets_url('js/bootstrap.min.js'); ?>"></script>
</head>
<body>

<div class="technology">
    <div class="container">
        <div class="col-md-12">
            <div class="contact-section">
                <h2 class="w3">ZONA DE EDICIÓN</h2>
                <div class="contact-grids">
                    <div class="col-md-12 contact-grid" >
                        <?php if (isset($login_failed) && $login_failed == TRUE)
                        {
                            echo "<h3><strong>Bad credentials</strong></h3>";
                        }
                        ?>
                        <p><strong>Escriba sus credenciales de editor del Blog</strong></p>
                        <form action="<?php echo site_url('site/login_action'); ?>" method="post">
                            <input type="email" name="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                            <input type="password" name="password" value="12345" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                            <input type="submit" value="Iniciar sesión">
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

</body>
</html>