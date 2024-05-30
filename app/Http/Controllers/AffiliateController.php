<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AffiliateRequest;
use App\Models\User;
use Modules\Marketing\Entities\ReferralUse;
use Modules\Marketing\Entities\ReferralCode;
use Modules\Affiliate\Events\ReferralPayment;
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
    public function apply(Request $request)
    {
        $nid_front_request = time().'.'.$request->nid_front->extension();

        $nid_front = $request->nid_front->storeAs('public/image', $nid_front_request);

        $nid_front = str_replace('public','',$nid_front);

        $nid_back_request = time().'.'.$request->nid_back->extension();

        $nid_back = $request->nid_back->storeAs('public/image', $nid_back_request);

        $nid_back = str_replace('public','',$nid_back);

        $new = new AffiliateRequest;
        $new->user_id = Auth::user()->id;
        $new->blood_group = $request->blood_group;
        $new->dob = $request->dob;
        $new->gender = $request->gender;
        $new->nid_number = $request->nid_number;
        $new->payment_method = $request->payment_method;
        $new->account_number = $request->account_number;
        $new->transaction_number = $request->transaction_number;
        $new->nid_front = $nid_front;
        $new->nid_back = $nid_back;
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

        $referral_code = ReferralCode::where('user_id', $data->user_id)->first();

        if (!isset($referral_code)) {
            ReferralCode::create([
                'user_id' => $data->user_id,
                'referral_code' => $user->username,
                'status' => 1
            ]);
        }
        $referral_use = ReferralUse::where('user_id', $data->user_id)->where('is_use', 0)->first();
        if (isset($referral_use)) {
        }

        Toastr::success(__('common.deleted_successfully'), 'Request Approved!');

        return redirect(route('affiliate-request'));
    }

    public function affiliate_request_disapprove($id)
    {
        $data = AffiliateRequest::find($id);
        $data->status = 0;
        $data->update();

        $user = User::find($data->user_id);
        $user->affiliate = 0;
        $user->update();

        Toastr::success(__('common.deleted_successfully'), 'Request Disapproved!');

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
