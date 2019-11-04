<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php'; ?>
<?php
$db = new Database ();
$data = new Format();
?>

<!DOCTYPE html>
<html>
<head>
    <?php
        if(isset($_GET['page_id'])) {
            $page_id = $_GET['page_id'];
            $query = "SELECT * FROM tbl_page WHERE id = '$page_id'";
            $result = $db->select($query);
            if ($result) {
                while ($site = $result->fetch_object()) {
                    ?>
                    <title><?php echo $site->title; ?> - <?php echo TITLE; ?></title>

                    <?php
                }
            }
        }

    elseif(isset($_GET['id'])) {
        $page_id = $_GET['id'];
        $query = "SELECT * FROM tbl_post WHERE id = '$page_id'";
        $result = $db->select($query);
        if ($result) {
            while ($site = $result->fetch_object()) {
                ?>
                <title><?php echo $site->title; ?> - <?php echo TITLE; ?></title>

                <?php
            }
        }
    }

        elseif(isset($_GET['category'])) {
            $page_id = $_GET['category'];
            $query = "SELECT * FROM tbl_category WHERE id = '$page_id'";
            $result = $db->select($query);
            if ($result) {
                while ($site = $result->fetch_object()) {
                    ?>
                    <title><?php echo $site->category; ?> - <?php echo TITLE; ?></title>

                    <?php
                }
            }
        }

    else {
            ?>
            <title><?php echo $data->title(); ?> - <?php echo TITLE; ?></title>
            <?php
        }
    ?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">

                <?php
                $query = "SELECT * FROM tbl_site_info WHERE id = '1'";
                $result = $db->select($query);
                if($result) {
                    while ($site = $result->fetch_object()) {
                        ?>

                        <img src="admin/<?php echo $site->logo; ?>" alt="Logo"/>
                        <h2><?php echo $site->title; ?></h2>
                        <p><?php echo $site->slogan; ?></p>
                        <?php
                    }
                }
                ?>


			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
                <?php
                $query = "SELECT * FROM tbl_social WHERE id = '1'";
                $result = $db->select($query);
                if($result) {
                    while ($site = $result->fetch_object()) {
                        ?>

                        <a href="<?php echo $site->facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo $site->twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="<?php echo $site->linkdin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="<?php echo $site->gplus; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>

                        <?php
                    }
                }
                ?>

			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="GET">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a
                    <?php
                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $path = basename($path, '.php');
                    if($path == 'index'){
                        echo "id='active'";
                    }

                    ?>href="index.php">Home</a></li>
        <?php
        $query = "SELECT * FROM tbl_page";
        $result = $db->select($query);
        if($result) {
            while ($site = $result->fetch_object()) {
                ?>

                <li><a
                        <?php
                            if(isset($_GET['page_id']) && $_GET['page_id'] == $site->id){
                                echo "id='active'";
                            }
                            ?>
                            href="page.php?page_id=<?php echo $site->id; ?>"><?php echo $site->title; ?></a></li>
                <?php
            }
        }
        ?>
		<li><a <?php
                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $path = basename($path, '.php');
                    if($path == 'contact'){
                        echo "id='active'";
                    }
                    ?>
                    href="contact.php">Contact</a></li>
	</ul>
</div>