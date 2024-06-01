<?php

namespace App\Http\Services;

use App\Enums\Level;
use App\Models\Ticket;

class TicketsService
{
    private $giphyService;

    public function __construct(
        GiphyService $giphyService
    ) {
        $this->giphyService = $giphyService;
    }

    public function getTickets()
    {
        $tickets = Ticket::all();

        return $tickets;
    }

    public function store($request)
    {
        $dataGif = [
            'query' => Level::getName($request['level']),
            'limit' => 1,
            'offset' => 1,
        ];
        $gif = $this->giphyService->searchGif($dataGif);


        $data = [
            'name' => $request['name'],
            'description' => trim($request['description']),
            'level' => $request['level'],
            'gif' => $gif[0]->embed_url,
            'done' => $request['done'],
        ];
        $ticket = Ticket::create($data);

        return $ticket;
    }

    public function getTicket($id)
    {
        $ticket = Ticket::where('id', $id)->first();

        return $ticket;
    }

    public function update($request, $id)
    {
        $data = [
            'name' => $request['name'],
            'description' => trim($request['description']),
            'level' => $request['level'],
            'done' => $request['done'],
        ];


        $ticket = Ticket::find($id);

        if ($ticket) {
            $ticket->update($data);
        }

        return $ticket;
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            $ticket->delete();
        }

        return $ticket;
    }

    public function graph()
    {
        $tickets = Ticket::all();

        $done = [
            'si' => 0,
            'no' => 0,
        ];

        $levels = [
            'muyfacil' => 0,
            'facil' => 0,
            'normal' => 0,
            'dificil' => 0,
            'muydificil' => 0,
        ];

        foreach ($tickets as $ticket) {
            if ($ticket->done) {
                $done['si']++;
            } else {
                $done['no']++;
            }

            switch ($ticket->level) {
                case 1:
                    $levels['muyfacil']++;
                    break;
                case 2:
                    $levels['facil']++;
                    break;
                case 3:
                    $levels['normal']++;
                    break;
                case 4:
                    $levels['dificil']++;
                    break;
                case 5:
                    $levels['muydificil']++;
                    break;
            }
        }

        $data = [
            'done' => $done,
            'levels' => $levels,
        ];

        return $data;
    }

    public function getTicketsFilter($data)
    {
        $tickets = Ticket::whereNotNull('id');

        if ($data['level']) {
            $tickets =  $tickets->where('level', $data['level']);
        }
        if ($data['done'] && $data['done'] > 0) {
            if ($data['done'] == 1) {
                $tickets =  $tickets->where('done', 1);
            } else {
                $tickets =   $tickets->where('done', 0);
            }
        }
        if ($data['created']) { 
            $tickets =  $tickets->whereDate('created_at', $data['created']);
        }
        if ($data['created_from']) {
            $tickets =  $tickets->where('created_at', '>=', $data['created_from'] . ' 00:00:00');
        }
        if ($data['created_to']) {
            $tickets = $tickets->where('created_at', '<=', $data['created_to'] . ' 23:59:59');
        }

        $tickets = $tickets->get();

        return $tickets;
    }
}
