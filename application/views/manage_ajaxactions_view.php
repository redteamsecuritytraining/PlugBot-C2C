<?php if ($status == '1'): ?><img src="<?php echo base_url(); ?>img/icons/small/loading.gif" alt="edit job" border="0" />
    <a href="<?php echo base_url().'login/delJob/'.$id.'/'.$token; ?>"><img src="<?php echo base_url().'img/icons/small/Erase.png'?>" onclick="return confirm('Are you sure you want to delete this Job?')" /></a>
<?php endif;?>

<?php if ($status == '2'): ?><img src="<?php echo base_url(); ?>img/icons/small/loading.gif" alt="edit job" border="0" />
<?php endif;?>

<?php if ($status == '8'): ?><img src="<?php echo base_url(); ?>img/icons/small/dloadfolder.png"  border="0" title="Output is saved on the Bot" /> <a href="<?php echo base_url().'login/delJob/'.$id.'/'.$token; ?>"><img src="<?php echo base_url().'img/icons/small/Erase.png'?>" onclick="return confirm('Are you sure you want to delete this Job?')" /></a> <?php endif;?>

<?php if ($status == '9'): ?><img src="<?php echo base_url(); ?>img/icons/small/bot.png"  border="0" /> <a href="<?php echo base_url().'login/delJob/'.$id.'/'.$token; ?>"><img src="<?php echo base_url().'img/icons/small/Erase.png'?>" onclick="return confirm('Are you sure you want to delete this Job?')" /></a>
<?php endif;?> 

<?php if ($status == '10'): ?><a href="<?php echo base_url(); ?>login/viewoutput/<?php echo $id; ?>" title="View Output"><img src="<?php echo base_url(); ?>img/icons/small/preview.png" alt="View Output" border="0" /></a>
    <a href="<?php echo base_url().'login/delJob/'.$id.'/'.$token; ?>"> <img src="<?php echo base_url().'img/icons/small/Erase.png'?>" onclick="return confirm('Are you sure you want to delete this Job?')" /></a>
<?php endif; ?>
