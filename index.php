<?php
include ("connection.php");
session_start();

$cmd = $_REQUEST['cmd'];
switch ($cmd) {
    case "upload":
        if (strlen($_FILES['file_picture']['name']) > 0 && $_FILES['file_picture']['size'] > 0) {
              $destionation  = "images/".$_FILES['file_picture']['name'];
			 $status =  move_uploaded_file($_FILES['file_picture']['tmp_name'],$destionation);
			 if($status==FALSE)
			 {
				 exit;
				 echo "Fail";
			 }
        }
		$sql = "INSERT into files (subject,file_picture) VALUES('".$_REQUEST['subject']."','".$destionation."')";
		$result = $conn->query($sql);
		if($result)
		{
			$message = "Data has been saved";
		}
		else
		{
			$message = "Error Occured";
		}
		include ("form.php"); 
        break;
    case "list":
        $sql = "SELECT * from files";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $arr = array();
            $i = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                while (list ($key, $value) = each($data))
                    $arr[$i][$key] = $value;
                $i ++;
            }
        }
        include ("list.php");
        break;
    case "download":
        $sql = "SELECT * from files WHERE id='" . $_REQUEST['id'] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $arr = array();
            $i = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                while (list ($key, $value) = each($data))
                    $arr[$i][$key] = $value;
                $i ++;
            }
        }
        // Download
        $path = $arr[0]['file_picture'];
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=" . basename($path));
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize("$path"));
        readfile($path);
        exit();
        break;
    case "delete_file":
        $sql = "SELECT * from files WHERE id='" . $_REQUEST['id'] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $arr = array();
            $i = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                while (list ($key, $value) = each($data))
                    $arr[$i][$key] = $value;
                $i ++;
            }
        }
        $path = $arr[0]['file_picture'];
        unlink($path);

        $sql = "DELETE from files WHERE id='" . $_REQUEST['id'] . "'";
        $result = $conn->query($sql);
        include ("list.php");
        break;
    default:
        include ("form.php");
}
?>