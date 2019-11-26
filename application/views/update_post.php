<! DOCTYPE html>
<html>
<head>
<title> Update Post</title>
</head>
<body>
<?php $this->load->helper('form')?>
<?php echo form_open(site_url('Home/update/').$post->ID)?>
<table>
<tr>
<td> Title </td>
<td>
<input type=" text" name="title" value=" <?php echo $post->title ?>" />
</td>
</tr>
<tr>
<td> Body </td>
<td>
<textarea name="body" cols=" 31" rows=" 12" > <?php echo $post->body ?></textarea>
</td>
</tr>
<tr>
<td> </td>
<td>
<input type="submit" name="submit" value="Update Post" />
</td>
</tr>
</table>
</body>
</html>