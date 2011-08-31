<?php

// Functions, whether global or class scope, should follow the same naming standard as variables.

// global
function _t( $text, $domain = 'habari' )
{ 
	return true;
}

// class
class Foo {
	public function get_results( $query, $args = array() )
	{
		return true;
	}
	private function add_error( $error )
	{
		return true;
	}
	protected function load_tables()
	{
		return true;
	}
}

function foo()
{
	return true;
}
?>
