<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<?php
if(!isset($_GET['post_id']) || $_GET['post_id'] == NULL) {
    header("Location:postlist.php");
} else {
    $post = $_GET['post_id'];
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Post</h2>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if (empty($title) || empty($cat) || empty($body) || empty($author) || empty($tags)) {
                echo "Field mus not be empty";
            } else {


                if (!empty($file_name)) {

                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!</span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                            . implode(', ', $permited) . "</span>";
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_post
                                     SET
                                     cat = '$cat',
                                     title = '$title',
                                     body = '$body',
                                     image = '$uploaded_image',
                                     author = '$author',
                                     tags = '$tags'
                                     WHERE id = '$post'";
                        $inserted_rows = $db->update($query);
                        if ($inserted_rows) {
                            echo "Post updated";
                        } else {
                            echo "post not updated";
                        }
                    }
                } else {
                    $query = "UPDATE tbl_post
                                     SET
                                     cat = '$cat',
                                     title = '$title',
                                     body = '$body',
                                     author = '$author',
                                     tags = '$tags'
                                     WHERE id = '$post'";
                    $inserted_rows = $db->update($query);
                    if ($inserted_rows) {
                        echo "Post updated";
                    } else {
                        echo "post not updated";
                    }
                }
            }
        }
        ?>

        <div class="block">

            <?php
            $post_query = "SELECT * FROM tbl_post WHERE id = '$post'";
            $post_result = $db->select($post_query);
            if($post_result) {
            while ($rresult = $post_result->fetch_object()){

            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $rresult->title; ?>" class="medium"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option>Select category</option>
                                <?php
                                $category = "SELECT * FROM tbl_category";
                                $cat_result = $db->select($category);
                                if ($cat_result) {
                                    while ($result = $cat_result->fetch_object()) {
                                        ?>
                                        <option
                                            <?php
                                              if($rresult->cat == $result->id) {
                                                  ?>
                                                  selected="selected"
                                                  <?php
                                              }
                                            ?>
                                            value="<?php echo $result->id; ?>"><?php echo $result->category; ?></option>

                                    <?php }
                                } else {
                                    return false;
                                } ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $rresult->image; ?>" height="40px" width="60px" alt="post image"/>
                            <input name="image" type="file"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea name="body" class="tinymce"><?php echo $rresult->body; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $rresult->author; ?>" class="medium"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $rresult->tags; ?>" class="medium"/>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save"/>
                        </td>
                    </tr>

                </table>

                <?php
                }
                }
                ?>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>


<!--jQuery Date Picker-->
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
<!-- jQuery dialog related-->
<script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
<!-- jQuery dialog end here-->
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<!--Fancy Button-->
<script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
<script src="js/setup.js" type="text/javascript"></script>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>