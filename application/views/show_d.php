<! DOCTYPE html>
<html>
<head>
<title> Post Details</title>
</head>
<body>
<?php
 echo " <h2>" .$post->title. " </h2>";
echo $post->body. " </br>";

?>
<a href="<?php echo site_url('home/get_posts/') ?>"><?php echo $this->lang->line('back')?></a>

</body>
</html>