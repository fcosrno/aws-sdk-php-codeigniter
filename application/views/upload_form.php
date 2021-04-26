<!DOCTYPE html>
<html lang="en">
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error; ?>

<?php echo form_open_multipart('/index.php/upload/do_upload'); ?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>