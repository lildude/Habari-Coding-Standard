<?php
/*if ( $foo == 'bar' ) {
	true;
}
if ( $post->id == 0 ) {
	false;
}
if ( $bar < "foo" ) {
	false;
}
if ( $bar != null ) {
	true;
}

$x = ( $too <= '1' );*/

class Foo
{
	public static $features = array( 'hierarchical', 'required', 'multiple', 'free' );
	public static function default_fields()
	{
		return array(
			'id' => 0,
			'name' => '',
			'description' => '',
			'features' => array(),
		);
	}
	
}


?>
