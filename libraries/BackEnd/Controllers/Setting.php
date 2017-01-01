<?php namespace Banhmi\BackEnd\Controllers;
/**
 * Setting
 */
use Banhmi\Interfaces\iContent;

class Setting extends AbstractController implements iContent
{
    /**
     * Register setting
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTL
     *
     * @see  https://developer.wordpress.org/reference/functions/register_setting/
     */
    function register()
    {
        register_setting(
            $this->model->group,
            $this->model->name,
            [$this->model, 'sanitize']
        );
    }

    /**
     * Unregister setting
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTL
     *
     * @see  https://developer.wordpress.org/reference/functions/unregister_setting/
     */
    function unregister()
    {
        unregister_setting(
            $this->model->group,
            $this->model->name,
            [$this->model, 'sanitize']
        );
    }
}
