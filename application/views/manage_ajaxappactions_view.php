
<?php if ($status == '1'): ?>
    <img src="<?php echo base_url(); ?>img/icons/small/loading.gif" border="0" alt="Installing..." />
<?php endif;?>
<a href="<?php echo base_url().'login/delApp/'.$id.'/'.$token; ?>" title="Delete App"><img src="<?php echo base_url(); ?>/img/icons/small/Erase.png" onclick="return confirm('Are you sure you want to delete this App?')"  alt="Delete job" border="0" /></a>