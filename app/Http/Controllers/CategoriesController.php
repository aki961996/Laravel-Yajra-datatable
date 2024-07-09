<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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
            //we add all that processing time and mb will high so we can use select
            //$data = Category::latest()->get();
            $data = Category::select('id', 'name', 'type');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-info btn-sm viewCategory">view</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function create(Request $request)
    {
        // $method = $request->method();
        // if ($request->isMethod('post')) {
        // }
        //The path method returns the request's path information. So, if the incoming request is targeted at http://example.com/foo/bar, the path method will return foo/bar:
        //$uri = $request->path();
        // $url = $request->url();
        // $urlWithQueryString = $request->fullUrl();
        return view('categories.create');
    }

    public function store(Request $request)
    {

        if ($request->category_id != null) {
            $request->validate([
                'name' => 'required|unique:categories,name,' . $request->category_id . '|min:2|max:30',
                'type' => 'required',
            ]);

            Category::where('id', $request->category_id)->update([
                'name' => $request->name,
                'type' => $request->type
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully!',

            ], 200);
        } else {
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
                'message' => 'Category inserted successfully!',

            ], 201);
        }
    }

    public function edit($id, Request $request)
    {
        $category_id = $id;
        $category = Category::find($category_id);
        return $category;
    }

    public function delete($id, Request $request)
    {
        $category_id = $id;
        Category::where('id', $category_id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!',


        ], 201);
    }

    public function view($id, Request $request)
    {
        $category_id = $id;
        $category = Category::find($category_id);
        return $category;
    }

    public function next_page(Request $request)
    {
        $data['deleted_data'] = Category::onlyTrashed()->get();

        $html = view('categories.deleted_data', $data)->render();
        return response()->json([
            'success' => true,
            'html' => $html



        ], 201);
    }
}
