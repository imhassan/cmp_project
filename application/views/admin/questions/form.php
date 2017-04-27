<!-- form start -->
<form role="form" method="post" action="">
	<div class="box-body">
		<div class="col-sm-12"><button type="button" id="add_opt_btn" class="btn btn-success">Add New
					Option</button></div>
		<div class="form-group">
			<div class="col-sm-12"><h3 style="visibility:visible;">Title</h3></div> <div class="col-sm-12 col-md-6"><input type="text" class="form-control"
							name="question_text" id="question_text" placeholder="Question"
							required
							value="<?php printkey($post_data['question'],'question_text');?>"></div>
		</div>
		<div class="form-group" id="options_div">
		
<?php
$count = 0;
foreach($post_data ['options'] as $option){
	$count++;
	
	echo '<div id="option_div_' . $option ['id'] . '"><div class="col-sm-12"><h4>Option#' . $count . '</h4></div>';
	?>
	<div class="col-md-6 col-sm-8"><input type="text" class="form-control"
							name="options[<?php echo $option['id']?>]" placeholder="Question"
							required value="<?php printkey($option,'option_text');?>"> <br /></div>
	<div class="col-md-6 col-sm-4" style="line-height:29px;"><span  style="cursor: pointer;" class="deleteOpt glyphicon glyphicon-trash"
					opt_id='<?php echo $option['id']?>'></span>
				<label style="margin-left:20px;"> <input style="margin-right: 5px;" type="radio" name="is_correct_radio" <?php if($option['id'] == $post_data['question']['correct_option_id']){echo "checked='checked'"; }?>
					value="<?php echo $option['id']?>" /> Is Correct?</label></div>
			
		</div>
<?php
}
?>

</div>
	</div>
	<!-- /.box-body -->

	<div class="box-footer">
		<div class="col-sm-12"><button type="submit" class="btn btn-success">Submit</button></div>
	</div>
	
<?php

if(isset($post_data ['id'])){
	echo "<input type='hidden' name='id' value='" . $post_data ['id'] . "' / >";
}
?>

</form>

<script>
function deleteLocalOption(ref){
	$(ref).parent().parent().remove();
}
var option_counter = 1;
$(document).ready(function(){
	$('#add_opt_btn').click(function(){
		var 
		input = '<div class="option_wrapper"><div class="col-sm-12"><h4>New Option</h4></div> <div class="col-sm-8 col-md-6"><input type="text" class="form-control" name="new_options[new_'+option_counter+']" placeholder="Option Text" ></div>';		
		input +=	'<div class="col-sm-4 col-md-6" style="line-height:29px;"><span onclick="deleteLocalOption(this)" type="button" class="deleteOptLocal glyphicon glyphicon-trash" style="cursor: pointer;"></span>';
		input +='<label style="margin-left:20px;"><input style="margin-right: 5px;" type="radio" name="is_correct_radio"  value="new_'+option_counter+'" /> Is Correct?</label></div> </div>';
		$('#options_div').append(input);		
		option_counter++;
	});


	$('.deleteOpt').click(function(){
		//alert($(this).attr('opt_id'));
		var input = '<input type="hidden"  name="delete_options[]"  value="'+$(this).attr('opt_id')+'">';
		$('#options_div').append(input);

		$('#option_div_'+$(this).attr('opt_id')).remove();
	});


});
</script>

