<div class="leaderboard-container">
	<div class="leaderboard-head">
		<img src="<?= base_url() ?>assets/frontend/images/trophy.png">
		<h4>This Weeks Leaderboards</h4>
	</div>
	<div class="leaderboard-list">
		<ul>
        
        <?php
								for($i = 0; $i < sizeof($leaderboard); $i++){
									$row = $leaderboard [$i];
									if($i == 10)
										break;
									?>
							
							
            <li>
				<div class="leaderboard-count">
					<p><?php echo ($i+1); ?></p>
				</div>
				<div class="leaderboard-img">
					<img src="<?php echo getProfileImage($row);?>">
				</div>
				<div class="leaderboard-name">
					<p><?php echo $row['first_name']; ?></p>
				</div>
				<div class="leaderboard-score">
					<p><?php echo $row['score']; ?></p>
				</div>
			</li>
            <?php } ?>
        </ul>
	</div>
</div>