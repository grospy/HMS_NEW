<?php

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title><?php $this->eprint($this->title); ?></title>
<meta content="width=device-width, initial-scale=1, user-scalable=no"	name="viewport">


<meta name="description" content="Patient Profile" />
<meta name="author" content="Form | sjpadgett@gmail.com" />

<script src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js" type="text/javascript"></script>
<link href="<?php echo $GLOBALS['assets_static_relative']; ?>/font-awesome-4-6-3/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.min.css"  rel="stylesheet" />
<?php if ($this->register) {?>
    <link href="<?php echo $GLOBALS['assets_static_relative']; ?>/bootstrap-3-3-4/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $GLOBALS['assets_static_relative']; ?>/bootstrap-3-3-4/dist/js/bootstrap.min.js" type="text/javascript"></script>
<?php } ?>

<link href="<?php echo $GLOBALS['web_root']; ?>/portal/patient/styles/style.css?v=<?php echo $GLOBALS['v_js_includes']; ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/moment-2-13-0/moment.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/underscore-1-8-3/underscore-min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/backbone-1-3-3/backbone-min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/app.js?v=<?php echo $GLOBALS['v_js_includes']; ?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/model.js?v=<?php echo $GLOBALS['v_js_includes']; ?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/view.js?v=<?php echo $GLOBALS['v_js_includes']; ?>"></script>
<base href="<?php $this->eprint($this->ROOT_URL); ?>" />
<script type="text/javascript" src="<?php echo $GLOBALS['web_root']; ?>/portal/patient/scripts/libs/LAB.min.js"></script>
<script type="text/javascript">
$LAB.setGlobalDefaults({BasePath: "<?php $this->eprint($this->ROOT_URL); ?>"});
</script>
</head>
<body>
