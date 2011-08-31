<?php
/**
 * Inverse of Generic_Sniffs_PHP_UpperCaseConstantSniff.
 *
 * Checks that all uses of TRUE, FALSE and NULL are LOWERcase.
 *
 * We can not test for the user of true/false instead of a numerical figure as
 * we can't be sure if the assignment values are meant as numbers or bools.
 */
class HabariCodingStandard_Sniffs_PHP_BooleanValuesSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
                T_TRUE,
                T_FALSE,
                T_NULL,
               );

    }//end register()


    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $keyword = $tokens[$stackPtr]['content'];
        if (strtolower($keyword) !== $keyword) {
            $error = 'true, false and null must be lowercase; expected "%s" but found "%s"';
            $data  = array(
                      strtolower($keyword),
                      $keyword,
                     );
            $phpcsFile->addError($error, $stackPtr, 'Found', $data);
        }

    }//end process()


}//end class

?>
