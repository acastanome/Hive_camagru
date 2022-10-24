
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet"
		href="style.css">
</head>
<body>

	<main>
		<div class="container">
			<div class="col-9">
			<script type="text/javascript" src="js/js_like.js" charset="utf-8"></script>
				<?php
				require_once '../backend/db_user.php';
				require_once '../backend/db_likes.php';
				foreach($images as $image) {
					if (isset($_SESSION['logged_id'])) {
						$userliked = checkUserLikedImg($_SESSION['logged_id'], $image['img_id']);
					}
				?>
				<!-- Code for viewing the Post -->
				<div class="card">
					<div class="top">
						<div class="userDetails">
							<div class="profilepic">
								<div class="profile_img">
									<div class="image">
										<img src="<?php echo(htmlspecialchars($image['img_path'])); ?>"
											alt="profile_pic">
									</div>
								</div>
							</div>
							<h3><?php echo(getUsernameFromId($image['user_id'])); ?><br><span>Camagruland</span></h3>
						</div>
					</div>
					<div class="imgBx">
						<img src="<?php echo(htmlspecialchars($image['img_path'])); ?>"
							alt="post-image" class="cover">
					</div>
					<div class="bottom">
						<?php if (isset($_SESSION['logged_id'])) {?>
						<div class="actionBtns">
							<div class="left">
								<?php if ($userliked != 0) { ?>
									<span class="heart"
									onclick="ajaxLike(<?php echo($image['img_id']);?>)">
									
										<img id="heart<?php echo($image['img_id']);?>" name="outline" src="http://localhost:8080/camagru/stickers/heart-full.png"
											alt="heart">
									</span>
								<?php
								} else {
								?>
									<span class="heart"
									onclick="ajaxLike(<?php echo($image['img_id']);?>)">
									<img id="heart<?php echo($image['img_id']);?>" name="full" src="http://localhost:8080/camagru/stickers/heart-outline.png"
											alt="heart">
									</span>
								<?php
								}
								?>
								<svg aria-label="Comment"
									class="_8-yf5 "
									color="#262626"
									fill="#262626"
									height="24"
									role="img"
									viewBox="0 0 48 48"
									width="24">

							<!-- Coordinate path -->
									<path clip-rule="evenodd"
										d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5
										11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0
										7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0
										4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1
										8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10
										2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5
										44.5 12.7 44.5 24z"
										fill-rule="evenodd">
								</path>
								</svg>
							</div>
						</div><?php }?>
						<!-- Adding number of like and name of people -->
						<a href="#"><p class="likes"><?php echo(htmlspecialchars($image['likes'])); ?> likes</p></a>
						<!-- <a href="#">
							<p class="message">
							<b>Raju Modi</b>
							</p>
						</a> -->
						<a href="#">
							<h4 class="comments">View all <?php echo(htmlspecialchars($image['comments'])); ?> comments</h4>
						</a>
						<a href="#">
							<h5 class="postTime"><?php echo(htmlspecialchars($image['creation_time'])); ?></h5>
						</a>
						<div class="addComments">
							<input type="text"
								class="text"
								placeholder="Add a comment...">
							<a href="#">Post</a>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</main>
</body>
</html>
