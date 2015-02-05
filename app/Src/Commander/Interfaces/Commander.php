<?php namespace TGL\Src\Commander\Interfaces;

interface Commander
{
    /**
     * @param $command
     * @param array $input
     * @param array $decorators
     * @return mixed
     */
    public function dispatch($command, array $input = null, $decorators = []);

    /**
     * @param $command
     * @param array $input
     * @return object
     */
    public function mapRequestToCommand($command, array $input);
}