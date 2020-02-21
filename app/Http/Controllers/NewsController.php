<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PieceNew;

class NewsController extends Controller
{
    const MAX_MESSAGE_LENGTH = 15;
    public function get() {
        $authUser = Auth::user();
        $news = PieceNew::orderByDesc('id')->get();
        return view('ajax/news', compact('news'));
    }

}
