<?php

namespace TGL\ShoeRequest\Repositories;


use Illuminate\Contracts\Auth\Guard;
use TGL\Core\Repositories\EloquentRepository;
use TGL\ShoeRequest\Entities\ShoeRequest;
use TGL\ShoeRequest\Exceptions\ShoeRequestNotFoundException;

class ShoeRequestRepository extends EloquentRepository
{
    /**
     * @var Guard
     */
    protected  $auth;

    /**
     * @param ShoeRequest $model
     * @param Guard $auth
     */
    function __construct(ShoeRequest $model, Guard $auth)
    {
        $this->model = $model;
        $this->auth = $auth;
    }

    /**
     * @param $shoeRequestNumber
     * @return mixed
     * @throws ShoeRequestNotFoundException
     */
    public function getByShoeRequestNumber($shoeRequestNumber)
    {
        $shoeRequest = $this->model->where('shoe_request_number', '=', $shoeRequestNumber)->first();

        if( ! $shoeRequest) throw new ShoeRequestNotFoundException("The shoe request order was not found");

        return $shoeRequest;
    }

    public function setPrice($number, $price)
    {
        $shoeRequest = $this->getByShoeRequestNumber($number);

        $shoeRequest->price = $price;
        $shoeRequest->status_id = 2;

        $shoeRequest->save();
    }

    public function place($shoeRequest)
    {
        $this->model->shoe_request_number = rand(10000000, 99999999);
        $this->model->member_id = $this->auth->user()->id;
        $this->model->status_id = 1;
        $this->model->size = $shoeRequest->size;
        $this->model->brand = $shoeRequest->brand;
        $this->model->model = $shoeRequest->model;
        $this->model->message = $shoeRequest->message;

        $this->model->save();
    }
}