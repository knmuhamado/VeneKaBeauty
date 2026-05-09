<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AssistantController extends Controller
{
    public function index(): View
    {
        return view('assistant.index');
    }
}
