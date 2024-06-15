@extends('frontend.amazy.layouts.app')
@section('content')
<style>
    .nav-item .active{
        border: 1px solid #ff6900;
        background: #ff6900;
        border-radius: 10px;
    }

    .nav-item .active{
        color: #fff !important;
    }

    .nav-item a{
        color: #ff6900;
    }
</style>
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25">
                    @if(isset($myCode))
                    <div class="dashboard_white_box_header d-flex align-items-center">
                        <h4 class="font_24 f_w_700 mb_20">My Affiliate Link</h4>
                    </div>
                    <div id="coupon">
                        <div class="d-flex gap_10 flex-sm-wrap flex-md-nowrap gray_color_1 theme_border padding25 mb_40">
                            <input name="code" id="code" value="https://eakeen.com/register?ref={{getNumberTranslate($myCode->referral_code)}}" class="primary_input3 rounded-0 style2  flex-fill" readonly type="text">
                            <button id="copyBtn" class="amaz_primary_btn style2 text-nowrap ">{{__('defaultTheme.copy_code')}}</button>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="white_box_30px mb_30">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="all_customer">
                                    <div class="dashboard_white_box_header d-flex align-items-center">
                                        <h4 class="font_20 f_w_700 mb_20">Reffered user List</h4>
                                    </div>
                                    <div class="dashboard_white_box_body">
                                        <div class="table_border_whiteBox mb_30">
                                            <div class="table-responsive">
                                                <table class="table amazy_table style4 mb-0">
                                                    <thead>
                                                        <tr>
                                                        <th class="font_14 f_w_700 priamry_text" scope="col">{{__('common.sl')}}</th>
                                                        <th class="font_14 f_w_700 priamry_text" scope="col">Image</th>
                                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">UserName</th>
                                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">Name</th>
                                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">Phone</th>
                                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">Area</th>
                                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">Affiliate</th>
                                                        {{-- <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col">{{__('common.action')}}</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($referList as $key => $referral)
                                                        {{-- @if ($referral->user->affiliate != 1) --}}
                                                        <tr>
                                                            <td>
                                                                <span class="font_14 f_w_500 mute_text">{{getNumberTranslate($key +1)}}</span>
                                                            </td>
                                                            <td>
                                                                <span class="font_14 f_w_500 mute_text">{{ $referral->user->image }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="font_14 f_w_500 mute_text">
                                                                    @php
                                                                        $u = DB::table('users')->where('id',$referral->user->id)->first();
                                                                    @endphp
                                                                    @if ($u->affiliate == 1)
                                                                        <a href="{{route('customer_panel.referral-check',$referral->user->id)}}">{{ $referral->user->username }}</a></span>
                                                                    @else
                                                                        {{ $referral->user->username }}
                                                                    @endif
                                                            </td>
                                                            <td>
                                                                <span class="font_16 f_w_500 mute_text">
                                                                    @if ($u->affiliate == 1)
                                                                        <a href="{{route('customer_panel.referral-check',$referral->id)}}">{{textLimit(@$referral->user->first_name. @$referral->user->last_name,20)}}
                                                                        </a>
                                                                    @else
                                                                        {{textLimit(@$referral->user->first_name. @$referral->user->last_name,20)}}
                                                                    @endif
                                                                    </span><br>
                                                                <span class="font_12 f_w_400 mute_text">{{@$referral->user->email?@$referral->user->email:@$referral->user->username}}</span>
                                                            </td>
                                                            <td>
                                                                <span class="font_14 f_w_500 mute_text">{{ $referral->user->phone }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="font_14 f_w_500 mute_text">@php
                                                                    $area_code = DB::table('order_address_details')->where('customer_id',$referral->user_id)->first();
                                                                    if ($area_code != null) {
                                                                        # code...
                                                                        $area = DB::table('states')->where('id',$area_code->shipping_state_id)->first();

                                                                        $area = $area->name;
                                                                    }else{
                                                                        $area = 'not set yet';
                                                                    }
                                                                @endphp</span>
                                                            </td>
                                                            <td>
                                                                @if ($referral->user->affiliate == 1)
                                                                    <span class="badge badge-success" style="background: green">Active</span>
                                                                @else
                                                                    <span class="badge badge-success" style="background: red">Inactive</span>

                                                                @endif
                                                            </td>
                                                            {{-- <td>
                                                            <button id="referral_used{{$referral->id}}" class="referral_used {{$referral->is_use == 1?'style4 amaz_primary_btn gray_bg_btn':'style3 amaz_primary_btn'}} text-nowrap" {{$referral->is_use == 1 ? 'disabled' : '' }} data-id="{{$referral->id}}">{{$referral->is_use == 1?__('common.already_claimed'):__('common.claim')}}</button>
                                                            </td> --}}
                                                        </tr>
                                                        {{-- @endif --}}
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @if ($referList->lastPage() > 1)
                                            <x-pagination-component :items="$referList" type=""/>
                                        @elseif(!$referList->count())
                                            <p class="empty_p">{{ __('common.empty_list') }}.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @else
                        <div class="dashboard_white_box_header d-flex align-items-center">
                            <h4 class="font_24 f_w_700 mb_20 text-center w-100"><a href="{{ route('bacome-affiliate') }}">Apply to become a Affiliator!</a></h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                $(document).on('click', '#copyBtn', function(event){
                    let copyTextarea = document.createElement("textarea");
                    copyTextarea.style.position = "fixed";
                    copyTextarea.style.opacity = "0";
                    copyTextarea.textContent = document.getElementById("code").value;
                    document.body.appendChild(copyTextarea);
                    copyTextarea.select();
                    document.execCommand("copy");
                    document.body.removeChild(copyTextarea);
                    toastr.success("{{__('defaultTheme.code_copied_successfully')}}", "{{__('common.success')}}");
                });
                $(document).on('click', '.referral_used', function(event){
                    var id = $(this).data('id');
                    $('#pre-loader').show();
                    $.post('{{ route('customer_panel.referral.used') }}',{_token:'{{ csrf_token() }}', referral_id:id}, function(data){
                        var balance = $('#total_balance').text();
                        var total = balance.split(" ");
                        var total_bal =total[1].split(',') ;
                        var total_balance = parseFloat(total_bal[0]+total_bal[1]);
                        var amount = parseFloat(data.amount + total_balance);
                        $('#total_balance').text(currency_format(amount));
                        $('#referral_used'+id).text('{{__('common.already_claimed')}}');
                        $('#referral_used_'+id).text('{{__('defaultTheme.already_use')}}');
                        $('#referral_used'+id).addClass("gray_bg_btn");
                        $('#referral_used'+id).prop("disabled", true);
                        $('#pre-loader').hide();
                    });
                });
            });

        })(jQuery);
    </script>
<script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/backend/vendors/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/backend/js/main.js') }}"></script>


@endpush
