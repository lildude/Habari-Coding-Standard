<?php
// Functions (regardless of scope) should be declared using the following format:

class Foo
{
	
	public function foo( $bar = '' )
	{
		$a = $b;
	}

	public static function foo( $bar = '' )
	{
		$a = $b;
	}

	private function foo( $bar = '' )
	{
		$a = $b;
	}

	private static function foo( $bar = '' )
	{
		$a = $b;
	}

	protected function foo( $bar = '' )
	{
		$a = $b;
	}

	protected static function foo( $bar = '' )
	{
		$a = $b;
	}
}
// The opening and closing braces should be on their own line.
// Note that [public|private|protected] should always come first in the function declaration (if declaring a class method). The static declaration is secondary.

?>