<!-- <?php 
$page = getPage($pages);


?>

<h1><?php echo $page->name ?></h1>

<div>
    <?php echo $page->description ?>
</div> -->

<?php 
    $page = getPage($pages, $_GET['id']);
?>

<h1><?php echo $page->name ?></h1>

<div>
    <?php echo $page->description ?>
</div>