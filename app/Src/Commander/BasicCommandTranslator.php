<?php namespace TGL\Src\Commander;

use Prophecy\Exception\InvalidArgumentException;
use TGL\Src\Commander\Interfaces\CommandTranslator;

class BasicCommandTranslator implements CommandTranslator
{
    public function translateCommand($command)
    {
        if( ! is_object($command)) throw new InvalidArgumentException;

        $commandClass = get_class($command);
        $handler = substr_replace($commandClass, 'CommandHandler', strrpos($commandClass, 'Command'));
        $full_handler = str_replace('Commands', 'Handlers', $handler);

        if( ! class_exists($full_handler))
        {
            $message = "Command handler [$full_handler] does not exist";

            throw new HandlerNotFoundException($message);
        }

        return $full_handler;
    }
}