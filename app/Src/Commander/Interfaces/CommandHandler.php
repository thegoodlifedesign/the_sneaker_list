<?php namespace TGL\Src\Commander\Interfaces;


interface CommandHandler
{
    /**
     * Handler the command
     *
     * @param $command
     */
    public function handle($command);
}