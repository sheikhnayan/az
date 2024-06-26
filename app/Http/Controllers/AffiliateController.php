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
        return view('frontend.amazy.pages.become-affiliate1');
    }

    public function index_2($amount)
    {
        return view('frontend.amazy.pages.become-affiliate',compact('amount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function apply(Request $request)
    {

        if (isset($request->nid_front)) {
            $nid_front_request = time().'.'.$request->nid_front->extension();
            # code...
            $nid_front = $request->nid_front->storeAs('public/image', $nid_front_request);

            $nid_front = str_replace('public','',$nid_front);

        }

        if (isset($request->nid_back)) {
            # code...
            $nid_back_request = time().'.'.$request->nid_back->extension();

            $nid_back = $request->nid_back->storeAs('public/image', $nid_back_request);

            $nid_back = str_replace('public','',$nid_back);
        }

        if (isset($request->screen_shot)) {
            # code...
            $screen_shot = time().'.'.$request->screen_shot->extension();

            $screen_shot = $request->screen_shot->storeAs('public/image', $screen_shot);

            $screen_shot = str_replace('public','',$screen_shot);
        }

        $new = new AffiliateRequest;
        $new->user_id = Auth::user()->id;
        $new->blood_group = $request->blood_group;
        $new->whatsapp = $request->whatsapp;
        $new->amount = $request->amount;
        $new->dob = $request->dob;
        $new->gender = $request->gender;
        $new->nid_number = $request->nid_number;
        $new->payment_method = $request->payment_method;
        $new->account_number = $request->account_number;
        $new->transaction_number = $request->transaction_number;

        if (isset($request->nid_front)) {

            $new->nid_front = $nid_front;

        }

        if (isset($request->nid_back)) {

            $new->nid_back = $nid_back;

        }

        if (isset($request->screen_shot)) {
            # code...
            $new->screen_shot = $screen_shot;
        }

        $new->save();

        Toastr::success(__('Applied Successfully!'), 'Applied for Affiliate Successfully!');
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


        if ($data->status != 0) {
            # code...
            $first_check = ReferralUse::where('user_id', $data->user_id)->first();

            if ($first_check) {
                # code...
                $first = ReferralCode::where('referral_code',$first_check->referral_code)->first();

                $first_user = User::find($first->user_id);
                $first_user->point += ($data->amount/100) * 10;
                $first_user->update();

                $second_check = ReferralUse::where('user_id', $first->user_id)->first();

                if ($second_check) {
                    # code...
                    $second = ReferralCode::where('referral_code',$second_check->referral_code)->first();

                    $second_user = User::find($second->user_id);
                    $second_user->point += ($data->amount/100) * 5;
                    $second_user->update();


                    $third_check = ReferralUse::where('user_id', $second->user_id)->first();

                    if ($third_check) {
                        # code...
                        $third = ReferralCode::where('referral_code',$third_check->referral_code)->first();

                        $third_user = User::find($third->user_id);
                        $third_user->point += ($data->amount/100) * 2.5;
                        $third_user->update();
                    }
                }
            }
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
    public function affiliates(string $id)
    {
        $code = ReferralCode::where('user_id',$id)->first();

        if ($code == null) {
            # code...
            return back();
        }

        $data = ReferralUse::where('referral_code',$code->referral_code)->get();

        $affiliate = [];

        foreach ($data as $key => $value) {
            # code...
            $add = User::find($value->user_id);

            array_push($affiliate,$add);
        }

        return view('customer::customers.affiliates',compact('affiliate'));
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
