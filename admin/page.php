<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<?php
if(!isset($_GET['id']) || $_GET['id'] == NULL) {
    header("Location:index.php");
} else {
    $page = $_GET['id'];
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Page</h2>
        <?php
        if(isset($_GET['del_id'])){
            $del = $_GET['del_id'];
            $query = "DELETE FROM tbl_page WHERE id = '$del'";
            $result = $db->delete($query);
            if($result){
                echo "<script>window.alert('Successfully delete!');</script>";
                echo "<script>window.location = 'index.php';</script>";
            }  else {
                echo "<span>There is no data for delete.</span>";
            }
        }

        ?>

        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = mysqli_real_escape_string($db->link,$_POST['title']);
            $body = mysqli_real_escape_string($db->link,$_POST['body']);
            if(empty($title) || empty($body)){
                echo "Field must not be empty";
            }else{
                $query = "UPDATE tbl_page SET
                                     title = '$title',
                                     body = '$body'
                    
                                     WHERE id = '$page'";
                        $inserted_rows = $db->update($query);
                        if ($inserted_rows) {
                            echo "Page updated";
                        } else {
                            echo "page not updated";
                        }
            }
        }
        ?>

        <div class="block">

            <?php
                $query = "SELECT * FROM tbl_page WHERE id = '$page'";
                $result = $db->select($query);
                if($result) {
                    while ($site = $result->fetch_object()) {
                        ?>

                        <form action="" method="post">
                            <table class="form">

                                <tr>
                                    <td>
                                        <label>Title</label>
                                    </td>
                                    <td>
                                        <input type="text" name="title" value="<?php echo $site->title; ?>"
                                               class="medium"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: top; padding-top: 9px;">
                                        <label>Content</label>
                                    </td>
                                    <td>
                                        <textarea name="body" class="tinymce"><?php echo $site->body; ?>>"</textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="submit" Value="Save"/>
                                        <span class = "btn"><a onclick="return confirm('Are you sure to delete?')" href = "?del_id=<?php echo $site->id; ?>">Delete</a></span>
                                    </td>
                                </tr>

                            </table>
                        </form>

                        <?php
                    }
                }
            ?>
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