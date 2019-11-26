<! DOCTYPE html>
<html>
<head>
<title>
<?php echo $title ?>
</title>
<style> 
td{
    padding:10px;
}

</style>
</head>
<body>
<table border='2'>
    <thead style="background-color: #ccc; padding:10px">
        <td><?php echo $this->lang->line('name')?></td>
        <td><?php echo $this->lang->line('last_name')?></td>
        <td><?php echo $this->lang->line('email')?></td>
    </thead >
<?php
foreach ($user as $raw): ?>
<tr>
    <td><?php echo $raw->name?></td>
    <td><?php echo $raw->lname?></td>
    <td><?php echo $raw->email?></td>
</tr>


<?php
$id=$raw->user_id;
?>
 
<?php endforeach ;?>
</table>
<?php echo"</br>" .$this->pagination->create_links() ; ?>
</body>
</html>