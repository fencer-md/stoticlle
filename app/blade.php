<?php
/**
 * This file contains HTML/Blade extensions.
 */

/**
 * Blade @macro() @endmacro block.
 *
 * @see https://github.com/grohiro/laravel-blade-macro
 */
Blade::extend(function($view, $_null) {
    $pattern = '/@macro\s*\(\'(\w+)\'(\s*,\s*(.[^\n]*))?\)/';
    while (preg_match($pattern, $view, $matches)) {
        $code = "<?php function {$matches[1]}";
        // arguments
        if (!isset($matches[3])) {
            $code .= "()";
        } else {
            $code .= "(".$matches[3].")";
        }
        $code .= " { ob_start(); ?".">";
        $view = preg_replace($pattern, $code, $view, 1);
    }
    return $view;
});

Blade::extend(function($view, $compiler) {
    $pattern = $compiler->createPlainMatcher('endmacro');
    $code = "\n<?php return ob_get_clean(); } ?".">\n";
    return preg_replace($pattern, $code, $view);
});

/**
 * <code>
 * {? $old_section = "whatever" ?}
 * </code>
 *
 * @see http://stackoverflow.com/questions/13002626/laravels-blade-how-can-i-set-variables-in-a-template
 */
Blade::extend(function($value) {
    return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
});
