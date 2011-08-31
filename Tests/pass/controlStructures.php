<?php

if ( $foo == 'bar' ) {
	$bar = 'foo';
} 
else if ( $post->id == 0 ) {
	$goo = 'loo';
} 
else {
	false;
}

do { 
	echo 'foo'; 
} 
while ( true );

for ( $x = 0; $x < 10; $x++ ) { 
	echo $x; 
}

while ( true ) { 
	echo "foo"; 
}

foreach ( $array as $x ) { 
	echo $x; 
}

try { 
	echo $x; 
} 
catch ( Exception $e ) { 
	echo 'Caught exception'; 
}
?>