<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
</div>
<?php echo form_open(); ?>
<?php echo form_close(); ?>
<?php $nu=$da='';
$nu=$this->session->flashdata('mesajNU');
$da=$this->session->flashdata('mesajDA');
if($nu!='' || $da!=''){ ?>
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content <?php if($nu!=''){ echo 'mesajNU'; }else{ echo 'mesajDA'; } ?>">
	     <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Mesaj informativ</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <?php if($nu!=''){ 
	       		echo $nu; 
	       }else{ 
	       		echo $da; 
	       	} ?>
	      </div>
	    </div>
	  </div>
	</div>
	<script>$('#modal').modal('show');</script>
<?php } ?>
<script>
	$('.jedit').each( function() {
	    var dt = $(this).attr('data');
	    var crsf=$("input[name='csrfcc']").val();
	    $(this).editable('/ajax/',{
			submitdata: {ajax:1,op:'jedit',ce:dt,'csrfcc': crsf},
			cancel    : 'X',
        	submit    : 'OK'
		});
	});
	$('.jeditSel').each( function() { // de modificat data-load dupa selectie
	    var dt = $(this).attr('data');
	    var ld = '';
	    var crsf=$("input[name='csrfcc']").val();
		$.ajaxSetup({async:false});
		$.post("/ajax/"+$(this).attr('data-load'),{ajax:1,'csrfcc': crsf}, function(result){
			ld = result;
		});
	    console.log(ld);
	    var crsf=$("input[name='csrfcc']").val();
	    $(this).editable('/ajax',{
			submitdata: {ajax:1,op:'jedit',ce:dt,extra:ld,'csrfcc': crsf},
        	type	  : 'select',
        	data      : ld
		});
	});
	$('.jeditTxt').each( function() {
	    var dt = $(this).attr('data');
	    var crsf=$("input[name='csrfcc']").val();
	    $(this).editable('/ajax',{
	    	type: 'textarea',
			submitdata: {ajax:1,op:'jedit',ce:dt,'csrfcc': crsf},
			cancel    : 'X',
        	submit    : 'OK'
		});
	});
	$('.jeditDt').each( function() {
	    var dt = $(this).attr('data');
	    var crsf=$("input[name='csrfcc']").val();
	    $(this).editable('/ajax',{
	    	type: 'datepicker',
			submitdata: {ajax:1,op:'jedit',ce:dt,'csrfcc': crsf},
			cancel    : 'X',
        	submit    : 'OK'
		});
	});

	//jeditSel
</script>
</body>
</html>