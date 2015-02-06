<?php namespace TGL\ShoeRequest\Http\Transformers;

use League\Fractal\TransformerAbstract;
use TGL\Members\Http\Transformers\MemberTransformer;
use TGL\ShoeRequest\Entities\ShoeRequest;

class ShoeRequestTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'member'
    ];

    /**
     * @param ShoeRequest $shoeRequest
     * @return array
     */
    public function transform(ShoeRequest $shoeRequest)
    {
        return [
            'shoe_request_number' => $shoeRequest->shoe_request_number,
            'member_username' => $shoeRequest->member->username,
            'status' => $shoeRequest->status->name,
            'shoe_size' => (int) $shoeRequest->size,
            'shoe_brand' => $shoeRequest->brand,
            'shoe_model' => $shoeRequest->model,
            'message' => $shoeRequest->message,
            'price' => (int) $shoeRequest->price,
            'date_placed' =>  strtotime($shoeRequest->created_at->toDateTimeString()),

            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/api/v1/shoe-request/'.$shoeRequest->shoe_request_number
                ]
            ],
        ];
    }

    public function includeMember(ShoeRequest $shoeRequest)
    {
        $member = $shoeRequest->member;

        return $this->item($member, new MemberTransformer);
    }

}