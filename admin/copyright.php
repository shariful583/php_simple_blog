<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $copyright = $data->validation($_POST['copyright']);
                    $copyright = mysqli_real_escape_string($db->link, $copyright);
                    if (empty($copyright)) {
                        echo "Field must not be empty";
                    } else {
                        $query = "UPDATE tbl_footer
                                     SET
                                     copy = '$copyright'
                                     WHERE id = '1'";
                        $inserted_rows = $db->update($query);
                        if ($inserted_rows) {
                            echo "Copyright updated";
                        } else {
                            echo "Copyright not updated";
                        }
                    }
                }
                ?>
                <div class="block copyblock">

                    <?php
                    $query = "SELECT * FROM tbl_footer WHERE id = '1'";
                    $result = $db->select($query);
                    if($result) {
                        while ($site = $result->fetch_object()) {
                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <table class="form">
                                    <tr>
                                        <td>
                                            <input type="text" value = "<?php echo $site->copy; ?>" name="copyright"
                                                   class="large"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="submit" name="submit" Value="Update"/>
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
