<?php namespace TGL\Src\Commander\Interfaces;


interface Container
{
    /**
     * Return a new instance of an object
     *
     * @param $class
     */
    public function make($class);
}