<h2><?php echo $title; ?></h2>
<div class="gallery">
<?php foreach( $memes as $meme ) : 
$txt = ucwords(strtolower(htmlentities(strip_tags($meme['meme_top']))." ".htmlentities(strip_tags($meme['meme_bot']))));
?>
<div class="thumb">
<a href="<?php echo $meme['meme_page']; ?>">
<img src="<?php echo $meme['meme_small']; ?>" width="90" height="90" alt="<?php echo $txt; ?>" title="<?php echo $txt; ?>"/>
</a>
<?php endforeach; ?>
<div class="pager">
<?php for( $x=0;$x<$pages;$x++ ) : ?>
<a href="/meme<?php if( $x > 0 ) : ?>?page=<?php echo $x+1; ?><?php endif; ?>"<?php if( $x==$page ) echo ' class="current"'; ?>><?php echo $x+1; ?></a>
<?php endfor; ?>
</div>
<?php /*
</div>
<p>Requested meme with no meme ID. Here are the 15 latest memes (accessible via $memes):</p>
<pre>
<?php print_r($memes); ?>
</pre>
 */?>
