<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        // $category = Category::all();

        // if ($request->ajax()) {
        //     return DataTables::of($category)->make(true);
        // }
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
      
    }
    public function create()
    {

        return view('categories.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|unique:categories|min:2|max:30',
            'type' => 'required',
        ]);


        Category::create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully!',

        ], 201);

        //  return redirect()->route('categories.create')->with('success', 'Category created successfully.');
    }
}
