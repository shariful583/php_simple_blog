<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
     <?php
           $i = 0;
           $query = "SELECT * FROM tbl_message ORDER BY id DESC";
           $cat = $db->select($query);
     ?>



<div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                if(isset($_GET['delid'])){
                    $del = $_GET['delid'];
                    $query = "DELETE FROM tbl_message WHERE id = '$del'";
                    $result = $db->delete($query);
                    if($result){
                        echo "<span>Message Delete successfully.</span>";
                    }  else {
                        echo "<span>There is no message for delete.</span>";
                    }
                }
                ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        if($cat) {
                            while ($result = $cat->fetch_object()) {
                                $i++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result->firstname." ". $result->lastname; ?></td>
                                    <td><?php echo $result->email; ?></td>
                                    <td><?php echo $result->message; ?></td>
                                    <td><a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $result->id; ?>">Delete</> ||
                                        <a href="message.php?msgid=<?php echo $result->id; ?>">View</a> ||
                                        <a href="reply.php?replyid=<?php echo $result->id; ?>">Reply</a>
                                        <?php
                                            $sts = $result->status;
                                            if($sts == 1){
                                                echo "(seen)";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Seen Message</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM tbl_message WHERE status = '1'";
                $resultt = $db->select($query);
                if($resultt) {
                    $j = 0;
                    while ($mess = $resultt->fetch_object()) {
                        $j++;
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $j; ?></td>
                            <td><?php echo $mess->firstname." ".$mess->lastname; ?></td>
                            <td><?php echo $mess->email; ?></td>
                            <td><?php echo $mess->message; ?></td>
                            <td><a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $mess->id; ?>">Delete</> ||
                                <a href="message.php?msgid=<?php echo $mess->id; ?>">View</a> ||
                                <a href="reply.php?replyid=<?php echo $mess->id; ?>">Reply</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else{
                    echo "No seen message";
                }
                ?>
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