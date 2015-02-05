<?php namespace TGL\Src\Commander\Interfaces;

interface CommandBus
{
    /**
     * Execute a command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command);
}