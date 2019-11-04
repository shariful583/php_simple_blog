<?php include 'inc/header.php';?>
<?php include 'inc/slider.php';?>


<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php
        $per_page = 3;
        if(isset($_GET['page'])){
            $page = $_GET['page'];

        }
        else{
            $page=1;
        }
        $start_from = ($page-1)*$per_page;
        ?>


        <?php
        $query = "SELECT * FROM tbl_post limit $start_from, $per_page";
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

        <?php } ?>
            <?php
            $query = "SELECT * FROM tbl_post";
            $result = $db->select($query);
            $rows = mysqli_num_rows($result);
            $total_page = ceil($rows/$per_page);
            ?>

            <?php echo "<span class='pagination'><a href='index.php?page=1'>First Page</a>"; ?>

            <?php
                for($i=1;$i<=$total_page;$i++){
                    echo "<a href='index.php?page=".$i."'>".$i."</a>";
                };
            ?>

            <?php echo "<a href='index.php?page=$total_page.'>Last page</a></span>"; ?>
        <?php } else{ header("Location:404.php");}?>

    </div>


    <?php include 'inc/sidebar.php';?>
    <?php include 'inc/footer.php';?>
