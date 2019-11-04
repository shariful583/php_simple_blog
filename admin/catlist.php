<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

                <?php
                if(isset($_GET['delid'])){
                    $del = $_GET['delid'];
                    $query = "DELETE FROM tbl_category WHERE id = '$del'";
                    $result = $db->delete($query);
                    if($result){
                        echo "<span>Category delete successfully</span>";
                    }  else {
                        echo "<span>There is no data for delete.</span>";
                    }
                }

                ?>


                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

                    <?php
                    $i = 0;
                    $query = "SELECT * FROM tbl_category ORDER BY id DESC";
                    $cat = $db->select($query);
                    if($cat){
                    while($result= $cat->fetch_object()){
                        $i++;
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result->category; ?></td>
							<td><a href="editcat.php?id=<?php echo $result->id; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?') " href="?delid=<?php echo $result->id; ?>">Delete</a></td>
						</tr>
                    <?php } } else {
                        echo "<tr>Database Empty</tr>";
                    } ?>

					</tbody>
				</table>
               </div>
            </div>
        </div>
<?php include "inc/footer.php"; ?>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>