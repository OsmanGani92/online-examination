<?php

//index.php

include('admin/soes.php');

$object = new soes();

if($object->is_student_login())
{
	header("location:".$object->base_url."exam.php");
}

$message = '';
if(isset($_GET["type"], $_GET["code"]))
{
	$data = array(
		':student_email_verification_code'		=>	$_GET["code"]
	);
	$object->query = "
	SELECT * FROM student_soes 
	WHERE student_email_verification_code = :student_email_verification_code
	";

	$object->execute($data);

	$total_row = $object->row_count();

	if($total_row == 0)
	{
		$message = '<div class="alert alert-danger"><h2 class="text-center">Invalid Url</h2></div>';
	}
	else
	{
		$result = $object->statement_result();

		foreach($result as $row)
		{
			if($row['student_email_verified'] == 'Yes')
			{
				$message = '<div class="alert alert-info"><h2 class="text-center">Hey <b>'.$row["student_name"].'</b> your <b>'.$row["student_email_id"].'</b> email address already verified, so you can login into system by click <a href="login.php">here</a></h2></div>';
			}
			else
			{
				$data = array(
					':student_email_verified'		=>	'Yes',
					':student_id'					=>	$row['student_id']
				);

				$object->query = "
				UPDATE student_soes 
				SET student_email_verified = :student_email_verified 
				WHERE student_id = :student_id
				";

				$object->execute($data);

				require_once('class/class.phpmailer.php');

				$subject = 'Online Student Exam System Password Detail';

				$body = '
				<p>Hello '.$row["student_name"].'.</p>
				<p>Your email is scuccessfully verify, so now you can login into this Online Student Exam System by visiting <a href="'.$object->base_url.'login.php" target="_blank"><b>'.$object->base_url.'login.php</a></b> this link. </a></p>
				<p>In case if you have any difficulty please eMail us.</p>
				<p>Thank you,</p>
				<p>Online Student Exam System</p>
				';

				$object->send_email($row["student_email_id"], $subject, $body);

				$message = '<div class="alert alert-success"><h3 class="text-center">Hey <b>'.$row["student_name"].', </b> your <b>'.$row["student_email_id"].'</b> email address has been successfully verified. You can login into system by clicking <a href="login.php">here</a></b></h3> <br>
				</div>';
			}
		}
	}

}
else
{
	$message = '<div class="alert alert-danger"><h2 class="text-center">Invalid Url</h2></div>';
}

include('header.php');

echo $message;

?>

				
		    

<?php

include('footer.php');

?>