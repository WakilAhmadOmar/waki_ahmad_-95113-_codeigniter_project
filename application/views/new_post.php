<! DOCTYPE html>
<html>
<head>
<title> New Post</title>
</head>
<body>

<?php $this->load->helper('form');
echo form_open (site_url('home/add/')) ?>
<table>
<tr>
<td>
<?php echo $this->lang->line('title_message')?>
</td>
<td>
<input type=" text" name="title" />
</td>
</tr>
<tr>
<td>
<?php echo $this->lang->line('body_message')?>
</td>
<td>
<textarea name="body" cols=" 31" rows=" 12" ></textarea>
</td>
</tr>
<tr>
<td>
</td>
<td>
    <!-- <button type="submit" name="submit"></button> -->
<input type="submit" name="submit" value="<?php echo $this->lang->line('add_message')?>" />
</td>
</tr>
</table>
</body>
</html>