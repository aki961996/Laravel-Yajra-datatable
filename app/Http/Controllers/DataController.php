<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function index(Request $request)
    {
        return view('data.index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $data = [
            'name' => $request->name,
            'image' => $imageName
        ];
        $jsonData = Storage::disk('local')->exists('data.json')
            ? json_decode(Storage::disk('local')->get('data.json'), true)
            : [];

        $jsonData[] = $data;

        Storage::disk('local')->put('data.json', json_encode($jsonData));

        return redirect()->route('data.view');
    }

    public function viewData()
    {
        $jsonData = Storage::disk('local')->exists('data.json')
            ? json_decode(Storage::disk('local')->get('data.json'), true)
            : [];

        return view('data.view_data', ['jsonData' => $jsonData]);
    }
}
