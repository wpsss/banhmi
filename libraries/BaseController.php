<?php namespace Banhmi;
/**
 * BaseController
 */
use Banhmi\Interfaces\iEntity;
use Banhmi\Interfaces\iScreen;
use Banhmi\Interfaces\iBrowser;

abstract class BaseController implements iScreen
{
    /**
     * Model
     *
     * @var  object
     */
    protected $model;

    /**
     * View
     *
     * @var  object
     */
    protected $view;

    /**
     * Constructor
     */
    function __construct(iEntity $model = null, iBrowser $view = null)
    {
        $this->model = $model;
        $this->view = $view;
    }

    /**
     * Display
     */
    function display()
    {
        $this->model->attach($this->view);

        $this->view->render($this->model);
    }
}
