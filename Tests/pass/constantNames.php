<?php
// Constants, whether global or class scope, should be all-uppercase with words separated by underscores.

// global constants
define( 'DEBUG', true );
define( 'CACHE_CLASS', 'FileCache' );

// class constants
class Foo {
	const DB_VERSION = 1845;
	const HABARI_VERSION = '0.5-alpha';
}
?>