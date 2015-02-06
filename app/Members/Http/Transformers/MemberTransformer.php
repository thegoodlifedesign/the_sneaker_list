<?php namespace TGL\Members\Http\Transformers;

use League\Fractal\TransformerAbstract;
use TGL\Members\Entities\Member;
use TGL\ShoeRequest\Http\Transformers\ShoeRequestTransformer;

class MemberTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'shoe_request'
    ];

    public function transform(Member $member)
    {
        return [
            'username' => $member->username,
            'full_name' => $member->full_name,
            'email' => $member->email,
            'is_admin' => (bool) $member->is_admin,

            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/api/v1/'.$member->slug.'/shoe-requests'
                ]
            ],
        ];
    }

    public function includeShoeRequest(Member $member)
    {
        $shoeRequests = $member->shoeRequests;

        return $this->collection($shoeRequests, new ShoeRequestTransformer);
    }
}