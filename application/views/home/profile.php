
<!--main sub page heading-->
<section id="page-head">
	<div class="container">
		<div class="row col-md-12">
			<div class="page-heading">
				<h1>EDIT PROFILE</h1>
				<h4>Editing can be made anytime</h4>
			</div>
		</div>
	</div>
</section>
<!--end main page heading-->
<!--Detail -->
<section id="detail">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="ads-detail">
					<div class="account-overview">
						<h4 class="inner-heading">ACCOUNT OVERVIEW</h4>
						<div class="row">
							<div class="col-sm-9">
								<div class="author-account">
									<div class="account-info">
										<span>Total Ads :</span>
										<p class="text-right"><?php echo $normal_ad_count?></p>
									</div>
									<div class="account-info">
										<span>Featured Ads :</span>
										<p class="text-right"><?php echo $feature_ad_count?></p>
									</div>
									<div class="account-info hide">
										<span>Featured ads left :</span>
										<p class="text-right">unlimited</p>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="author-avatar profile-img">
									<img src="<?php echo $user_info['user_pic']; ?>" alt="author avatar">
									<form role="form" method="post" action=""
									enctype="multipart/form-data">
										<span class="fa fa-pencil" aria-hidden="true">
											<input type="file" id="photo_name" name="photo_name" accept=".jpg,.png" required>
										</span>
										<button type="submit" class="btn btn-success">Submit</button>
										<input type="hidden" name="task" value="profile_pic_update" />
									</form>
								</div>
								<div class="author-name">
									<p><?php printkey($post_data,'first_name').' '.printkey($post_data,'last_name');?> </p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div id="form">
									<form method="post">
										<div class="col-sm-6 input-pad">
											<span class="fa fa-user form-control-feedback"></span> <input
												class="form-control" type="text" name="first_name"
												placeholder="John Doe   |"
												value="<?php printkey($post_data,'first_name');?>">

										</div>
										<div class="col-sm-6 padding-control">
											<span class="fa fa-user form-control-feedback"></span> <input
												class="form-control" type="text" name="last_name"
												placeholder="Last Name"
												value="<?php printkey($post_data,'last_name');?>">
										</div>
										<div class="col-sm-6 input-pad">
											<span class="fa fa-envelope form-control-feedback"></span> <input
												class="form-control" type="email" name="email"
												placeholder="Email Address"
												value="<?php printkey($post_data,'email');?>">

										</div>
										<div class="col-sm-6 padding-control">
											<span class="fa fa-phone form-control-feedback"></span> <input
												class="form-control" type="text" name="phone"
												placeholder="Phone No."
												value="<?php printkey($post_data,'phone');?>">
										</div>
										<div class="col-sm-12 col-md-6 input-pad">
											<select class="form-control select2" id="state_id"
												name="state_id" data-validation="required">
												<option value="">Select State</option>
						                          <?php foreach($states as $state){?>
						                        <option value="<?=$state['id'];?>"
													<?php echo ( isset($post_data['state_id']) && $post_data['state_id'] == $state['id'])?"selected":"" ?>><?=$state['state'];?></option>
						                          <?php }?>
						                      </select>
										</div>
										<div class="col-sm-12 col-md-6 padding-control">
											<select class="form-control select2" id="city_id"
												name="city_id" data-validation="required">
												<option value="">Select City</option>
											</select>
										</div>
										<div class="col-sm-12 padding-control">
											<span class="fa fa-map-marker form-control-feedback"></span>
											<input class="form-control" type="text" name="address"
												placeholder="Address"
												value="<?php printkey($post_data,'address');?>">
										</div>
										<div class="col-sm-12 padding-control">
											<span class="ad-type">Gender:</span> <label><input
												type="radio" name="gender" value="male"
												<?php echo ( isset($post_data['gender']) && $post_data['gender'] == 'male')?"checked='checked'":"" ?>>
												Male</label> <label><input type="radio" name="gender"
												value="female"
												<?php echo ( isset($post_data['gender']) && $post_data['gender'] == 'female')?"checked='checked'":"" ?>>
												Female</label>
										</div>
										<input type="submit" value=" Save Changes" name="submit"> <input
											type="hidden" name="task" value="user_profile_update" />
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<?php $this->load->view('sidebar/premium.php')?>
			</div>
		</div>
	</div>
</section>
<!--end details-->
<script>

$(document).ready(function(){
    $(".select2").select2();

    $.validate();
      var city_id = "<?php echo $post_data['city_id'];?>";
 


    var cities_arr = <?php echo json_encode($cities_arr);?>;

    $('#state_id').select2().on('change', function() {
		childs = [{id:"", text: "Select City"}];
		if(cities_arr[$(this).val()]){
			childs = cities_arr[$(this).val()]
			}
		console.log(childs);
        $('#city_id').html('').select2({data:childs});
        $("#city_id").select2("val",city_id);
        
    }).trigger('change');

    $('.profile-img form input:file').on('change', function() {
$( ".profile-img form button.btn" ).trigger( "click" );
        
    });
    
});

</script>
