<! DOCTYPE html>
<html>
<head>
<title>
<?php echo $title ?>
</title>
<link href="<?php echo base_url('bootstrap/css/some_veiw_style.css');?>"rel="stylesheet" >
</head>
<body>
    <table class="totalMassege">
        <thead class="header_table">
            <td><?php echo $this->lang->line('title_message')?></td>
            <td><?php echo $this->lang->line('body_message')?></td>
            <td><?php echo $this->lang->line('action_message')?></td>
        </thead>
        <?php 
        foreach($posts as $raw): $id=$raw->ID;?>
    
        <tr>
            <td class="title_message"><?php echo $raw->title?></td>
            <td class="td_body_message"><?php echo"<p>". substr( strip_tags($raw->body), 0,50). " ... " . " </p>";?>
            <a href="<?php echo site_url('Home/details/'.$id); ?>"><?php echo $this->lang->line('read_more')?>
            </a> </td>
            <td class="Action"><a href="<?php echo site_url('Home/delete/'.$id);?>" class="delete"> <?php echo $this->lang->line('delete')?></a>|
            <a href="<?php echo site_url('Home/update_post/'.$id); ?>" class="edit"> <?php echo $this->lang->line('edit')?></a></td>
        <tr>
        <?php endforeach ;?>
    </table>


<?php echo" </br>" .$this->pagination->create_links() ; ?>
</body>
</html>