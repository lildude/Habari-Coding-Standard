<?php
/**
 * PEAR_Sniffs_NamingConventions_ValidVariableNameSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: ValidVariableNameSniff.php 301632 2010-07-28 01:57:56Z squiz $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

if (class_exists('PHP_CodeSniffer_Standards_AbstractVariableSniff', true) === false) {
    $error = 'Class PHP_CodeSniffer_Standards_AbstractVariableSniff not found';
    throw new PHP_CodeSniffer_Exception($error);
}

/**
 * PEAR_Sniffs_NamingConventions_ValidVariableNameSniff.
 *
 * Checks the naming of member variables.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: 1.3.0RC1
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class HabariCodingStandard_Sniffs_NamingConventions_VariableNameSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff
{


    /**
     * Processes class member variables.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    protected function processMemberVar(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $varProps = $phpcsFile->getMemberProperties($stackPtr);
        if (empty($varProps) === true) {
            return;
        }

        $varName = ltrim($tokens[$stackPtr]['content'], '$');

		// Make sure there are no capital letters.
        if (preg_match('|[A-Z]|', $varName) !== 0) {
			$error = '$%s name must be all lowercase with words separated by underscores. Do not use camelCaseNames.';
			$data = array($varName);
            $phpcsFile->addError($error, $stackPtr, 'NotAllLowerCase', $data);
        }

    }//end processMemberVar()


    /**
     * Processes normal variables.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
     * @param int                  $stackPtr  The position where the token was found.
     *
     * @return void
     */
    protected function processVariable(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
		$tokens  = $phpcsFile->getTokens();
        $varName = ltrim($tokens[$stackPtr]['content'], '$');

        $phpReservedVars = array(
                            '_SERVER',
                            '_GET',
                            '_POST',
                            '_REQUEST',
                            '_SESSION',
                            '_ENV',
                            '_COOKIE',
                            '_FILES',
                            'GLOBALS',
                           );

        // If it's a php reserved var, then its ok.
        if (in_array($varName, $phpReservedVars) === true) {
            return;
        }

		if (preg_match('|[A-Z]|', $varName) !== 0) {
			$error = '$%s name must be all lowercase with words separated by underscores. Do not use camelCaseNames.';
			$data = array($varName);
            $phpcsFile->addError($error, $stackPtr, 'NotAllLowerCase', $data);
        } 
    }//end processVariable()


    /**
     * Processes variables in double quoted strings.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
     * @param int                  $stackPtr  The position where the token was found.
     *
     * @return void
     */
    protected function processVariableInString(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        // We don't care about normal variables.
        return;

    }//end processVariableInString()


}//end class

?>
