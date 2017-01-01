<?php namespace Banhmi\Helpers;
/**
 * Html
 *
 * Here comes reusable HTML stuff which could save your time.
 */
final class Html
{
    /**
     * Render attribute(s)
     */
    static function attr(array $attrs, $filter = '')
    {
        return new HtmlAttribute($attrs, $filter);
    }

    /**
     * Render an element
     *
     * @param  string  $tag
     */
    static function elem($tag, array $attrs = [], $content = false, $filter = '')
    {
        return new HtmlElement($tag, $attrs, $content, $filter);
    }

    /**
     * Encode
     *
     * @param  string  $html
     */
    static function encode($html, $double = false)
    {
        return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', $double);
    }

    /**
     * Decode
     *
     * @param  string  $html
     */
    static function decode($html)
    {
        return htmlspecialchars_decode($html, ENT_QUOTES);
    }

    /**
     * Minify
     *
     * A demo minifier. Better to upgrade it.
     *
     * @param  string  $html
     *
     * @return  string
     */
    static function minify($html)
    {
        $patterns = [
            '/<!--(?!<rdf)([\s\S]+?)-->/', // HTML comments except trackbacks.
            '/(\s+)\/\/.+/',               // Inline comments.
            '/(\s)+/',                     // Multiple whitespaces.
            '/(>\s<)/',                    // One space between close tags and open tags.
        ];
        $replacers = ['', '', ' ', '><'];

        return preg_replace($patterns, $replacers, $html);
    }
}
