<?php namespace Banhmi\BackEnd\Controllers;
/**
 * PostType
 */
use Banhmi\Interfaces\iContent;

class PostType extends AbstractController implements iContent
{
    /**
     * Register custom post type
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTL
     *
     * @see  https://developer.wordpress.org/reference/functions/register_post_type/
     */
    function register()
    {
        $this->post_type = register_post_type(
            $this->model->type,
            $this->model->args
        );
    }

    /**
     * Unregister custom post type
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTL
     *
     * @see  https://developer.wordpress.org/reference/functions/unregister_post_type/
     */
    function unregister()
    {
        unregister_post_type($this->model->type);
    }
}
