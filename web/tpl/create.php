<?php
/*
 * This file is shown when the user visits /create without 
 * any caption data being submitted.
 */
?>
<!-- This is tpl/create.php -->
<div id="content">
<img src="/img/logo.png" alt="That's Undemocratic Logo"/>
<form name="undemocratic" action="/create" method="post">
Caption One: <input type="text" name="captionOne"/><br/>
Caption Two: <input type="text" name="captionTwo"/>
<input name="submit" type="submit" value="Submit"/>
</form>
</div>

