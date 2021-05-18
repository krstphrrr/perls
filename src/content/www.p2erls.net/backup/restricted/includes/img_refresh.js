function reloadImage()
{
   img = document.getElementById('refresh');
   img.src = 'includes/pdf_prev_servlet.php?num=<?php echo "$site_id"; ?>&' + 
Math.random();
}
