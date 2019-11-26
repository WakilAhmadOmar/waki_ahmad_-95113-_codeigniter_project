<h1><?php echo $this->lang->line('loginforme')?></h1>
<?php $this->load->helper('form')?>
<?php echo form_open(site_url('/User/login')) ; ?>
<table>
<tr>
<td><?php echo $this->lang->line('user_name')?>: </td>
<td><input type="text" name="username" /></td>
</tr>
<tr>
<td><?php echo $this->lang->line('password')?>: </td>
<td><input type="password" name="password" /></td>
</tr>
<tr>
<td><?php echo $this->lang->line('remember')?>: </td>
<td><input type="checkbox" name="remeber" /></td>
</tr>
</table>
<input type="submit" value="<?php echo $this->lang->line('login')?>" />