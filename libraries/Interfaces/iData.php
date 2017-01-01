<?php namespace Banhmi\Interfaces;
/**
 * iData
 */
interface iData
{
    /**
     * Sanitize
     *
     * @param  mixed  $data
     */
    function sanitize($data);

    /**
     * Save
     *
     * @param  mixed  $data
     */
    function save($data);
}
