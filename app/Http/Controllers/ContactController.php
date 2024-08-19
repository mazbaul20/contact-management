<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        // সার্চ কোয়েরি
        $search = $request->input('search');

        // ডিফল্টভাবে 'name' কলাম এবং 'asc' দিক নির্ধারণ করা
        $sortBy = 'name';
        $sortDirection = 'asc';

        // ড্রপডাউন থেকে পাওয়া ইনপুট অনুযায়ী সর্টিং শর্ত নির্ধারণ
        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'name_asc':
                    $sortBy = 'name';
                    $sortDirection = 'asc';
                    break;
                case 'name_desc':
                    $sortBy = 'name';
                    $sortDirection = 'desc';
                    break;
                case 'created_at_asc':
                    $sortBy = 'created_at';
                    $sortDirection = 'asc';
                    break;
                case 'created_at_desc':
                    $sortBy = 'created_at';
                    $sortDirection = 'desc';
                    break;
            }
        }

        // কন্টাক্ট কোয়েরি তৈরি করা
        $contacts = contact::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy($sortBy, $sortDirection)
            ->paginate(5);

        return view('index', compact('contacts', 'sortBy', 'sortDirection'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // নতুন Contact তৈরি এবং ডাটাবেজে সংরক্ষণ
        contact::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);

        Toastr::success('Contast created successful', 'Create', ["positionClass" => "toast-top-right"]);
        return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = contact::find($id);
        return view('show',['contact'=>$contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = contact::find($id);
        return view('edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:contacts,email,'.$id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Contact আপডেট করা
        Contact::where('id', $id)->update([
            'name' => $validatedData['name'],
            'email' => $request['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);

        Toastr::success('Contast updated successful', 'Create', ["positionClass" => "toast-top-right"]);
        return redirect()->route('contacts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        contact::where('id', $id)->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
