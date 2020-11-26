<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Http\Services\AgendaService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @var AgendaService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param AgendaService $service
     */
    public function __construct(AgendaService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     * @throws \Exception
     */
    public function index()
    {
        DB::enableQueryLog();
        return view('welcome');
    }
}
