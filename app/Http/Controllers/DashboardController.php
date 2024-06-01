<?php

namespace App\Http\Controllers;

use App\Enums\Level;
use App\Http\Services\TicketsService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $ticketsService;

    public function __construct(
        TicketsService $ticketsService
    ) {
        $this->ticketsService = $ticketsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->ticketsService->graph(); 

        return view('index',$data );
    }

}