<?php namespace Banhmi;
/**
 * BaseView
 */
use Banhmi\Core;
use Banhmi\Interfaces\iBrowser;

abstract class BaseView implements iBrowser
{
    /**
     * Theme container
     *
     * @var  object
     */
    protected $theme;

    /**
     * Constructor
     */
    function __construct(Core $theme)
    {
        $this->theme = $theme;
    }

    /**
     * Update
     */
    function update(\SplSubject $model)
    {
        $this->render($model);
    }
}
