
<link rel="stylesheet" href="style.css">

	<main>
		<div class="container">
			<div class="col-9">
			<script type="text/javascript" src="js/js_like.js" charset="utf-8"></script>
			<script type="text/javascript" src="js/js_comments.js" charset="utf-8"></script>
				<?php
				require_once '../backend/db_user.php';
				require_once '../backend/db_likes.php';
				require_once '../backend/db_comments.php';
				foreach($images as $image) {
					$imgLikes = $image['likes'];
					if (isset($_SESSION['logged_id'])) {
						$userliked = checkUserLikedImg($_SESSION['logged_id'], $image['img_id']);
						$usercommented = checkUserCommentedImg($_SESSION['logged_id'], $image['img_id']);
					}
					$comments = fetch_comments($image['img_id']);
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
								alt="post-image" class="gallery-img">
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
										<?php if ($usercommented != 0) { ?>
											<span class="comment">
												<img id="comment<?php echo($image['img_id']);?>" name="fullC" src="http://localhost:8080/camagru/stickers/comment-full.png"
													alt="comment">
											</span>
										<?php
										} else {
										?>
											<span class="comment">
											<img id="comment<?php echo($image['img_id']);?>" name="outlineC" src="http://localhost:8080/camagru/stickers/comment-outline.png"
													alt="comment">
											</span>
										<?php
										}
										?>
										<!-- <span class="likes"> Likes: <?php echo($image['likes']); ?></span> -->
										<span class="likes"> Likes: </span>
										<span class="likes" id="likeNb<?php echo($image['img_id']);?>"><?php echo($imgLikes); ?></span>
									</div>
									<div class="right">
										<h5 class="postTime"><?php echo($image['creation_time']); ?></h5>
									</div>
								</div>
							<?php } else {?>
								<span class="likes"> Likes: </span>
								<span class="likes" id="likeNb<?php echo($image['img_id']);?>"><?php echo($imgLikes); ?></span>
								<h5 class="postTime"><?php echo($image['creation_time']); ?></h5>
							<?php }
							if ($comments) {
								?><br><?php
								foreach($comments as $comment) { ?>
							<div class="comment">
								<p><strong><?php echo(htmlspecialchars(getUsernameFromId($comment['user_id']))); ?> : </strong><?php echo(htmlspecialchars($comment['comment_text'])); ?></p>
							</div>
							<?php
								}
							}
							if (isset($_SESSION['logged_id'])) { ?>
							<div class="addComments">
								<form class="comment_form" name="commentPostForm" onsubmit="ajaxComment(<?php echo($image['img_id']);?>)" method="POST">
									<input type="text" name="f_comment" id="f_comment<?php echo($image['img_id']);?>" class="text" placeholder="Add a comment..." maxlength="2000" required>
									<button style="float:right;" class="myBtns" type="submit" name="post_comment" id="post_comment">Post</button>
								</form>
							</div>
							<?php
						}?>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</main>
