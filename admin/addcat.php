<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
                   <?php
                       if($_SERVER['REQUEST_METHOD'] == 'POST'){
                           $cat_name = $_POST['cat'];
                           $cat_name = mysqli_real_escape_string($db->link,$cat_name);
                           if(empty($cat_name)){
                               echo "Field can not blanked";
                           }
                           else{
                               $query = "INSERT INTO tbl_category (category) VALUES ('$cat_name')";
                               $result = $db->insert($query);
                               if($result){
                                   echo "Data Inserted Successfully";
                               }

                               else{
                                   Echo "Data is Not inserted";
                               }
                           }
                       }
                   ?>

                 <form action = "addcat.php" method = "post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name = "cat" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
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
