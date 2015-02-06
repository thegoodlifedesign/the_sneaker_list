<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/5/15
 * Time: 1:22 AM
 */

namespace TGL\Members\Repositories;


use TGL\Core\Repositories\EloquentRepository;
use TGL\Members\Entities\Member;
use TGL\Members\Exceptions\MemberNotFoundException;

class MemberRepository extends EloquentRepository
{

    function __construct(Member $model)
    {
        $this->model = $model;
    }

    public function getBySlug($slug)
    {
        $member = $this->model->where('slug', '=', $slug)->first();

        if( ! $member) throw new MemberNotFoundException("Member was not found");

        return $member;
    }
}