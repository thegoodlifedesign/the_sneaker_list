<?php namespace TGL\ShoeRequest\Commands;


class PlaceShoeRequestCommand
{
    public $model;
    public $brand;
    public $size;
    public $msg;
    public $img;

    function __construct($model, $brand, $size, $msg = "", $img = null)
    {
        $this->model = $model;
        $this->brand = $brand;
        $this->size = $size;
        $this->msg = $msg;
        $this->img = $img;
    }
}