<?php include 'inc/header.php';?>
<?php include 'inc/slider.php';?>
<?php
if(!isset($_GET['category']) || $_GET['category'] == NULL){
    header( "Location:404.php");
}
   else{
    $id = $_GET['category'];
}
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php
        $query = "SELECT * FROM tbl_post where cat='$id'";
        $post = $db->select($query);
        if($post){
        while($result = $post->fetch_object()){

        ?>
        <div class="samepost clear">
            <h2><a href="post.php?id=<?php echo $result->id; ?>"><?php echo $result->title; ?></a></h2>
            <h4><?php echo $data->formatDate($result->date); ?>, By <a href="#"></a><?php echo $result->author; ?></a></h4>
            <a href="#"><img src="admin/<?php echo $result->image; ?>" alt="post image"/></a>
            <p>
                <?php echo $data->textShorten($result->body); ?>
            </p>
            <div class="readmore clear">
                <a href="post.php?id=<?php echo $result->id; ?>">Read More</a>
            </div>

        </div>

        <?php } } else{ echo "No categories post found";}?>
    </div>


<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>