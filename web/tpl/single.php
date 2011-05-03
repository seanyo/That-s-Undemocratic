<?php
$txt = htmlentities(ucwords(strip_tags(strtolower(stripslashes($meme['meme_top']).' '.stripslashes($meme['meme_bot'])))));
?>
  <div class="grid_12">
  <h2><?php echo $txt; ?></h2>
    <p id="intro">Maybe put some sharing icons here?</p>
  <div>
  <div class="grid_7 alpha"> 
  <img src="<?php echo $meme['meme_image']; ?>" width="500" height="500" alt="<?php echo $txt; ?>" title="<?php echo $txt; ?>"/>
  </div> 
 
  <div class="grid_5 omega"> 
<div class="gallery">
<?php foreach( $memes as $meme ) : 
$txt = htmlentities(ucwords(strip_tags(strtolower(stripslashes($meme['meme_top']).' '.stripslashes($meme['meme_bot'])))));
?>
<div class="thumb">
<a href="/meme/<?php echo $meme['meme_hash'];?>">
<img src="<?php echo $meme['meme_small']; ?>" width="85" height="85" alt="<?php echo $txt; ?>" title="<?php echo $txt; ?>"/>
</a>
</div>
<?php endforeach; ?>
</div>
  </div> 
</div> 
</div></div></div> 
