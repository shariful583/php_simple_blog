<?php include 'inc/header.php'; ?>
<?php
    if(!isset($_GET['id']) || $_GET['id'] == NULL){
        header( "Location:404.php");
    }
    else{
        $id = $_GET['id'];
    }
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
                     <?php
                         $query = "SELECT * FROM tbl_post where id=$id";
                         $post = $db->select($query);
                         if($post){
                             while($result = $post->fetch_assoc()){
                     ?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $data->formatDate($result['date']); ?>, By <a href="#"></a><?php echo $result['author']; ?></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
				<p><?php echo $result['body']; ?></p>
				<div class="relatedpost clear">
					<h2>Related articles</h2>
                     <?php
                         $catid = $result['cat'];
                         $querypost = "SELECT * FROM tbl_post where cat='$catid' order by rand() limit 6";
                         $postrel = $db->select($querypost);
                         if($postrel){
                             while($relresult = $postrel->fetch_assoc()){
                      ?>
					<a href="post.php?id=<?php echo $relresult['id']; ?>"><img src="admin/<?php echo $relresult['image']; ?>" alt="post image"/></a>
                            <?php } } else {
                            echo "No post found";
                        }?>
				</div>
                       <?php } } else {
                                  header("Location:404.php");
                       }?>
	       </div>
		</div>
	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>
