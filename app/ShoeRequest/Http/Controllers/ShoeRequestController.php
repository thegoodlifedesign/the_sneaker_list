<?php namespace TGL\ShoeRequest\Http\Controllers;

use Illuminate\Support\Facades\Input;
use League\Fractal\Manager;
use TGL\ShoeRequest\Commands\PlaceShoeRequestCommand;
use TGL\ShoeRequest\Exceptions\ShoeRequestNotFoundException;
use TGL\ShoeRequest\Http\Requests\PlaceShoeRequestRequest;
use TGL\ShoeRequest\Http\Requests\SetShoeRequestPriceRequest;
use TGL\ShoeRequest\Http\Transformers\ShoeRequestTransformer;
use TGL\ShoeRequest\Services\ShoeRequestService;
use TGL\Core\Http\Controllers\Api\ApiController;
use TGL\Src\Commander\LaravelCommander;

class ShoeRequestController extends ApiController
{
    /**
     * @var ShoeRequestService
     */
    protected $service;

    /**
     * @var LaravelCommander
     */
    protected $commander;

    /**
     * @param ShoeRequestService $service
     * @param Manager $fractal
     * @param LaravelCommander $commander
     */
    function __construct(ShoeRequestService $service, Manager $fractal, LaravelCommander $commander)
    {
        $this->service = $service;
        $this->fractal = $fractal;
        $this->commander = $commander;

        //$this->middleware('auth', ['except' => ['create', 'store']]);
        //$this->middleware('admin', ['only' => 'postSetPrice']);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getShoeRequests()
    {
        $limit = Input::get('limit') ?: 15;

        $paginator = $this->service->getShoeRequests($limit);

        $shoeRequests = $paginator->getCollection();

        return $this->respondWithPaginator($shoeRequests, new ShoeRequestTransformer, $paginator);
    }

    /**
     * @param $shoeRequestNumber
     * @return \Symfony\Component\HttpFoundation\Response|\TGL\Core\Http\Controllers\Api\Response
     */
    public function getShoeRequest($shoeRequestNumber)
    {
        $includes = Input::get('include') ?: "";

        $this->fractal->parseIncludes($includes);

        try
        {
            $shoeRequest = $this->service->getShoeRequest($shoeRequestNumber);

            return $this->respondWithItem($shoeRequest, new ShoeRequestTransformer);
        }
        catch(ShoeRequestNotFoundException $e)
        {
            return $this->errorNotFound($e->getMessage());
        }
    }

    /**
     * @param SetShoeRequestPriceRequest $request
     */
    public function postSetPrice(SetShoeRequestPriceRequest $request)
    {
        $input = $request->all();

        $this->service->setPrice($input['shoe_request_number'], $input['price']);

    }

    /**
     * @param PlaceShoeRequestRequest $request
     */
    public function postPlaceShoeRequest(PlaceShoeRequestRequest $request)
    {
        $this->commander->dispatch(PlaceShoeRequestCommand::class);
    }
}