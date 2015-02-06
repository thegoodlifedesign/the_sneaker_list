<?php namespace TGL\Members\Http\Controllers;


use Illuminate\Support\Facades\Input;
use TGL\Src\Fractal\Manager;
use TGL\Core\Http\Controllers\Api\ApiController;
use TGL\Members\Exceptions\MemberNotFoundException;
use TGL\Members\Http\Transformers\MemberTransformer;
use TGL\Members\Services\MemberService;

class MemberController extends ApiController
{
    protected $service;

    function __construct(MemberService $service, Manager $fractal)
    {
        $this->service = $service;
        $this->fractal = $fractal;
    }

    public function getMember($slug)
    {
        $includes = Input::get('include') ?: "";

        $this->fractal->parseIncludes($includes);

        try
        {
            $member = $this->service->getMember($slug);

            return $this->respondWithItem($member, new MemberTransformer);
        }
        catch(MemberNotFoundException $e)
        {
            return $this->errorNotFound($e->getMessage());
        }
    }
}