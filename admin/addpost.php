<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New Post</h2>
     <?php
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
             $title = mysqli_real_escape_string($db->link,$_POST['title']);
             $cat = mysqli_real_escape_string($db->link,$_POST['cat']);
             $body = mysqli_real_escape_string($db->link,$_POST['body']);
             $author = mysqli_real_escape_string($db->link,$_POST['author']);
             $tags = mysqli_real_escape_string($db->link,$_POST['tags']);

             $permited  = array('jpg', 'jpeg', 'png', 'gif');
             $file_name = $_FILES['image']['name'];
             $file_size = $_FILES['image']['size'];
             $file_temp = $_FILES['image']['tmp_name'];

             $div = explode('.', $file_name);
             $file_ext = strtolower(end($div));
             $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
             $uploaded_image = "upload/".$unique_image;

             if(empty($title) || empty($cat) ||empty($body) ||empty($author) ||empty($tags)){
                 echo "Field mus not be empty";
             } elseif ($file_size >1048567) {
                 echo "<span class='error'>Image Size should be less then 1MB!</span>";
             } elseif (in_array($file_ext, $permited) === false) {
                 echo "<span class='error'>You can upload only:-"
                     .implode(', ', $permited)."</span>";
             } else{
                 move_uploaded_file($file_temp, $uploaded_image);
                 $query = "INSERT INTO tbl_post(cat, title, body, image, author, tags)  VALUES('$cat', '$title','$body','$uploaded_image','$author' ,'$tags')";
                 $inserted_rows = $db->insert($query);
                 if($inserted_rows){
                     echo "Post inserted";
                 }
                 else{
                     echo "post not inserted";
                 }
             }
         }
      ?>

                <div class="block">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name = "title" placeholder="Enter Post Title..." class="medium" />
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
                                        if($cat_result){
                                            while($result = $cat_result->fetch_object()){
                                    ?>
                                    <option value="<?php echo $result->id; ?>"><?php echo $result->category; ?></option>

                                    <?php } } else{
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
                                <input name ="image" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name= "body" class="tinymce"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name = "author" placeholder="Enter author Name..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name = "tags" placeholder="Enter Tags Name..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>

                    </table>
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