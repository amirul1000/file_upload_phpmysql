<table width="100%" align="center">
	<tr>
		<td>subject</td>
		<td>file_picture</td>
		<td>Action</td>
	</tr>

<?php
for ($i = 0; $i < count($arr); $i ++) {
    ?>
<tr>
		<td>
  <?=$arr[$i]['subject']?>
</td>

		<td><img src="<?=$arr[$i]['file_picture']?>"
			style="width: 100px; height: 100px;"></td>
		<td><a href="index.php?cmd=download&id=<?=$arr[$i]['id']?>">Download</a> |
        <a href="index.php?cmd=delete_file&id=<?=$arr[$i]['id']?>">Delete</a>
		</td>
	</tr>
<?php
}
?>  
</table>

<a href="index.php">Upload</a>