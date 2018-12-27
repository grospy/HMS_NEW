<?php

?>
    i18n:{
        en: {
            months: [
                "<?php echo xla('January'); ?>", "<?php echo xla('February'); ?>", "<?php echo xla('March'); ?>", "<?php echo xla('April'); ?>", "<?php echo xla('May'); ?>", "<?php echo xla('June'); ?>", "<?php echo xla('July'); ?>", "<?php echo xla('August'); ?>", "<?php echo xla('September'); ?>", "<?php echo xla('October'); ?>", "<?php echo xla('November'); ?>", "<?php echo xla('December'); ?>"
            ],
            dayOfWeekShort: [
                "<?php echo xla('Sun'); ?>", "<?php echo xla('Mon'); ?>", "<?php echo xla('Tue'); ?>", "<?php echo xla('Wed'); ?>", "<?php echo xla('Thu'); ?>", "<?php echo xla('Fri'); ?>", "<?php echo xla('Sat'); ?>"
            ],
            dayOfWeek: ["<?php echo xla('Sunday'); ?>", "<?php echo xla('Monday'); ?>", "<?php echo xla('Tuesday'); ?>", "<?php echo xla('Wednesday'); ?>", "<?php echo xla('Thursday'); ?>", "<?php echo xla('Friday'); ?>", "<?php echo xla('Saturday'); ?>"
            ]
        },
    },
    <?php if ($_SESSION['language_direction'] == 'rtl') { ?>
    /**
     * In RTL languages a datepicker popup is opened in left and it's cutted by the edge of the window
     * This patch resolves that and moves a datepicker popup to right side.
     */
    onGenerate:function(current_time,$input){
        //position of input
        var position = $($input).offset()
        //width of date picke popup
        var datepickerPopupWidth = $('.xdsoft_datetimepicker').width();

        if(position.left < datepickerPopupWidth){
            $('.xdsoft_datetimepicker').offset({left:position.left});
        } else {
            //put a popup in the regular position
            $('.xdsoft_datetimepicker').offset({left:position.left - datepickerPopupWidth + $($input).innerWidth()});
        }
    },
    <?php } ?>
    yearStart: '1900',
    scrollInput: false,
    scrollMonth: false,
    rtl: <?php echo ($_SESSION['language_direction'] == 'rtl') ? "true" : "false"; ?>,
    <?php if ($datetimepicker_timepicker) { ?>
        <?php if ($datetimepicker_showseconds) { ?>
            <?php if ($datetimepicker_formatInput) { ?>
                format: '<?php echo DateFormatRead("jquery-datetimepicker"); ?> H:i:s',
            <?php } else { ?>
                format: 'Y-m-d H:i:s',
            <?php } ?>
        <?php } else { ?>
            <?php if ($datetimepicker_formatInput) { ?>
                format: '<?php echo DateFormatRead("jquery-datetimepicker"); ?> H:i',
            <?php } else { ?>
                format: 'Y-m-d H:i',
            <?php } ?>
        <?php } ?>
        timepicker:true,
        step: '30'
    <?php } else { ?>
        <?php if ($datetimepicker_formatInput) { ?>
            format: '<?php echo DateFormatRead("jquery-datetimepicker"); ?>',
        <?php } else { ?>
            format: 'Y-m-d',
        <?php } ?>
        timepicker:false
    <?php } ?>
