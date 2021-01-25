<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndustryRequest;
use App\Models\Industry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
 */
    public function index()
    {
        $industries = Industry::latest()->get();
        return response()->json($industries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IndustryRequest $request
     * @return JsonResponse
     */
    public function store(IndustryRequest $request)
    {
        $data = $request->validated();
        $industry = Industry::create($data);

        return response()->json([
            'id' => $industry->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Industry $industry
     * @return \Illuminate\Http\Response
     */
    public function show(Industry $industry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Industry $industry
     * @return \Illuminate\Http\Response
     */
    public function edit(Industry $industry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param IndustryRequest $request
     * @param Industry $industry
     * @return JsonResponse
     */
    public function update(IndustryRequest $request, Industry $industry)
    {
        $industry->update($request->validated());
        return response()->json([
            'message' => 'Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Industry $industry
     * @return JsonResponse
     */
    public function destroy(Industry $industry)
    {
        $industry->delete();
        return response()->json([
            'message' => 'Delete Successfully'
        ]);
    }
}
