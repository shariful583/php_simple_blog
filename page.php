<?php include 'inc/header.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
            <?php
              if(isset($_GET['page_id'])) {
                  $page_id = $_GET['page_id'];
                  $query = "SELECT * FROM tbl_page WHERE id = '$page_id'";
                  $result = $db->select($query);
                  if ($result) {
                      while ($site = $result->fetch_object()) {
                          ?>

                          <div class="about">
                              <h2><?php echo $site->title; ?></h2>
                              <?php echo $site->body; ?>
                          </div>

                          <?php
                      }
                  }
              }
          ?>

		</div>


		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>