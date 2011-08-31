<?php
/* When including code stored in external files, the include_once and require_once
 * statements are preferred (over simply include and require), as they prevent
 * possible duplicate calls. While these are statements and not functions,
 * parenthesis should be used.
 */

include_once 'some_conditionally_required_file.php';
require_once 'some_unconditionally_required_file.php';

include('foo.php');
require('bar.php' );

?>