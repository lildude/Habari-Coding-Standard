<?php
// Functions (regardless of scope) should be declared using the following format:

class Foo
{
	public function abc($bar = '') {
		$a = $b;
	}

	public static function abc( $bar = '' ){ $a = $b; }

	static private function abc ( $bar = '' )
	{
		$a = $b;
	}
}

// The opening and closing braces should be on their own line.
// Note that [public|private|protected] should always come first in the function declaration (if declaring a class method). The static declaration is secondary.

?>