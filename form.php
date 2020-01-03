<?php
  if(isset($message))
  {
	echo $message;  
  }
?>

<form action="index.php" method="post" enctype="multipart/form-data">
   <input type="text" name="subject"><br>
   <input type="file" name="file_picture"><br>
   <input type="hidden" name="cmd" value="upload">
   <input type="submit" value="submit">
</form>
<a href="index.php?cmd=list">Show all Uploaded files</a>
