<?php namespace TGL\ShoeRequest\Handlers;

use TGL\ShoeRequest\Entities\ShoeRequest;
use TGL\ShoeRequest\Repositories\ShoeRequestRepository;
use TGL\Src\Commander\Interfaces\CommandHandler;

class PlaceShoeRequestCommandHandler implements CommandHandler
{
    protected $shoeRequestRepo;

    function __construct(ShoeRequestRepository $shoeRequestRepo)
    {
        $this->shoeRequestRepo = $shoeRequestRepo;
    }

    /**
     * Handler the command
     *
     * @param $command
     */
    public function handle($command)
    {
        $shoeRequest = ShoeRequest::place($command->brand, $command->model, $command->size, $command->img, $command->msg);

        $this->shoeRequestRepo->place($shoeRequest);
    }
}