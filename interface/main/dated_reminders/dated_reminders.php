<?php


// removed as jquery is already called in messages page (if you need to use jQuery, uncomment it futher down)
require_once('../../globals.php');
require_once("$srcdir/dated_reminder_functions.php");

        $days_to_show = 5;
        $alerts_to_show = $GLOBALS['dated_reminders_max_alerts_to_show'];
        $updateDelay = 60; // time is seconds


// ----- get time stamp for start of today, this is used to check for due and overdue reminders
        $today = strtotime(date('Y/m/d'));

 // ----- set $hasAlerts to false, this is used for auto-hiding reminders if there are no due or overdue reminders
        $hasAlerts = false;

// mulitply $updateDelay by 1000 to get miliseconds
        $updateDelay = $updateDelay * 1000;

//-----------------------------------------------------------------------------
// HANDEL AJAX TO MARK REMINDERS AS READ
// Javascript will send a post
// ----------------------------------------------------------------------------
if (isset($_POST['drR'])) {
    // set as processed
    setReminderAsProcessed($_POST['drR']);
    // ----- get updated data
    $reminders = RemindersArray($days_to_show, $today, $alerts_to_show);
    // ----- echo for ajax to use
    echo getRemindersHTML($reminders, $today);
    // stop any other output
    exit;
}

//-----------------------------------------------------------------------------
// END HANDEL AJAX TO MARK REMINDERS AS READ
// ----------------------------------------------------------------------------

      $reminders = RemindersArray($days_to_show, $today, $alerts_to_show);

        ?>

      <style type="text/css">
         div.dr{
           margin:0;
           font-size:0.6em;
         }
         .dr_container a{
           font-size:0.8em;
         }
         .dr_container{
           padding:5px 5px 8px 5px;
         }
         .dr_container p{
           margin:6px 0 0 0;
         }
         .patLink{
           font-weight: bolder;
           cursor:pointer;
           text-decoration: none;
         }
         .patLink:hover{
           font-weight: bolder;
           cursor:pointer;
           text-decoration: underline;
         }
      </style>
      <script type="text/javascript">
         $(document).ready(function (){
            <?php if (!$hasAlerts) {
                echo '$(".hideDR").html("<span>'.xla('Show Reminders').'</span>"); $(".drHide").hide();';
} ?>
            $(".hideDR").click(function(){
              if($(this).html() == "<span><?php echo xla('Hide Reminders') ?></span>"){
                $(this).html("<span><?php echo xla('Show Reminders') ?></span>");
                $(".drHide").slideUp("slow");
              }
              else{
                $(this).html("<span><?php echo xla('Hide Reminders') ?></span>");
                $(".drHide").slideDown("slow");
              }
            })
           // run updater after 30 seconds
           var updater = setTimeout("updateme(0)", 1);
         })

           function openAddScreen(id){
             if(id == 0){
               top.restoreSession();
               dlgopen('<?php echo $GLOBALS['webroot']; ?>/interface/main/dated_reminders/dated_reminders_add.php', '_drAdd', 700, 500);
             }else{
               top.restoreSession();
               dlgopen('<?php echo $GLOBALS['webroot']; ?>/interface/main/dated_reminders/dated_reminders_add.php?mID='+id, '_drAdd', 700, 500);
             }
           }

           function updateme(id){
             refreshInterval = <?php echo $updateDelay ?>;
             if(id > 0){
              $(".drTD").html('<p style="text-size:3em; margin-left:200px; color:black; font-weight:bold;"><?php echo xla("Processing") ?>...</p>');
             }
             if(id == 'new'){
              $(".drTD").html('<p style="text-size:3em; margin-left:200px; color:black; font-weight:bold;"><?php echo xla("Processing") ?>...</p>');
             }
             top.restoreSession();
             // Send the skip_timeout_reset parameter to not count this as a manual entry in the
             //  timing out mechanism in OpenEMR.
             $.post("<?php echo $GLOBALS['webroot']; ?>/interface/main/dated_reminders/dated_reminders.php",
               { drR: id, skip_timeout_reset: "1" },
               function(data) {
                if(data == 'error'){
                  alert("<?php echo addslashes(xl('Error Removing Message')) ?>");
                }else{
                  if(id > 0){
                    $(".drTD").html('<p style="text-size:3em; margin-left:200px; color:black; font-weight:bold;"><?php echo xla("Refreshing Reminders") ?> ...</p>');
                  }
                  $(".drTD").html(data);
                }
              // run updater every refreshInterval seconds
              var repeater = setTimeout("updateme(0)", refreshInterval);
             });
           }

            function openLogScreen(){
               top.restoreSession();
               dlgopen('<?php echo $GLOBALS['webroot']; ?>/interface/main/dated_reminders/dated_reminders_log.php', '_drLog', 700, 500);
            }


            function goPid(pid) {
              top.restoreSession();
                <?php
                  echo "  top.RTop.location = '../../patient_file/summary/demographics.php' " .
                  "+ '?set_pid=' + pid;\n";
                ?>
}
      </script>

        <?php
          // initialize html string
          $pdHTML = '<div class="dr_container"><table><tr><td valign="top">
                        <p><a class="hideDR css_button_small btn" href="#"><span>'.xlt('Hide Reminders').'</span></a><br /></p>
                        <div class="drHide">'.
                        '<p><a title="'.xla('View Past and Future Reminders').'" onclick="openLogScreen()" class="css_button_small btn" href="#"><span>'.xlt('View Log').'</span></a><br /></p>'
                        .'<p><a onclick="openAddScreen(0)" class="css_button_small btn" href="#"><span>'.xlt('Send A Dated Reminder').'</span></a></p></div>
                        </td><td class="drHide drTD">';

          $pdHTML .= getRemindersHTML($reminders, $today);
          $pdHTML .= '</td></tr></table></div>';
          // print output
          echo $pdHTML;
        ?>