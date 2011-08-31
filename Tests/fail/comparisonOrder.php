<?php
if ( 'bar' == $foo ) {
	true;
}
if ( 0 == $post->id ) {
	false;
}
if ( "foo" > $bar ) {
	false;
}
if ( null != $bar ) {
	true;
}

$x = ( '1' >= $too );
?>
