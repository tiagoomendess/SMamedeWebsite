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

        $topBuyers = $this->turfProjectService->getTopBuyers();
        return view('front.pages.turfProjectLandingPage', ['top_buyers' => $topBuyers]);
    }
}
