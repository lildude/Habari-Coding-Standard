Habari Coding Standard
======================

This directory contains the coding standards rules that PHP_CodeSniffer uses in
order to verify if the Habari source is complying with the coding standards defined
at:

http://wiki.habariproject.org/en/Dev:Coding_Standards

... and ...

http://wiki.habariproject.org/en/CSS_Coding_Standards


PHP_CodeSniffer
---------------

PHP_CodeSniffer is a PHP5 script that tokenises and "sniffs" PHP, JavaScript and
CSS files to detect violations of a defined coding standard. It is an essential
development tool that ensures your code remains clean and consistent. It can also
help prevent some common semantic errors made by developers.


Usage:
------

1.  Ensure you have the PHP_CodeSniffer PEAR module installed.
2.  Run one of the following commands, depending on what you want to check:

	- Check entire Habari directory and produce a summary report:

	$ phpcs --standard=/path/to/HabariCodingStandard --report=summary /path/to/habari

	- Check a single file and report all problems:

	$ phpcs --standard=/path/to/HabariCodingStandard /path/to/habari/file.php


More detailed instructions can be found at http://pear.php.net/manual/en/package.php.php-codesniffer.php

Things to query about the Habari standard:

- Should we allow inline assignment and usage of variables, ala (from autoload.php):
	if ( ( $site_user_dir = Site::get_dir( 'user' ) ) != HABARI_PATH . '/user' ) {