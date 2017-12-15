<?php namespace MantasDone\ShortClosures;

class ShortClosure
{
    public static function generate($code, $params = [])
    {
        if (self::noArrowInCode($code)) {
            $code = self::addArrowAndVariable($code);
        }

        $function_variables = self::getFunctionVariables($code);
        $function_body = self::getFunctionBody($code);

        $anonymous_function = self::generateAnonymousFunction($function_variables, $function_body);

        return $anonymous_function;
    }

    // -------------------------------------------- private ------------------------------------------------------------

    private static function noArrowInCode($code)
    {
        return strstr($code, '~>') === false;
    }

    private static function addArrowAndVariable($code)
    {
        preg_match('/\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $code, $match); // regexp pattern from PHP manual
        $first_variable = $match[0];
        return $first_variable . ' ~> ' . $code;
    }

    private static function getFunctionVariables($code)
    {
        $parts = explode('~>', $code);
        return trim($parts[0], ' ()');
    }

    private static function getFunctionBody($code)
    {
        $parts = explode('~>', $code);
        $body = $parts[1];
        $body = trim($body, ' {;}');

        if (strstr($body, 'return') === false) {
            $body = 'return ' . $body;
        }

        return $body;
    }

    public static function generateAnonymousFunction($function_variables, $function_body)
    {
        $full_code = '$anonymous_function = function(' . $function_variables . ') {' . $function_body . ';};';

        try {
            $is_success = eval($full_code); // creating $anonymous_function variable
        } catch (\Throwable $e) {
            throw new \Exception('Invalid PHP code: ' . $full_code);
        }

        // PHP 5 error check
        if ($is_success === false) { // === false, very important!
            throw new \Exception('Invalid PHP code: ' . $full_code);
        }

        return $anonymous_function; // eval() created this variable
    }
}