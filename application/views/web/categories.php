
<!--Category-->
<section id="categories">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="main-heading text-center">
					<h2>CATEGORIES</h2>
				</div>
			</div>
		</div>
		<div class="row grid">
		  <?php foreach($parent_cats as $cats){ ?>
                          
		
			<div class="col-md-3 col-xs-12 col-sm-6 grid-item">
				<div class="category">
					<div class="category-icon">
						<i class="fa fa-2x <?=$cats['icon_class']?>"></i>
					</div>
					<h4>
						<a href="<?php echo base_url().'ads/?category_id='.$cats['id']; ?>"><?=$cats['name'].' ('.$cats['total_count'].')' ?> </a>
					</h4>
					<?php foreach($cats['child_cats'] as $child){ ?>
					<p>
						<a href="<?php echo base_url().'ads/?category_id='.$child['id']; ?>"><?=$child['name'].' ('.$child['total_rows'].')' ?></a>
					</p>
					<?php } ?>
					
				</div>
			</div>
			<?php }?>

		</div>
	</div>
</section>
<!--End Category-->
<script type="text/javascript">
$(document).ready(function(){
	$('.grid').masonry({
  // options
  itemSelector: '.grid-item'  
});
});
</script>

