<?php



require_once("../globals.php");

use OpenEMR\Core\Header;
use OpenEMR\Services\VersionService;

?>
<html>
<head>

    <?php Header::setupHeader(["jquery-ui","jquery-ui-darkness"]); ?>
    <title><?php echo xl("About");?> Heart Guard</title>
    <style>
        .donations-needed {
            margin-top: 25px;
            margin-bottom: 25px;
            color: #c9302c;
        }
        .donations-needed a, .donations-needed a:visited,
        .donations-needed a:active {
            color: #c9302c;
        }
        .donations-needed a.btn {
            color: #c9302c;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            animation: all 2s;
        }
        .donations-needed a.btn:hover {
            background-color: #c9302c;
            color: #fff;
        }
        .donations-needed .btn {
            border-radius: 8px;
            border: 2px solid #c9302c;
            color: #c9302c;
            background-color: transparent;
        }
    </style>

    <script type="text/javascript">
        var registrationTranslations = <?php echo json_encode(array(
            'title' => xla('OpenEMR Product Registration'),
            'pleaseProvideValidEmail' => xla('Please provide a valid email address'),
            'success' => xla('Success'),
            'registeredSuccess' => xla('Your installation of our software has been registered'),
            'submit' => xla('Submit'),
            'noThanks' => xla('No Thanks'),
            'registeredEmail' => xla('Registered email'),
            'registeredId' => xla('Registered id'),
            'genericError' => xla('Error. Try again later'),
            'closeTooltip' => ''
        ));
        ?>;

        var registrationConstants = <?php echo json_encode(array(
            'webroot' => $GLOBALS['webroot']
        ))
        ?>;
    </script>

    <script type="text/javascript" src="<?php echo $webroot ?>/interface/product_registration/product_registration_service.js?v=<?php echo $v_js_includes; ?>"></script>
    <script type="text/javascript" src="<?php echo $webroot ?>/interface/product_registration/product_registration_controller.js?v=<?php echo $v_js_includes; ?>"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            var productRegistrationController = new ProductRegistrationController();
            productRegistrationController.getProductRegistrationStatus(function(err, data) {
                if (err) { return; }

                if (data.statusAsString === 'UNREGISTERED') {
                    productRegistrationController.showProductRegistrationModal();
                } else if (data.statusAsString === 'REGISTERED') {
                    productRegistrationController.displayRegistrationInformationIfDivExists(data);
                }
            });
        });
    </script>
</head>
<?php
$versionService = new VersionService();
$version = $versionService->fetch();
?>
<body class="body_top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4 text-center">
                <div class="page-header">
                    <h1><?php echo xlt("About");?>&nbsp;software</h1>
                </div>
                <h4>
                <?php  echo xlt('Version Number'); ?>: 
                <?php echo "v".text($openemr_version) ?></h4>
                <span class="text product-registration"><span class="email"></span> <span class="id"></span></span><br>
                <?php if (!empty($GLOBALS['support_phone_number'])) { ?>
                    <span class="text"><?php  echo xlt('Support Phone Number'); ?>: <?php echo $GLOBALS['support_phone_number'] ?></span><br>
                <?php } ?>
                <a href="<?php echo "http://www.shamilkarimli.tk_".attr($version->getMajor()).".".attr($version->getMinor()).".".attr($version->getPatch())."_Users_Guide"; ?>" target="_blank" class="btn btn-block btn-default">
                <i class="fa fa-fw fa-book"></i>&nbsp;
                <?php echo xlt('User Manual'); ?></a>

                    

                <a href="http://www.shamilkarimli.tk" target="_blank" class="btn btn-default btn-block"><i class="fa fa-fw fa-info-circle"></i><?php echo xlt('Acknowledgments, Licensing and Certification'); ?></a>
                <div class="donations-needed">
                    <span class="text"><?php echo xlt("Biz bu sistemi qayğı ilə sizin dünyanı daha sağlam etməniz üçün hazırlamışıq,"); ?> Heart Guard company:</span><br>
                    <a href="http://www.shamilkarimli.tk" target="_blank" class="btn btn-lg btn-block"><i class="fa fa-2x fa-heart"></i><br/><?php echo xlt("DONATE NOW!"); ?></a>
                </div>
            </div>
        </div>


    <div class="product-registration-modal" style="display: none">
        <p class="context"><?php echo xlt("Register your installation with OEMR to receive important notifications, such as security fixes and new release announcements."); ?></p>
        <input placeholder="<?php echo xlt('email'); ?>" type="email" class="email" style="width: 100%; color: black" />
        <p class="message" style="font-style: italic"></p>
    </div>
</body>
</html>
