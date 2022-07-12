<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");
require 'vendor/autoload.php';	
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
	// AWS Info
$bucketName = $custombucket;
$IAM_KEY = 'AKIARWF5OIDP6KCGF2TG';
$IAM_SECRET = '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';

if(isset($_POST['Submit'])) {	
	echo $name = $_POST['name'];
	echo $age = $_POST['age'];
	echo $email = $_POST['email'];
	
		
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {

		
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}

        if(isset($_FILES["anyfile"]) && $_FILES["anyfile"]["error"] == 0){
        	echo "<font color='red'>Upload an valid image.</font><br/>";
        }
        //link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		echo "hello s3 aws";
			try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => $customorigin
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}

	
	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$keyName = 'uploads/' . basename($_FILES["anyfile"]['name']);
	echo $keyname;
	$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;

	echo $pathInS3;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["anyfile"]['tmp_name'];

		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY'
			)
		);

	} catch (S3Exception $e) {
		die('Error:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error:' . $e->getMessage());
	}


	echo 'Done';

	// Now that you have it working, I recommend adding some checks on the files.
	// Example: Max size, allowed file types, etc.
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO users(name,age,email,image) VALUES('$name','$age','$email','$pathInS3')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
