<?php
// Arrays should be formatted with a space separating each element and assignment operator.

$some_array = array( 'hello', 'world', 'foo'=> 'bar' );

// Longer array declarations should be wrapped to multiple lines, one element per line, and indented one level.
$some_long_array = array (
	'hello',
	'world',
	'foo' => 'bar',
	'second_level' => array(
		'foo' => 'bar'
	),
);

?>