<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<?php

     if(!isset($_GET['id']) || $_GET['id'] == NULL){
         echo "<script>window.location = 'catlist.php';</script>";
     }
     else {
         $cat_id = $_GET['id'];
     }

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">

            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $update_cat = $_POST['cat'];
                $update_cat = mysqli_real_escape_string($db->link,$update_cat);
                if(empty($update_cat)){
                    echo "<span>Fill up update category!</span>";
                } else {
                    $query = "UPDATE tbl_category SET category = '$update_cat' WHERE id = '$cat_id'";
                    $result = $db->update($query);
                    if($result){
                        echo "<span>Update Successfull!</span>";
                    } else {
                        echo "<span>Update Unsuccessfull!</span>";
                    }
                }

            }
            ?>

            <form action = "" method = "post">
                <?php
                    $query = "SELECT * FROM tbl_category where id = '$cat_id'";
                    $result = $db->select($query);
                    if($result){
                        while($cat = $result->fetch_object()){
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name = "cat" value = <?php echo $cat->category; ?> class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
                <?php } } ?>

            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>
