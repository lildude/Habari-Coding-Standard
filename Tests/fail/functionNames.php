<?php

// Functions, whether global or class scope, should follow the same naming standard as variables.

// global
function __t( $text, $domain = 'habari' )
{ 
	return true;
}

// class
class Foo
{
	public function get_Results( $query, $args = array() )
	{
		return true;
	}
	private function addError( $error )
	{
		return true;
	}
	protected function LoadTables()
	{
		return true;
	}
}

function Foo()
{
	return true;
}
?>
