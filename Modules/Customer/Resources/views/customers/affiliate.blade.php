@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/customer/css/style.css'))}}" />

@endsection
@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show" id="all_customer">
                            <div class="box_header common_table_header ">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">Affiliate Customers</h3>
                                </div>
                            </div>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table">
                                    <!-- table-responsive -->
                                    <div class="">
                                        <table class="table dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>{{__('common.sl')}}</th>
                                                    <th>Image</th>
                                                    <th>UserName</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Area</th>
                                                    <th>Amount</th>
                                                    <th>Rank</th>
                                                    <th>SellPoint</th>
                                                    <th>Affilaites</th>
                                                    <th>Total Members</th>
                                                    <th>KYC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($affiliate as $key => $item)
                                                @if ($item->affiliate == 1)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td><img src="{{ asset($item->photo) }}" alt="" class="img-fluid" width="100px"></td>
                                                        <td>
                                                            <a href="{{ route('affiliates',$item->id) }}">
                                                                {{ $item->username }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('affiliates',$item->id) }}">
                                                                {{ $item->first_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>@php
                                                            $area_code = DB::table('order_address_details')->where('customer_id',$item->id)->first();
                                                            if ($area_code != null) {
                                                                # code...
                                                                $area = DB::table('states')->where('id',$area_code->shipping_state_id)->first();

                                                                $area = $area->name;
                                                            }else{
                                                                $area = 'not set yet';
                                                            }
                                                        @endphp
                                                        {{ $area }}</td>
                                                        <td>{{ $item->request->amount }}</td>
                                                        <td>{{ $item->rank }}</td>
                                                        <td>{{ $item->point }}</td>
                                                        <td>
                                                            @php
                                                                $code = DB::table('referral_codes')->where('user_id',$item->id)->first();
                                                                if ($code) {
                                                                    # code...
                                                                    $counts = DB::table('referral_uses')->where('referral_code',$code->referral_code)->get();
                                                                    $af = 0;
                                                                    foreach ($counts as $key => $value) {
                                                                        # code...
                                                                        $v = DB::table('users')->where('id',$value->user_id)->first();
                                                                        if ($v->affiliate == 1) {
                                                                            # code...
                                                                            $af =+ 1;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            {{ $af ?? 0}}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $code = DB::table('referral_codes')->where('user_id',$item->id)->first();
                                                                if ($code) {
                                                                    # code...
                                                                    $count = DB::table('referral_uses')->where('referral_code',$code->referral_code)->count();
                                                                }
                                                            @endphp
                                                            {{ $count ?? 0}}
                                                        </td>
                                                        {{-- <td>Total Members</td> --}}
                                                        <td>
                                                            @php
                                                                $aff = DB::table('affiliate_requests')->where('user_id',$item->id)->first();
                                                            @endphp
                                                            @if ($aff->nid_number != null)
                                                                Submited
                                                            @else
                                                                not Submitted
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="refered">
                            <div class="box_header common_table_header ">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">Referred Customers</h3>
                                </div>
                            </div>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table">
                                    <!-- table-responsive -->
                                    <div class="">
                                        <table class="table dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>{{__('common.sl')}}</th>
                                                    <th>Image</th>
                                                    <th>UserName</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Area</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($affiliate as $key => $item)
                                                @if ($item->affiliate != 1)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td><img src="{{ asset($item->photo) }}" alt="" class="img-fluid" width="100px"></td>
                                                        <td>
                                                            <a href="{{ route('affiliates',$item->id) }}">
                                                                {{ $item->username }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('affiliates',$item->id) }}">
                                                                {{ $item->first_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>@php
                                                            $area_code = DB::table('order_address_details')->where('customer_id',$item->id)->first();
                                                            if ($area_code != null) {
                                                                # code...
                                                                $area = DB::table('states')->where('id',$area_code->shipping_state_id)->first();

                                                                $area = $area->name;
                                                            }else{
                                                                $area = 'not set yet';
                                                            }
                                                        @endphp</td>
                                                    </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('backEnd.partials.delete_modal',['item_name' => __('common.customer')])
</section>
@endsection
@push('scripts')
    <script type="text/javascript">
        (function($){
                "use strict";

                $(document).ready(function(){
                    activeCustomerDataTable();
                    inactiveCustomerDataTable();
                    allCustomerDataTable();

                    $(document).on('click', '.delete_customer', function(event){
                        event.preventDefault();
                        let value = $(this).data('value');
                        confirm_modal(value);
                    });

                    $(document).on('change', '.update_active_status', function(event){
                        let id = $(this).data('id');
                        let status = 0;

                        if($(this).prop('checked')){
                            status = 1;
                        }
                        else{
                            status = 0;
                        }
                        $("#pre-loader").removeClass('d-none');

                        $.post('{{ route('customer.update_active_status') }}', {_token:'{{ csrf_token() }}', id:id, status:status}, function(data){
                            if(data == 1){
                                toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                                activeCustomerDataTable();
                                inactiveCustomerDataTable();
                            }
                            else{
                                toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                            }
                            $("#pre-loader").addClass('d-none');
                        })

                        .fail(function(response) {
                                if(response.responseJSON.error){
                                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                        $('#pre-loader').addClass('d-none');
                                        return false;
                                    }

                                });
                    });

                    function activeCustomerDataTable(){
                        $('#activeCustomerTable').DataTable({
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            "ajax": ( {
                                url: "{{ route('cusotmer.list.get-data') }}" + '?table=active_customer'
                            }),
                            "initComplete":function(json){

                            },
                            columns: [
                                { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                                    return numbertrans(data)
                                }},
                                { data: 'avatar', name: 'avatar' },
                                { data: 'name', name: 'first_name' },
                                { data: 'email', name: 'email' },
                                { data: 'phone', name: 'username' },
                                { data: 'status', name: 'status' },
                                { data: 'wallet_balance', name: 'wallet_balance' },
                                { data: 'orders', name: 'orders' },
                                { data: 'action', name: 'action' }
                            ],

                            bLengthChange: false,
                            "bDestroy": true,
                            language: {
                                search: "<i class='ti-search'></i>",
                                searchPlaceholder: trans('common.quick_search'),
                                paginate: {
                                    next: "<i class='ti-arrow-right'></i>",
                                    previous: "<i class='ti-arrow-left'></i>"
                                }
                            },
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'Copy',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    title: $("#header_title").text(),
                                    margin: [10, 10, 10, 0],
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    },

                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    },
                                    pageSize: 'A4',
                                    margin: [0, 0, 0, 0],
                                    alignment: 'center',
                                    header: true,

                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    title: $("#header_title").text(),
                                    exportOptions: {
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fa fa-columns"></i>',
                                    postfixButtons: ['colvisRestore']
                                }
                            ],
                            columnDefs: [{
                                visible: false
                            }],
                            responsive: true,
                        });
                    }

                    function allCustomerDataTable(){
                        $('#allCustomerTable').DataTable({
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            "ajax": ( {
                                url: "{{ route('cusotmer.list.get-data') }}" + '?table=all_customer'
                            }),
                            "initComplete":function(json){

                            },
                            columns: [
                                { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                                    return numbertrans(data)
                                }},
                                { data: 'avatar', name: 'avatar' },
                                { data: 'name', name: 'first_name' },
                                { data: 'email', name: 'email' },
                                { data: 'phone', name: 'username' },
                                { data: 'status', name: 'status' },
                                { data: 'wallet_balance', name: 'wallet_balance' },
                                { data: 'orders', name: 'orders' },
                                { data: 'action', name: 'action' }

                            ],

                            bLengthChange: false,
                            "bDestroy": true,
                            language: {
                                search: "<i class='ti-search'></i>",
                                searchPlaceholder: trans('common.quick_search'),
                                paginate: {
                                    next: "<i class='ti-arrow-right'></i>",
                                    previous: "<i class='ti-arrow-left'></i>"
                                }
                            },
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'Copy',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    title: $("#header_title").text(),
                                    margin: [10, 10, 10, 0],
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    },

                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    },
                                    pageSize: 'A4',
                                    margin: [0, 0, 0, 0],
                                    alignment: 'center',
                                    header: true,

                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    title: $("#header_title").text(),
                                    exportOptions: {
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fa fa-columns"></i>',
                                    postfixButtons: ['colvisRestore']
                                }
                            ],
                            columnDefs: [{
                                visible: false
                            }],
                            responsive: true,
                        });
                    }

                    function inactiveCustomerDataTable(){
                        $('#inactiveCustomerTable').DataTable({
                            processing: true,
                            serverSide: true,
                            stateSave: true,
                            "ajax": ( {
                                url: "{{ route('cusotmer.list.get-data') }}" + '?table=inactive_customer'
                            }),
                            "initComplete":function(json){

                            },
                            columns: [
                                { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                                    return numbertrans(data)
                                }},
                                { data: 'avatar', name: 'avatar' },
                                { data: 'name', name: 'first_name' },
                                { data: 'email', name: 'email' },
                                { data: 'phone', name: 'username' },
                                { data: 'status', name: 'status' },
                                { data: 'wallet_balance', name: 'wallet_balance' },
                                { data: 'orders', name: 'orders' },
                                { data: 'action', name: 'action' }

                            ],

                            bLengthChange: false,
                            "bDestroy": true,
                            language: {
                                search: "<i class='ti-search'></i>",
                                searchPlaceholder: trans('common.quick_search'),
                                paginate: {
                                    next: "<i class='ti-arrow-right'></i>",
                                    previous: "<i class='ti-arrow-left'></i>"
                                }
                            },
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'Copy',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    title: $("#header_title").text(),
                                    margin: [10, 10, 10, 0],
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    },

                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    title: $("#header_title").text(),
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: ':visible',
                                        columns: ':not(:last-child)',
                                    },
                                    pageSize: 'A4',
                                    margin: [0, 0, 0, 0],
                                    alignment: 'center',
                                    header: true,

                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    title: $("#header_title").text(),
                                    exportOptions: {
                                        columns: ':not(:last-child)',
                                    }
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fa fa-columns"></i>',
                                    postfixButtons: ['colvisRestore']
                                }
                            ],
                            columnDefs: [{
                                visible: false
                            }],
                            responsive: true,
                        });
                    }

                });
            })(jQuery);

    </script>
@endpush
