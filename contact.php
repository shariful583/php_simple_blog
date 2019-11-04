<?php include 'inc/header.php'; ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $data->validation($_POST['firstname']);
    $lastname = $data->validation($_POST['lastname']);
    $email = $data->validation($_POST['email']);
    $message = $data->validation($_POST['message']);

    $firstname = mysqli_real_escape_string($db->link, $firstname);
    $lastname = mysqli_real_escape_string($db->link, $lastname);
    $email = mysqli_real_escape_string($db->link, $email);
    $message = mysqli_real_escape_string($db->link, $message);
    $error = "";
    $msg = "";
    if(empty($firstname)){
        $error = "First name must not be empty";
    }
    elseif(empty($lastname)){
        $error = "Last name must not be empty";
    }
    elseif(empty($email)){
        $error = "Email must not be empty";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Email is invalid";
    }
    elseif(empty($message)){
        $error = "Message must not be empty";
    }
    else{
        $query = "INSERT INTO tbl_message(firstname, lastname, email, message)  VALUES('$firstname', '$lastname','$email','$message')";
        $inserted_rows = $db->insert($query);
        if($inserted_rows){
           $msg = "Message sent";
        }
        else{
            $msg =  "Message not sent";
        }
    }
}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
                <?php
                 if(isset($msg)){
                     echo $msg;
                 }
                 if(isset($error)){
                    echo $error;
                }
                ?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name = "message"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>