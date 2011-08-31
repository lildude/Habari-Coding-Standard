<?php
/**
 * Modified copy of Squiz_Sniffs_Functions_FunctionDeclarationSniff.
 *
 * This doesn't seem to do what I was hoping it would do.  Using Generic.Functions.OpeningFunctionBraceBsdAllman for the moment.
 * 
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: FunctionDeclarationSniff.php 274897 2009-01-29 23:39:52Z squiz $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

if (class_exists('PHP_CodeSniffer_Standards_AbstractPatternSniff', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_AbstractPatternSniff not found');
}

/**
 * Squiz_Sniffs_Functions_FunctionDeclarationSniff.
 *
 * Checks the function declaration is correct.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: 1.3.0RC1
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class HabariCodingStandard_Sniffs_Functions_FunctionDeclarationSniff extends PHP_CodeSniffer_Standards_AbstractPatternSniff
{


    /**
     * Returns an array of patterns to check are correct.
     *
     * @return array
     */
    protected function getPatterns()
    {
        return array(
                'function abc(...) EOL{...EOL}',
				'public function abc(...) EOL{...EOL}',
				'public static function abc(...) EOL{...EOL}',
				'private function abc(...) EOL{...EOL}',
				'private static function abc(...) EOL{...EOL}',
				'protected function abc(...) EOL{...EOL}',
				'protected static function abc(...) EOL{...EOL}',
                'abstract function abc(...) EOL{...EOL}',
			   );


    }//end getPatterns()


}//end class

?>
