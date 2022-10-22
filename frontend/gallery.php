
<!-- <div> -->
      <?php
      // if (!isset($_SESSION['logged_user']))
      // {
      ?>
      <!-- <h3>Not logged in. <br>Display navbar (Home, log in) and all photos(cant comment or like)</h3> -->
      <?php
      // }
      // else
      // {
      ?>
      <!-- <h3>Display navbar (Home, camera, profile, log out) and all photos(can comment or like)</h3> -->
      <?php
      // }
      // require_once '../backend/db_gallery.php';
      // $gallery = getAllImages();
      // if ($gallery) {
      //       echo $gallery;
      // }
      // else {
      //       echo "no images in gallery";
      // }
      ?>
<!-- </div> -->

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet"
		href="style.css">
</head>
<body>

	<!-- Code for Showing the Status -->
	<main>
		<div class="container">
			<div class="col-9">
				<?php
				require_once '../backend/db_user.php';
				// echo "total posts: $total_posts and total pg: $total_pages";
				foreach($images as $image) {
					// echo "$image[user_id]";
					// echo(getUsernameFromId($image['user_id']));
				?>
				<!-- Code for viewing the Post -->
				<div class="card">
					<div class="top">
						<div class="userDetails">
							<div class="profilepic">
								<div class="profile_img">
									<div class="image">
										<img src="<?php echo($image['img_path']); ?>"
											alt="profile_pic">
									</div>
								</div>
							</div>
							<h3><?php echo(getUsernameFromId($image['user_id'])); ?><br><span>Camagruland</span></h3>
						</div>
					</div>
					<div class="imgBx">
						<img src="<?php echo($image['img_path']); ?>"
							alt="post-image" class="cover">
					</div>
					<div class="bottom">
						<div class="actionBtns">
							<div class="left">
								<span class="heart"
									onclick="addlike()">
									<span>
										<svg aria-label="Like"
											color="#262626"
											fill="#262626"
											height="24"
											role="img"
											viewBox="0 0 48 48"
											width="24">
											<!-- Coordinate path -->
											<path
												d="M34.6 6.1c5.7 0 10.4 5.2 10.4
												11.5 0 6.8-5.9 11-11.5 16S25 41.3 24
												41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3
												11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3
												1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9
												1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9
												1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1
												0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3
												1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3
												1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2
												7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6
												48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
											</path>
										</svg>
									</span>
								</span>
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
						</div>
						<!-- Adding number of like and name of people -->
						<a href="#"><p class="likes"><?php echo($image['likes']); ?> likes</p></a>
						<a href="#">
							<p class="message">
							<b>Raju Modi</b>
							</p>
						</a>
						<a href="#">
							<h4 class="comments">View all <?php echo($image['comments']); ?> comments</h4>
						</a>
						<a href="#">
							<h5 class="postTime"><?php echo($image['creation_time']); ?></h5>
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
