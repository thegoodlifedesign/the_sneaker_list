<?php namespace TGL\Src\Commander;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use ReflectionClass;
use Illuminate\Http\Request;
use TGL\Src\Commander\Interfaces\Commander;

class LaravelCommander implements Commander
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var DefaultCommandBus
     */
    protected  $bus;

    /**
     * @param Request $request
     * @param DefaultCommandBus $bus
     */
    function __construct(Request $request, DefaultCommandBus $bus)
    {
        $this->request = $request;
        $this->bus = $bus;
    }

    /**
     * @param $command
     * @param array $input
     * @param array $decorators
     * @return mixed
     */
    public function dispatch($command, array $input = null, $decorators = [])
    {
        $input = $input ?: $this->request->all();

        $command = $this->mapRequestToCommand($command, $input);

        foreach($decorators as $decorator)
        {
            $this->bus->decorate($decorator);
        }

        return $this->bus->execute($command);
    }

    /**
     * @param $command
     * @param array $input
     * @return object
     */
    public function mapRequestToCommand($command, array $input)
    {
        $dependencies = [];

        $class = new ReflectionClass($command);

        foreach($class->getConstructor()->getParameters() as $parameter)
        {
            $name = $parameter->getName();

            if(array_key_exists($name, $input))
            {
                $dependencies[] = $input[$name];
            }
            elseif($parameter->isDefaultValueAvailable())
            {
                $dependencies[] = $parameter->getDefaultValue();
            }
            else
            {
                throw new InvalidArgumentException("Unable to map input command: {$name}");
            }
        }

        return $class->newInstanceArgs($dependencies);
    }
}