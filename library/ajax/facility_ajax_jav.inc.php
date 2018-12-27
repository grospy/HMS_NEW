<?php

?>
<script type="text/javascript">
function ajax_bill_loc(pid,date,facility){
top.restoreSession();
$.ajax({
type: "POST",
url: "../../../library/ajax/facility_ajax_code.php",
dataType: "html",
data: {
pid: pid,
date: date,
facility: facility
},
success: function(thedata){//alert(thedata)
$("#ajaxdiv").html(thedata);
},
error:function(){
}
});
return;

}
</script>
