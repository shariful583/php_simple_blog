<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<style>
    .leftside{
        float:left;
        width: 70%;
    }

    .rightside{
        float: right;
        width: 20%;
    }
    .rightside img{
        height: 160px;
        width: 170px;
    }
</style>


<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $data->validation($_POST['title']);
    $slogan = $data->validation($_POST['slogan']);

    $title = mysqli_real_escape_string($db->link, $title);
    $slogan = mysqli_real_escape_string($db->link, $slogan);


    $permited = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $name_image = 'logo'.'.'. $file_ext;
    $uploaded_image = "upload/" . $name_image;

    if (empty($title) || empty($slogan)){
        echo "Field must not be empty";
    } else {


        if (!empty($file_name)) {

            if ($file_size > 1048567) {
                echo "<span class='error'>Image Size should be less then 1MB!</span>";
            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-"
                    . implode(', ', $permited) . "</span>";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_site_info
                                     SET
                                     title = '$title',
                                     slogan = '$slogan',
                                     logo = '$uploaded_image'
                                     WHERE id = '1'";
                $inserted_rows = $db->update($query);
                if ($inserted_rows) {
                    echo "Site updated";
                } else {
                    echo "Site not updated";
                }
            }
        } else {
            $query = "UPDATE tbl_site_info
                                     SET
                                     title = '$title',
                                     slogan = '$slogan'
                                     WHERE id = '1'";
            $inserted_rows = $db->update($query);
            if ($inserted_rows) {
                echo "Site updated";
            } else {
                echo "Site not updated";
            }
        }
    }
}
?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <?php
                $query = "SELECT * FROM tbl_site_info WHERE id = '1'";
                $result = $db->select($query);
                if($result) {
                    while ($site = $result->fetch_object()) {
                        ?>

                        <div class="block sloginblock">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="leftside">

                                    <table class="form">
                                        <tr>
                                            <td>
                                                <label>Website Title</label>
                                            </td>
                                            <td>
                                                <input type="text" value="<?php echo $site->title; ?>" name="title"
                                                       class="medium"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Website Slogan</label>
                                            </td>
                                            <td>
                                                <input type="text" value="<?php echo $site->slogan; ?>"
                                                       name="slogan" class="medium"/>
                                            </td>
                                        </tr>
                                <tr>
                                    <td>
                                        <label>Upload Image</label>
                                    </td>
                                    <td>
                                        <input name="logo" type="file"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" Value="Update"/>
                                    </td>
                                </tr>

                                </div>

                                <div class="rightside">
                                    <img src="<?php echo $site->logo; ?>" alt="logo">
                                </div>

                                </table>

                            </form>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
<?php include "inc/footer.php"; ?>

