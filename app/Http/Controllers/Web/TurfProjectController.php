<?php

namespace App\Http\Controllers\Web;

use App\Services\TurfProjectService;

class TurfProjectController extends BaseController
{
    private $turfProjectService;

    public function __construct(TurfProjectService $turfProjectService)
    {
        $this->turfProjectService = $turfProjectService;
    }

    public function index()
    {
        $number = $this->turfProjectService->getANumber();
        return view('front.pages.turfProjectLandingPage', ['number' => $number]);
    }
}
