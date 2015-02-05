<?php namespace TGL\Src\Commander;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use TGL\Src\Commander\Interfaces\CommandBus;

class DefaultCommandBus implements CommandBus
{
    /**
     * @var LaravelContainer
     */
    protected $container;

    /**
     * @var CommandTranslator
     */
    protected $commandTranslator;

    /**
     * @var array
     */
    protected $decorators = [];

    /**
     * @parm LaravelContainer $container
     * @param BasicCommandTranslator $commandTranslator
     */
    function __construct(LaravelContainer $container, BasicCommandTranslator $commandTranslator)
    {
        $this->container = $container;
        $this->commandTranslator = $commandTranslator;
    }

    /**
     * @param $className
     * @return $this
     */
    public function decorate($className)
    {
        $this->decorators[] = $className;

        return $this;
    }

    /**
     * Execute a command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        $this->executeDecorators($command);

        $handler = $this->commandTranslator->translateCommand($command);

        return $this->container->make($handler)->handle($command);
    }

    /**
     * @param $command
     */
    public function executeDecorators($command)
    {
        foreach ($this->decorators as $className)
        {
            $instance = $this->container->make($className);
            if ( ! $instance instanceof CommandBus)
            {
                $message = 'The class to decorate must be an implementation of ThreeAccents\Utilities\Commander\CommandBus';
                throw new InvalidArgumentException($message);
            }
            $instance->execute($command);
        }
    }
}