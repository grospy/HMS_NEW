<?php

?>
<div id='esign-signature-log-<?php echo attr($this->logId); ?>' class='esign-signature-log-container'>
    <div class="esign-signature-log-table">
    
        <div class="body_title esign-log-row header"><?php echo xlt('eSign Log'); ?></div>
        
        <?php if (!$this->verified) { ?>
        <div class="esign-log-row">
            <div style='text-align:center;color:red;'><?php echo xlt('The data integrity test failed for this form'); ?></div>
        </div>
        <?php } ?>
        
        <?php foreach ($this->signatures as $count => $signature) { ?>
        <div class="esign-log-row esign-log-row-container <?php echo text($signature->getClass()); ?>">
            
            <?php if ($signature->getAmendment()) { ?>
            <div class="esign-log-row">
                <span class="esign-amendment"><?php echo text($signature->getAmendment()); ?></span>
            </div>
            <?php } ?>
            
            <div class="esign-log-row">
                <div class="esign-log-element span3"><span><?php echo text($signature->getFirstName()); ?></span></div> 
                <div class="esign-log-element span3"><span><?php echo text($signature->getLastName()); ?></span></div> 
                <div class="esign-log-element span3"><span><?php echo text($signature->getDatetime()); ?></span></div>
            </div>

        </div>
        <?php } ?>
        
        <?php if (count($this->signatures) === 0) { ?>
        <div class="esign-log-row">
            <span><?php echo xlt('No signatures on file'); ?></span>
        </div>
        <?php } ?>

    </div>
</div>
