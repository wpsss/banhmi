<?php namespace Banhmi\Interfaces;
/**
 * iContent
 *
 * In WordPress, content types must be registered before using.
 * E.g: post types, taxonomies, settings...
 * Content types must provide methods to register/unregister themselves.
 */
interface iContent
{
    /**
     * Register content type
     */
    function register();

    /**
     * Unregister content type
     */
    function unregister();
}
