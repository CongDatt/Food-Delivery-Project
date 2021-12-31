<?php

namespace App\Actions;

use App\Traits\HttpResponse;

class BaseAction
{
    use HttpResponse;

    protected $per_page;

    const LIMIT_PER_PAGE = 100;

    const DEFAULT_PER_PAGE = 10;

    public function __construct()
    {
        $this->per_page = request()->has('per_page') ? $this->getPerPage(request()->get('per_page')) : BaseAction::DEFAULT_PER_PAGE;
    }

    private function getPerPage($per_page)
    {
        return $per_page > BaseAction::LIMIT_PER_PAGE ? BaseAction::LIMIT_PER_PAGE : $per_page;
    }
}
