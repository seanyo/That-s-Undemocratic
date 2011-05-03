<!-- This is tpl/default.php -->
  <div class="grid_12">
    <p id="intro">Join us in having some fun with this election. Add your own text to the image by just filling in the top and bottom boxes below and then click submit! Share the link with all your friend and see what others have posted in the Gallery below on the right.</p>
  <div>
  <div class="grid_7 alpha" style="background:url(http://thatsundemocratic.ca/sharper.jpg);background-repeat:no-repeat;min-height:500px;"> 
    <form name="undemocratic" action="http://thatsundemocratic.ca/create" method="post"> 
      <input id="captionOne" type="text" name="captionOne" maxlength="48" value="Put Your Text Here!"/> <br/> 
      <input id="captionTwo" type="text" name="captionTwo" maxlength="24" value="That's Undemocratic"/> <br/> 
      <input id="submit" name="submit" type="submit" value="Submit"/> 
    </form> 
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
