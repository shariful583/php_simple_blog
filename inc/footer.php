</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
        <?php
        $query = "SELECT * FROM tbl_footer WHERE id = '1'";
        $result = $db->select($query);
        if($result) {
            while ($site = $result->fetch_object()) {
                ?>
                <p>&copy; <?php echo $site->copy; echo " "; echo date('Y'); ?></p>
                <?php
            }
        }
        ?>
	</div>
	<div class="fixedicon clear">

        <?php
        $query = "SELECT * FROM tbl_social WHERE id = '1'";
        $result = $db->select($query);
        if($result) {
            while ($site = $result->fetch_object()) {
                ?>
                <a href="<?php echo $site->facebook; ?>"><img src="images/fb.png" alt="Facebook"/></a>
                <a href="<?php echo $site->twitter; ?>"><img src="images/tw.png" alt="Twitter"/></a>
                <a href="<?php echo $site->linkdin; ?>"><img src="images/in.png" alt="LinkedIn"/></a>
                <a href="<?php echo $site->gplus; ?>"><img src="images/gl.png" alt="GooglePlus"/></a>

                <?php
            }
        }
        ?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>