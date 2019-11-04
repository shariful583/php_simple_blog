<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
                            <th style="width: 5%;">SL No.</th>
							<th style="width: 10%;">Post Title</th>
							<th style="width: 20%;">Description</th>
							<th style="width: 10%;">Category</th>
							<th style="width: 10%;">Image</th>
							<th style="width: 10%;">Author</th>
                            <th style="width: 10%;">Date</th>
							<th style="width: 15%;">Action</th>
						</tr>
					</thead>
					<tbody>

          <?php
              $post = "SELECT tbl_post.*, tbl_category.category FROM tbl_post LEFT JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.id DESC";
              $posts = $db->select($post);
              if($posts) {
                  $i = 0;
                  while ($result = $posts->fetch_object()) {
                      $i++;
                      ?>
                      <tr class="odd gradeX">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $result->title; ?></td>
                          <td><?php echo $data->textShorten($result->body,50); ?></td>
                          <td><?php echo $result->category; ?></td>
                          <td class="center"><img src="<?php echo $result->image; ?>" height="40px" width="60px" alt="post image"/></td>
                          <td><?php echo $result->author; ?></td>
                          <td><?php echo $data->formatDate($result->date); ?></td>
                          <td><a href="editpost.php?post_id=<?php echo $result->id; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="deletepost.php?del_id=<?php echo $result->id; ?>">Delete</a></td>
                      </tr>
                      <?php
                  }
              } else { ?>
                  <tr class="odd gradeX">
                      <td>NOT available</td>
                      <td>NOT available</td>
                      <td>NOT available</td>
                      <td class="center">NOT available</td>
                      <td>NOT available</td>
                  </tr>
                  <?php
              }
          ?>

					</tbody>
				</table>
	
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