<?php include "../lib/Session.php";
Session::checkSession();
?>
<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/Format.php"; ?>

<?php
$db = new Database ();
$data = new Format();
?>
<?php
     if(!isset($_GET['del_id']) || $_GET['del_id'] == NULL){
         echo "<script>window.location = 'postlist.php';</script>";

     }

     else {
         $del = $_GET['del_id'];
         $query = "SELECT * FROM tbl_post WHERE id = '$del'";
         $del_post = $db->select($query);
         if($del_post){
             $post = $del_post->fetch_object();
             $del_link = $post->image;
             unlink($del_link);

         }

         $delete_query = "DELETE FROM tbl_post WHERE id = '$del'";
         $delete_file = $db->delete($delete_query);
         if($delete_file){
             echo "<script>window.alert('Delete ' +'Successfull')</script>";
             echo "<script>window.location = 'postlist.php';</script>";
         }
         else{
             echo "<script>windows.alert('Delete ' +'Unsuccessfull')</script>";
             echo "<script>window.location = 'postlist.php';</script>";
         }

     }

?>