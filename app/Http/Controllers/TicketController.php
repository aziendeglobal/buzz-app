<?php

namespace App\Http\Controllers;

use App\Enums\Level;
use App\Http\Services\TicketsService;
use Illuminate\Http\Request;

class TicketController extends Controller
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
        $tickets = $this->ticketsService->getTickets();

        $data = [
            'tickets'  => $tickets,
            'levels'  => Level::getOptions()
        ];

        return view('tickets.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'levels'  => Level::getOptions()
        ];
        return view('tickets.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'level' => 'required',
        ]);

        $request['done'] = (isset($request['done']) ? 1 : 0);

        $ticket = $this->ticketsService->store($request->all());

        return redirect('/tickets')->with('message-success', 'Ticket creado correctamente: ' . $ticket->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = $this->ticketsService->getTicket($id);

        if ($ticket) {
            $data = [
                'ticket'  =>  $ticket,
                'levels'  => Level::getOptions()
            ];

            return view('tickets.show', $data);
        }
        return redirect('/tickets')->with('message-error', 'Ticket inexistente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = $this->ticketsService->getTicket($id);

        if ($ticket) {
            $data = [
                'ticket'  =>  $ticket,
                'levels'  => Level::getOptions()
            ];

            return view('tickets.edit', $data);
        }

        return redirect('/tickets')->with('message-error', 'Ticket inexistente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'level' => 'required',
        ]);

        $request['done'] = (isset($request['done']) ? 1 : 0);

        $ticket = $this->ticketsService->update($request->all(), $id);

        return redirect('/tickets')->with('message-success', 'Ticket actualizado correctamente: ' . $ticket->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = $this->ticketsService->destroy($id);

        return redirect('/tickets')->with('message-success', 'Ticket eliminado correctamente: ' . $ticket->id);
    }

    /**
     * Display a listing of the resource - filter.
     */
    public function ticketsFilter(Request $request)
    {
        $data = [
            'level' => $request['level'],
            'done' => $request['done'],
            'created' => $request['created'],
            'created_from' => $request['created_from'],
            'created_to' => $request['created_to'],
        ];
        $tickets = $this->ticketsService->getTicketsFilter($request);

        $data['tickets'] = $tickets;
        $data['levels']  = Level::getOptions();


        return view('tickets.index', $data);
    }
}
