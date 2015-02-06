<?php namespace TGL\Members\Services;


use TGL\Members\Repositories\MemberRepository;

class MemberService
{
    /**
     * @var MemberRepository
     */
    protected $memberRepo;

    /**
     * @param MemberRepository $memberRepo
     */
    function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getMember($slug)
    {
        return $this->memberRepo->getBySlug($slug);
    }
}