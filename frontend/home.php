<?php require_once 'head.php'; ?>

<body>
<?php require_once 'navbar.php'; ?>

<div class="fuckingfuck">
<?php
require_once '../backend/db_gallery.php';
$posts_per_page = 5;
$total_posts = getNbPosts();
$total_pages = ceil($total_posts / $posts_per_page);

if($total_posts == 0) {
?>
    <h1>Welcome to Camagru!</h1>
    <h3>Currently there is no posts.</h3>
    <h2>Log in or Sign up to begin your journey</h2>
<?php
} else {
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        if ($_GET['page'] < 1 || $_GET['page'] > $number_of_pages) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
    }

    $images = fetch_images((($page - 1) * $posts_per_page), $posts_per_page);
    require_once 'gallery.php';
}
?>
</div>
<?php require_once 'footer.php'; ?>
</body>
</html>