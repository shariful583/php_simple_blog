
<?php
    $query = "SELECT * FROM tbl_category";
    $query1 = "SELECT * FROM tbl_post limit 5";
    $category = $db->select($query);
    $post = $db->select($query1);
?>


<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
                        <?php
                            if($category){
                              while($result = $category->fetch_object()){ ?>
                                <li><a href="posts.php?category=<?php echo $result->id; ?>"><?php echo $result->category; ?></a></li>
                                  <?php } } else {  ?>
                                <li>No category found</li>
                           <?php } ?>
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
                <?php if($post){
                    while ($result = $post->fetch_object()){?>

					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result->id ;?>"><?php echo $result->title; ?></a></h3>
						<a href="#"><img src="admin/<?php echo $result->image; ?>" alt="post image"/></a>
						<p><?php echo $data->textShorten($result->body,100); ?>.</p>
					</div>
                <?php } } else {
                    echo "Not found";
                }?>
			</div>
			
		</div>
