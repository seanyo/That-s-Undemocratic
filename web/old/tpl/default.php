<?php

// TODO Handle Submission

function theme_options($name,$opts) {
	$ret = '<div class="options">';
	$x = 0;

	foreach( $opts as $o ) {
		$x++;
		$ret .= '<label for="'.$name.'-'.$x.'"'.( ($x==count($opts))?' class="last"':'' ).'>'
			.'<input type="radio" name='.$name.' id="'.$name.'-'.$x.'" value="'.$x.'"/>'
			.'<span>'.$o.'</span>'
			.'</label>';
	}

	return $ret.'</div>';
}

?>
<p>Welcome to the Hates The Internet QSL Card Generator. If you're here it's probably because I dropped the URL during a podcast and thanks in advance for playing along. Please take a couple seconds to fill out the form below and we'll generate you your very own QSL card right on the spot.</p>
<p><strong>How would you rate the audio quality?</strong><br/>Was the sound distorted? Could you year everything? Was the music annoyingly louder than the talking?</p>
<?php echo theme_options('sound_quality',array('Horrible','Decent','Okay','Good','Awesome')); ?>
<p><strong>How would you rate the streaming?</strong><br/>Did the live stream buffer quickly? Did it play smoothly or were there dropouts? At any point did it sound like aliens eating the host's feet?</p>
<?php echo theme_options('stream_quality',array('Horrible','Decent','Okay','Good','Awesome')); ?>
<p><strong>How did the player perform?</strong><br/>Did your computer's fan run constantly? If there were visualizations, did they work? Were they smooth?</p>
<?php echo theme_options('player_quality',array('Horrible','Decent','Okay','Good','Awesome')); ?>
