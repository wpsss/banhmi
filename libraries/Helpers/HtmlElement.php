<?php namespace Banhmi\Helpers;
/**
 * HtmlElement
 */
final class HtmlElement
{
    /**
     * Tag name without brackets
     *
     * @var  string
     */
    private $tag;

    /**
     * Attributes
     *
     * @var  array
     */
    private $attrs;

    /**
     * Content.
     *
     * @var  null|string
     */
    private $content;

    /**
     * A filter hook to modify the element
     *
     * @var  string
     */
    private $filter;

    /**
     * Constructor
     */
    function __construct($tag = 'div', array $attrs = [], $content = '', $filter = '')
    {
        $this->tag = $tag;
        $this->attrs = $attrs;
        $this->content = $content;
        $this->filter = $filter;
    }

    /**
     * Render
     */
    function __toString()
    {
        $attrs = new HtmlAttribute($this->attrs, $this->filter);

        if ($this->filter)
            $this->content = apply_filters($this->filter, $this->content);

        if (null === $this->content) { // Void elements.
            return '<' . $this->tag . $attrs . '>';
        } else {
            return '<' . $this->tag . $attrs . '>' . $this->content . '</' . $this->tag . '>';
        }
    }
}
