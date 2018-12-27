<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title><?php $this->eprint($this->title); ?></title>
        <meta content="width=device-width, initial-scale=1, user-scalable=yes" name="viewport">

        <meta name="description" content="Provider Portal" />
        <meta name="author" content="Dashboard | sjpadgett@gmail.com" />

        <!-- Styles -->
        <link href="<?php echo $GLOBALS['assets_static_relative']; ?>/bootstrap-3-3-4/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <?php if ($_SESSION['language_direction'] == 'rtl') { ?>
            <link href="<?php echo $GLOBALS['assets_static_relative']; ?>/bootstrap-rtl-3-3-4/dist/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <?php } ?>

        <link href="<?php echo $GLOBALS['web_root']; ?>/portal/patient/styles/style.css?v=<?php echo $GLOBALS['v_js_includes']; ?>" rel="stylesheet" />
        <link href="<?php echo $GLOBALS['assets_static_relative']; ?>/font-awesome-4-6-3/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo $GLOBALS['web_root']; ?>/portal/sign/css/signer.css?v=<?php echo $GLOBALS['v_js_includes']; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $GLOBALS['web_root']; ?>/portal/sign/assets/signpad.css?v=<?php echo $GLOBALS['v_js_includes']; ?>" rel="stylesheet">

        <script type="text/javascript" src="<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/libs/LAB.min.js"></script>
        <script type="text/javascript">

            $LAB.script("<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-1-11-3/index.js")
                //.script("../sign/assets/signpad.js")
                .script("<?php echo $GLOBALS['web_root']; ?>/portal/sign/assets/signer.js?v=<?php echo $GLOBALS['v_js_includes']; ?>")
                .script("<?php echo $GLOBALS['assets_static_relative']; ?>/bootstrap-3-3-4/dist/js/bootstrap.min.js")
                .script("<?php echo $GLOBALS['assets_static_relative']; ?>/underscore-1-8-3/underscore-min.js")
                .script("<?php echo $GLOBALS['assets_static_relative']; ?>/moment-2-13-0/moment.js")
                .script("<?php echo $GLOBALS['assets_static_relative']; ?>/backbone-1-3-3/backbone-min.js")
                .script("<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/app.js?v=<?php echo $GLOBALS['v_js_includes']; ?>")
                .script("<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/model.js?v=<?php echo $GLOBALS['v_js_includes']; ?>").wait()
                .script("<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/view.js?v=<?php echo $GLOBALS['v_js_includes']; ?>").wait()
        </script>
    </head>

    <body class="skin-blue">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                    <div class="navbar-header"><a class="navbar-brand" href="<?php echo $GLOBALS['web_root']; ?>/portal/patient/provider"><?php echo xlt('Home'); ?></a>
                        <a class="navbar-toggle btn-default" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="glyphicon glyphicon-bar"></span>
                            <span class="glyphicon glyphicon-bar"></span>
                            <span class="glyphicon glyphicon-bar"></span>
                        </a>
                        </div>
                        <div class="container">
                        <div class="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <!-- Reserved -->
                                </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </div>
