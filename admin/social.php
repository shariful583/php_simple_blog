<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
 <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>

                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $facebook = $data->validation($_POST['facebook']);
                    $twitter = $data->validation($_POST['twitter']);
                    $linkedin = $data->validation($_POST['linkedin']);
                    $googleplus = $data->validation($_POST['googleplus']);

                    $facebook = mysqli_real_escape_string($db->link, $facebook);
                    $twitter = mysqli_real_escape_string($db->link, $twitter);
                    $linkedin = mysqli_real_escape_string($db->link, $linkedin);
                    $googleplus = mysqli_real_escape_string($db->link, $googleplus);


                    if (empty($facebook) || empty($twitter) || empty($linkedin) || empty($googleplus)) {
                        echo "Field must not be empty";
                    } else {
                        $query = "UPDATE tbl_social
                                     SET
                                     facebook = '$facebook',
                                     twitter = '$twitter',
                                     linkdin = '$linkedin',
                                     gplus = '$googleplus'
                                     WHERE id = '1'";
                        $inserted_rows = $db->update($query);
                        if ($inserted_rows) {
                            echo "Social link updated";
                        } else {
                            echo "Social link not updated";
                        }
                    }
                }

                ?>

                <div class="block">
                    <?php
                         $query = "SELECT * FROM tbl_social WHERE id = '1'";
                         $result = $db->select($query);
                         if($result) {
                             while ($site = $result->fetch_object()) {
                                 ?>

                                 <form action="" method="post" enctype="multipart/form-data">
                                     <table class="form">
                                         <tr>
                                             <td>
                                                 <label>Facebook</label>
                                             </td>
                                             <td>
                                                 <input type="text" name="facebook" value = "<?php echo $site->facebook; ?>"
                                                        class="medium"/>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <label>Twitter</label>
                                             </td>
                                             <td>
                                                 <input type="text" name="twitter" value = "<?php echo $site->twitter; ?>"
                                                        class="medium"/>
                                             </td>
                                         </tr>

                                         <tr>
                                             <td>
                                                 <label>LinkedIn</label>
                                             </td>
                                             <td>
                                                 <input type="text" name="linkedin" value = "<?php echo $site->linkdin; ?>"
                                                        class="medium"/>
                                             </td>
                                         </tr>

                                         <tr>
                                             <td>
                                                 <label>Google Plus</label>
                                             </td>
                                             <td>
                                                 <input type="text" name="googleplus" value = "<?php echo $site->gplus; ?>"
                                                        class="medium"/>
                                             </td>
                                         </tr>

                                         <tr>
                                             <td></td>
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