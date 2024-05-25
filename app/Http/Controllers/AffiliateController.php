<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AffiliateRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Session;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.amazy.pages.become-affiliate');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function apply()
    {
        $new = new AffiliateRequest;
        $new->user_id = Auth::user()->id;
        $new->save();

        Toastr::success(__('common.deleted_successfully'), 'Applied for Affiliate Successfully!');
        return redirect('/');
    }

    public function set_affiliate($id)
    {
        $data =  Session::put('affiliate', $id);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function affiliate_request()
    {
        $data = AffiliateRequest::latest()->get();

        return view('backEnd.pages.customer_data.affiliate-request', compact('data'));
    }

    public function affiliate_request_approve($id)
    {
        $data = AffiliateRequest::find($id);
        $data->status = 1;
        $data->update();

        $user = User::find($data->user_id);
        $user->affiliate = 1;
        $user->update();

        Toastr::success(__('common.deleted_successfully'), 'Request Approved!');

        return redirect(route('affiliate-request'));
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
