<!--main sub page heading-->
<section id="page-head">
	<div class="container">
		<div class="row col-md-12">
			<div class="page-heading">
				<h1>Pricing Plan</h1>
				<h4>Pricing Plan can be made anytime</h4>
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
				<div class="plan">
					<h4 class="inner-heading">GET LOYAL AUDIENCE</h4>
					<div class="price-content">
						<p>
							<strong>Lorem ipsum dolor sit amet</strong> consectetuer
							adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
							laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim
							veniam quis nostrud lobortis commodo consequat.
						</p>
						<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit
							esse molestie consequat, vel illum dolore eu feugiat nulla
							facilisis at vero eros et accumsan dignissim qui blandit praesent
							luptatum zzril delenit augue duis dolore te feugait nulla
							facilisi.</p>
					</div>
					<div class="pricing-plan">
						<h4 class="inner-heading">PRICING PLANS</h4>
						<div class="row">
					<?php
					foreach($plans as $plan){
						?>
                                <div class="col-sm-4">
								<div class="price-plan">
									<h4>
										<span>$<?php echo $plan['amount'];?></span>
									</h4>
									<div class="user-plan">
										<h4><?php echo $plan['name'];?></h4>
										<ul>
											<li><?php echo $plan['number_of_ads'];?> Featured Ad</li>
											<li><?php echo $plan['number_of_days'];?> Day</li>
											<li>100% Secure</li>
										</ul>
										<a href="<?php echo base_url('purchase/plan/'.$plan['id']); ?>">Purchase Now</a>
									</div>
								</div>
							</div>
                                <?php } ?>
                               
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
