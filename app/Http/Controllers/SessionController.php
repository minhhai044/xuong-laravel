<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function start()
    {
        return view('sessions.start');
    }
    public function khoitaosession(Request $request)
    {
        session()->put('transaction', [
            'name' => $request->name,
            'age' => $request->age,
        ]);
        return redirect()->route('session.edit');
    }
    public function edit()
    {
        return view('sessions.edit');
    }
    public function capnhat(Request $request)
    {
        session()->put('transaction.quantity', $request->quantity);
        session()->put('transaction.status', 'confirm');
        return redirect()->route('session.confirm');
    }
    public function confirm()
    {
        $data = session()->get('transaction');
        return view('sessions.confirm', compact('data'));
    }
    public function thanhcong()
    {
        session()->put('transaction.status', 'success');
        $data = session()->get('transaction');
        Session::query()->create($data);
        session()->forget('transaction');
        return redirect()->route('session.start')->with('success', 'Thao tác thành công !!!');
    }
}
