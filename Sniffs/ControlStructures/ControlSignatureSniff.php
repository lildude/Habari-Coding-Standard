<?php
/**
 * Verifies that control statements conform to their coding standards.
 *
 * This is a copy of the PEAR file modified to suit Habari needs.
 *
 */
class HabariCodingStandard_Sniffs_ControlStructures_ControlSignatureSniff extends PHP_CodeSniffer_Standards_AbstractPatternSniff
{


    /**
     * Constructs a HabariCodingStandard_Sniffs_ControlStructures_ControlSignatureSniff.
     */
    public function __construct()
    {
        parent::__construct(true);

    }//end __construct()


    /**
     * Returns the patterns that this test wishes to verify.
     *
     * @return array(string)
     */
    protected function getPatterns()
    {
        return array(
				'try {EOL...}EOLcatch (...) {EOL',
                'do {EOL...}EOLwhile ( ... );EOL',
                'while (...) {EOL',
                'for (...) {EOL',
				'if (...) {...}',
                'if (...) {EOL',
                'foreach (...) {EOL',
                '}EOLelse if (...) {EOL',	// These don't work
                '}EOLelseif (...) {EOL',	//
                '}EOLelse {EOL',			//
                'do {EOL',
				);

    }//end getPatterns()


}//end class

?>
