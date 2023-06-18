<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->ajax()) {

            $data = Car::latest()->get()
                ->where('user_id', '=', $user->id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('productAjax');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        Car::updateOrCreate([
            'id' => $request->product_id
        ],
            [
                'brand' => $request->name,
                'model' => $request->detail,
                'year_of_release' =>
                    isset($request->year) ? date('Y',strtotime($request->year)): null,
                'mileage' =>
                    isset($request->mileage) ? $request->mileage : null,
                'color' =>
                    isset($request->color) ? $request->color : null,
                'user_id' => $user->id
            ]);

        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Car::find($id);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
