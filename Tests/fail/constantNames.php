<?php
// Constants, whether global or class scope, should be all-uppercase with words separated by underscores.

// global constants
define( 'debug', true );
define( 'Cache_CLASS', 'FileCache' );

// class constants
class Foo {
	const db_version = 1845;
	const HABARI_VERSION = '0.5-alpha';
}
?>