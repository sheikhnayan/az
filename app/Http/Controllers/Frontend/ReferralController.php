<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Marketing\Entities\ReferralCode;
use Modules\Marketing\Entities\ReferralUse;
use Modules\Wallet\Entities\WalletBalance;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('maintenance_mode');
    }

    public function referral(){
        $myCode = ReferralCode::where('user_id',auth()->user()->id)->first();
        if (auth()->user()->role->type != 'customer') {
            if(isset($myCode)){
                $referList = ReferralUse::where('referral_code',$myCode->referral_code)->latest()->get();
                return view('backEnd.pages.customer_data.referral',compact('myCode','referList'));
            }else{
                return view('backEnd.pages.customer_data.referral');
            }
        }
        else {
            if(isset($myCode)){
                $referList = ReferralUse::where('referral_code',$myCode->referral_code)->paginate(8);
                return view(theme('pages.profile.referral'),compact('myCode','referList'));
            }else{
                return view(theme('pages.profile.referral'));
            }
        }
    }

    public function referral_users(){
        $myCode = ReferralCode::where('user_id',auth()->user()->id)->first();
        if (auth()->user()->role->type != 'customer') {
            if(isset($myCode)){
                $referList = ReferralUse::where('referral_code',$myCode->referral_code)->latest()->get();
                return view('backEnd.pages.customer_data.referral-users',compact('myCode','referList'));
            }else{
                return view('backEnd.pages.customer_data.referral-users');
            }
        }
        else {
            if(isset($myCode)){
                $referList = ReferralUse::where('referral_code',$myCode->referral_code)->paginate(8);
                return view(theme('pages.profile.referral-users'),compact('myCode','referList'));
            }else{
                return view(theme('pages.profile.referral-users'));
            }
        }
    }
    public function referral_check($id){
        $code = ReferralCode::where('user_id',$id)->first();

        // dd($code)

        if ($code != null) {
            # code...
            $data = ReferralUse::where('referral_code',$code->referral_code)->get();

            $affiliate = [];

        foreach ($data as $key => $value) {
            # code...
            $add = User::find($value->user_id);

            array_push($affiliate,$add);
        }

        }else {
            $data = null;
            $affiliate = [];
        }



        return view(theme('pages.profile.referral-check'),compact('affiliate','code'));
    }
    public function referralUsed(Request $request){
        $referral = ReferralUse::find($request->referral_id);
        $referral->update([
            'is_use' => 1
        ]);
        WalletBalance::create(['user_id'=>auth()->user()->id,'amount'=>$referral->discount_amount,'type'=>'Referral','status'=>1]);
        return response()->json([
            'amount' => $referral->discount_amount,
            'status' => true
        ]);
    }
}
