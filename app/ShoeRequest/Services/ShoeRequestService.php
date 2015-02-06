<?php namespace TGL\ShoeRequest\Services;

use TGL\ShoeRequest\Repositories\ShoeRequestRepository;

class ShoeRequestService
{
    /**
     * @var ShoeRequestRepository
     */
    protected $shoeRequestRepo;

    /**
     * @param ShoeRequestRepository $shoeRequestRepo
     */
    function __construct(ShoeRequestRepository $shoeRequestRepo)
    {
        $this->shoeRequestRepo = $shoeRequestRepo;
    }

    /**
     * Get the latest shoe requests
     *
     * @return mixed
     */
    public function getShoeRequests($limit)
    {
        return $this->shoeRequestRepo->getAllPaginated($limit);
    }

    /**
     *
     *
     * @param $shoeRequestNumber
     * @return mixed
     * @throws \TGL\ShoeRequest\Exceptions\ShoeRequestNotFoundException
     */
    public function getShoeRequest($shoeRequestNumber)
    {
        return $this->shoeRequestRepo->getByShoeRequestNumber($shoeRequestNumber);
    }

    public function setPrice($number, $price)
    {
        $this->shoeRequestRepo->setPrice($number, $price);
    }
}