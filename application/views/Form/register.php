<h1> <?php echo $this->lang->line('new_user')?></h1>

<?php echo form_open_multipart('User/register_user') ; ?>
<table>
<tr>
<td><label for="name" ><?php echo $this->lang->line('name')?>: </label></td>
<!-- set_value is for if the error ocured the filled input remain-->
<td><input type="text" id="name" name="name" size="30" value=" <?php
echo set_value('name');?>"/></td>
<!-- show the error if form error exist-->
<td><?php echo form_error( 'name' ) ; ?></td>
</tr>
<tr>
<td><label for="lname"><?php echo $this->lang->line('last_name')?>:</label> </td>
<td><input type="text"id="lname" name="lname" size="30" value=" <?php
echo set_value('lname');?>" /></td>
<td><?php echo form_error('lname') ; ?></td>
</tr>
<tr>
<td><label for="uname" ><?php echo $this->lang->line('user_name')?>:</label> </td>
<td><input type="text" id="uname" name="uname" size="30" value=" <?php
echo set_value('uname');?>" /></td>
<td><?php echo form_error( 'uname' ) ; ?></td>
</tr>
<tr>
<td><label for="password"><?php echo $this->lang->line('password')?>: </label> </td>
<td><input type="password"id="password" name="password" size="30"
value=" <?php echo set_value('password');?>" /></td>
<td><?php echo form_error('password');?></td>
</tr>
<tr>
<td><label for="email" ><?php echo $this->lang->line('email')?>:</label> </td>
<td><input type="email" id="email" name="email" size="30" value=" <?php
echo set_value('email');?>" /></td>
<td><?php echo form_error('email');?></td>
</tr>
<tr>
<td><label for="file" ><?php echo $this->lang->line('image')?>: </label> </td>
<td><input type="file" id="file" name="userfile" size="30" /><div> 
    <?php if(isset($error)){echo $error; }?></div></td>
</tr>
</table>
<input type="submit" name="submit" value="<?php echo $this->lang->line('add_user')?>" />




