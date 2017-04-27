<?php
$messages = $this->session->flashdata('validate');
if($messages){
	?>
<div class="success callout" data-closable="slide-out-right">
	<p><?php echo $messages['message'];?></p>
	<button class="close-button" aria-label="Dismiss alert" type="button"
		data-close>
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php }?>
<div class="content-wrapper">
	<div class="row">
		<div class="columns small-12 medium-8">
			<h4>CMP Project Welcome</h4>


		</div>

	</div>
</div>
</div>
</div>
</div>

