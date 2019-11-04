<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>


<?php
  if(isset($_GET['msgid'])){
      $msg = $_GET['msgid'];
      $query = "SELECT * FROM tbl_message WHERE id = $msg";
      $result = $db->select($query);
  }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>User Message</h2>
        <div class="block">
            <table class="table table-borderless">

                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($result) {
                    $message = $result->fetch_object();
                    ?>
                    <tr>
                        <th scope="row"><?php echo $message->firstname." ".$message->lastname; ?></th>
                        <td><?php echo $message->email; ?></td>
                        <td><?php echo $message->message; ?></td>

                    </tr>
                    <?php
                }
                ?>
                </tbody>

                <?php
                if(isset($_GET['msgid'])){
                    $msgid = $_GET['msgid'];
                    $msgquery = "UPDATE tbl_message SET status = 1 WHERE id = '$msgid'";
                    if($message->status == 0) {
                        $msgresult = $db->update($msgquery);
                    }
                }
                ?>
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