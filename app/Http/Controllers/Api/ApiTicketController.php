<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Services\TicketsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiTicketController extends Controller
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
        try {
            $tickets = $this->ticketsService->getTickets();
            return response()->json($tickets, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request['done'] = (isset($request['done']) ? 1 : 0);

            $ticket = $this->ticketsService->store($request->all());

            return response()->json($ticket, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $ticket = $this->ticketsService->getTicket($id);
            return response()->json($ticket, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info('update');
        Log::info($request);
        try {

            $request['done'] = (isset($request['done']) ? 1 : 0);

            $ticket = $this->ticketsService->update($request->all(), $id);

            return response()->json($ticket, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $ticket = $this->ticketsService->destroy($id);

            return response()->json(null, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
