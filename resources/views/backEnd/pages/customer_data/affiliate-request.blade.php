@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('backend/css/backend_page_css/order.css'))}}" />
<style>
    table.dataTable thead .sorting::after {
        top: 11px;
        left: 66px;
        }

    table.dataTable thead .sorting_asc::after {
        top: 11px;
        left: 66px;
    }
    td {
        padding-left: 3rem !important;
    }
</style>
@endsection
@section('mainContent')
<!--  dashboard part css here -->
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 mb-20">
                <div class="box_header_right">
                    <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                        <ul class="nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" href="#purchase_list_data" role="tab" data-toggle="tab" aria-selected="true">Affiliate Request</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="white_box_30px p-15 mb_30">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show" id="purchase_list_data">
                            <div class="box_header common_table_header ">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">Affiliate Request</h3>
                                </div>
                            </div>
                            <div class="" id="latest_order_div">
                                <table class="table" id="canceledTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('common.sl')}}</th>
                                            <th width="10%">User</th>
                                            <th>{{__('common.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <a href="{{ route('customer.show_details',[$item->user_id]) }}"> {{ $item->user->name }} </a>
                                                </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                    <a href="{{ route('affiliate-request-approve',[$item->id]) }}" class="btn btn-success" id="approve">Approve</a>
                                                    @else
                                                    <span class="badge badge-success">Approved</span>
                                                    @endif
                                                </td>
                                            </tr>
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
</section>
@endsection

@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                $('#canceledTable').DataTable({
                    processing: true,
                    serverSide: false,
                    "stateSave": true,
                    bLengthChange: false,
                    "bDestroy": true,
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
            });
        })(jQuery);
    </script>
@endpush
