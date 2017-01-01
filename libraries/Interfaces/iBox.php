<?php namespace Banhmi\Interfaces;
/**
 * iBox
 *
 * WordPress UI has many boxes.
 * E.g. meta boxes, setting fields, setting sections...
 * Boxes must provide methods to add, remove themselves.
 */
interface iBox
{
    /**
     * Add a box
     */
    function add();

    /**
     * Remove a box
     */
    function remove();
}
