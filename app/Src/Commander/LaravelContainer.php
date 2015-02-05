<?php namespace TGL\Src\Commander;

use Illuminate\Contracts\Container\Container as IOC;
use TGL\Src\Commander\Interfaces\Container;

class LaravelContainer implements Container
{
    protected $container;

    function __construct(IOC $container)
    {
        $this->container = $container;
    }


    /**
     * Return a new instance of an object
     *
     * @param $class
     * @return object
     */
    public function make($class)
    {
        return $this->container->make($class);
    }
}