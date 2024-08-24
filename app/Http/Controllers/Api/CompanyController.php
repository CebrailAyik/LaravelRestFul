<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(15);
        return CompanyResource::collection($companies);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }

    public function allCompanies()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCompanyRequest $request)
    {
        $logoName = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos');
            $logoName  = basename($logoPath);

        }

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $logoName,
            'website' => $request->website,
        ]);

        return response()->json([
            'status' => true,
            'messages' => 'Şirket başarıyla oluşturuldu',
            'data' => $company,
        ]);
    }

    public function getLogo($id)
    {
        $company = Company::findOrFail($id);
        $logoPath = 'storage/logos/' . $company->logo;

        if (!$company->logo || !Storage::disk('public')->exists('logos/' . $company->logo)) {
            return response()->json(['error' => 'Logo bulunamadı'], 404);
        }

        return response()->file(public_path($logoPath));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
