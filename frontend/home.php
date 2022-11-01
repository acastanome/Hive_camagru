<?php require_once 'head.php'; ?>

<body>
<?php require_once 'navbar.php'; ?>
<link rel="stylesheet" href="css/gallery.css">
<div class="bodyContainer">

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
    if (!isset($_GET['page']) || $_GET['page'] < 1 || $_GET['page'] > $total_pages) {
        $page = 1;
        $prev_page = 1;
        $next_page = 2;
    } else {
        $page = $_GET['page'];
        $prev_page = $page - 1;
        $next_page = $page + 1;
    }

    $images = fetch_images((($page - 1) * $posts_per_page), $posts_per_page);
    require_once 'gallery.php'; ?>
    <div class="pagination">
        <a class="arrows" style="color: black;"<?php if($page > 1){echo "href='http://localhost:8080/camagru/frontend/home.php?page=$prev_page'";} ?>> ⬅ </a>&nbsp&nbsp&nbsp&nbsp&nbsp
            <?php echo $page; ?>&nbsp&nbsp&nbsp&nbsp&nbsp
        <a class="arrows" style="color: black;" <?php if($page < $total_pages){echo "href='http://localhost:8080/camagru/frontend/home.php?page=$next_page'";} ?>> ➡ </a>
    </div>
    <?php
}
?>
</div>
<?php require_once 'footer.php'; ?>
</body>
</html>