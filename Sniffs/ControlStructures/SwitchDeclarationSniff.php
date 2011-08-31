<?php
/**
 * Copy of Squiz_Sniffs_ControlStructures_SwitchDeclarationSniff.
 *
 */
class HabariCodingStandard_Sniffs_ControlStructures_SwitchDeclarationSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array(
                                   'PHP',
                                   'JS',
                                  );


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_SWITCH);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
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

        // We can't process SWITCH statements unless we know where they start and end.
        if (isset($tokens[$stackPtr]['scope_opener']) === false
            || isset($tokens[$stackPtr]['scope_closer']) === false
        ) {
            return;
        }

        $switch        = $tokens[$stackPtr];
        $nextCase      = $stackPtr;
        $caseAlignment = ($switch['column'] + 1);
        $caseCount     = 0;

        while (($nextCase = $phpcsFile->findNext(array(T_CASE, T_SWITCH), ($nextCase + 1), $switch['scope_closer'])) !== false) {
            // Skip nested SWITCH statements; they are handled on their own.
            if ($tokens[$nextCase]['code'] === T_SWITCH) {
                $nextCase = $tokens[$nextCase]['scope_closer'];
                continue;
            }

            $caseCount++;

            $content = $tokens[$nextCase]['content'];
            if ($content !== strtolower($content)) {
                $expected = strtolower($content);
                $error    = "CASE keyword must be lowercase; expected \"$expected\" but found \"$content\"";
                $phpcsFile->addError($error, $nextCase);
            }

            if ($tokens[$nextCase]['column'] !== $caseAlignment) {
                $error = 'CASE keyword must be indented 1 tab from SWITCH keyword';
                $phpcsFile->addError($error, $nextCase, 'CaseIndent');
            }

            if ($tokens[($nextCase + 1)]['type'] !== 'T_WHITESPACE' || $tokens[($nextCase + 1)]['content'] !== ' ') {
                $error = 'CASE keyword must be followed by a single space';
                $phpcsFile->addError($error, $nextCase, 'SpacingAfterCase');
            }

            $opener = $tokens[$nextCase]['scope_opener'];
            if ($tokens[($opener - 1)]['type'] === 'T_WHITESPACE') {
                $error = 'There must be no space before the colon in a CASE statement';
                $phpcsFile->addError($error, $nextCase, 'SpaceBeforeColon');
            }

            $nextBreak = $phpcsFile->findNext(array(T_BREAK), ($nextCase + 1), $switch['scope_closer']);
            if ($nextBreak !== false && isset($tokens[$nextBreak]['scope_condition']) === true) {
                // Only check this BREAK statement if it matches the current CASE
                // statement. This stops the same break (used for multiple CASEs) being
                // checked more than once.
                if ($tokens[$nextBreak]['scope_condition'] === $nextCase) {
                    if ($tokens[$nextBreak]['column'] !== $caseAlignment + 1) {
                        $error = 'BREAK statement must be indented 2 tabs from SWITCH keyword';
                        $phpcsFile->addError($error, $nextBreak, 'BreakIndent');
                    }

                    /*
                        Ensure empty CASE statements are not allowed.
                        They must have some code content in them. A comment is not
                        enough.
                    */
					/* CNS: Habari allows empty case statements at the moment
                    $foundContent = false;
                    for ($i = ($tokens[$nextCase]['scope_opener'] + 1); $i < $nextBreak; $i++) {
                        if ($tokens[$i]['code'] === T_CASE) {
                            $i = $tokens[$i]['scope_opener'];
                            continue;
                        }

                        if (in_array($tokens[$i]['code'], PHP_CodeSniffer_Tokens::$emptyTokens) === false) {
                            $foundContent = true;
                            break;
                        }
                    }

                    if ($foundContent === false) {
                        $error = 'Empty CASE statements are not allowed';
                        $phpcsFile->addError($error, $nextCase, 'EmptyCase');
                    }
					*/
                    /*
                        Ensure there is no blank line before
                        the BREAK statement.
                    */

                    $breakLine = $tokens[$nextBreak]['line'];
                    $prevLine  = 0;
                    for ($i = ($nextBreak - 1); $i > $stackPtr; $i--) {
                        if ($tokens[$i]['type'] !== 'T_WHITESPACE') {
                            $prevLine = $tokens[$i]['line'];
                            break;
                        }
                    }

                }//end if
            } else {
                $nextBreak = $tokens[$nextCase]['scope_closer'];
            }//end if

        }//end while

        $default = $phpcsFile->findPrevious(T_DEFAULT, $switch['scope_closer'], $switch['scope_opener']);

        // Make sure this default belongs to us.
        if ($default !== false) {
            $conditions = array_keys($tokens[$default]['conditions']);
            $owner      = array_pop($conditions);
            if ($owner !== $stackPtr) {
                $default = false;
            }
        }

        if ($default !== false) {
            $content = $tokens[$default]['content'];
            if ($content !== strtolower($content)) {
                $expected = strtolower($content);
                $error    = 'DEFAULT keyword must be lowercase; expected "%s" but found "%s"';
                $data     = array(
                             $expected,
                             $content,
                            );
                $phpcsFile->addError($error, $default, 'DefaultNotLower', $data);
            }

            $opener = $tokens[$default]['scope_opener'];
            if ($tokens[($opener - 1)]['type'] === 'T_WHITESPACE') {
                $error = 'There must be no space before the colon in a DEFAULT statement';
                $phpcsFile->addError($error, $default, 'SpacingBeforeDefaultColon');
            }

            if ($tokens[$default]['column'] !== $caseAlignment) {
                $error = 'DEFAULT keyword must be indented 1 tab from SWITCH keyword';
                $phpcsFile->addError($error, $default, 'DefaultIndent');
            }

            $nextBreak = $phpcsFile->findNext(array(T_BREAK), ($default + 1), $switch['scope_closer']);
            if ($nextBreak !== false) {
                if ($tokens[$nextBreak]['column'] !== $caseAlignment + 1) {
                    $error = 'BREAK statement must be indented 2 tabs from SWITCH keyword';
                    $phpcsFile->addError($error, $nextBreak, 'BreakIndent');
                }

            } /* CNS: Habari doesn't require default to have break  else {
                $error = 'DEFAULT case must have a BREAK statement';
                $phpcsFile->addError($error, $default, 'DefaultNoBreak');

                $nextBreak = $tokens[$default]['scope_closer'];
            }//end if
			*/
            /*
                Ensure empty DEFAULT statements are not allowed.
                They must (at least) have a comment describing why
                the default case is being ignored.
            */

			/* CNS: We don't need comment in Habari
            $foundContent = false;
            for ($i = ($tokens[$default]['scope_opener'] + 1); $i < $nextBreak; $i++) {
                if ($tokens[$i]['type'] !== 'T_WHITESPACE') {
                    $foundContent = true;
                    break;
                }
            }

            if ($foundContent === false) {
                $error = 'Comment required for empty DEFAULT case';
                $phpcsFile->addError($error, $default, 'EmptyDefault');
            }
			*/
        } /* CNS: Habari doesn't require a default statement  else {
            $error = 'All SWITCH statements must contain a DEFAULT case';
            $phpcsFile->addError($error, $stackPtr, 'MissingDefault');
        }//end if
		*/
        if ($tokens[$switch['scope_closer']]['column'] !== $switch['column']) {
            $error = 'Closing brace of SWITCH statement must be aligned with SWITCH keyword';
            $phpcsFile->addError($error, $switch['scope_closer'], 'CloseBraceAlign');
        }

        if ($caseCount === 0) {
            $error = 'SWITCH statements must contain at least one CASE statement';
            $phpcsFile->addError($error, $stackPtr, 'MissingCase');
        }

    }//end process()


}//end class

?>
