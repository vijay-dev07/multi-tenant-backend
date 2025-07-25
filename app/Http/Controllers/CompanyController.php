<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class CompanyController extends Controller
{

     use AuthorizesRequests;

     public function index()
    {
        $companies = Company::where('user_id', Auth::id())->paginate(5);
        return view('dashboard', compact('companies'));
    }

    public function create()
    {
        return view('companies.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'industry' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        Company::create($validated);

        return redirect()->route('companies.index')->with('success', 'Company added successfully.');
    }

    public function edit(Company $company)
    {
        $this->authorize('update', $company);
        return view('companies.form', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'industry' => 'required|string|max:255',
        ]);

        $company->update($validated);
        return redirect()->route('companies.index')->with('success', 'Company updated.');
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted.');
    }

    public function switch(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
        ]);

        $user = Auth::user();

        // Clear previous active company
        DB::table('user_active_companies')->where('user_id', $user->id)->delete();

        // Set new active company
        $user->activeCompany()->attach($request->company_id);

        return back()->with('success', 'Active company switched!');
    }
}
