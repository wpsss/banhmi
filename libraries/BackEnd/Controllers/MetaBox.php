<?php namespace Banhmi\BackEnd\Controllers;
/**
 * MetaBox
 */
use Banhmi\Interfaces\iBox;

class MetaBox extends AbstractController implements iBox
{
    /**
     * Add
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/functions/add_meta_box/
     */
    function add()
    {
        add_meta_box(
            $this->model->id,
            $this->model->title,
            [$this, 'display'],
            $this->model->screen,
            $this->model->context,
            $this->model->priority,
            $this->model->args
        );
    }

    /**
    * Remove
    *
    * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
    *
    * @see  https://developer.wordpress.org/reference/functions/remove_meta_box/
    */
    function remove()
    {
        remove_meta_box(
            $this->model->id,
            $this->model->screen,
            $this->model->context
        );
    }
}
