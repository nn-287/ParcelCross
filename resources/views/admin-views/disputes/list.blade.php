@extends('layouts.admin.app')

@section('title','Disputes')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center mb-3">
                <div class="card-header">
                    <h5 class="card-header-title"></h5>
                    <a href="{{route('admin.dispute.add-new')}}" class="btn btn-primary pull-right"><i
                    class="tio-add-circle"></i> {{trans('messages.Add')}} {{trans('messages.dispute')}} {{trans('messages.ticket')}}</a>
                </div>
            </div>
            <!-- End Row -->

            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-left"></i>
              </a>
            </span>

                <span class="hs-nav-scroller-arrow-next" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-right"></i>
              </a>
            </span>

                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">{{trans('messages.Disputes')}}</a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                       
                    </div>

                    <div class="col-lg-6">
                        <div class="d-sm-flex justify-content-sm-end align-items-sm-center">


                            <!-- Unfold -->
                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:;"
                                   data-hs-unfold-options='{
                                     "target": "#usersExportDropdown",
                                     "type": "css-animation"
                                   }'>
                                    <i class="tio-download-to mr-1"></i> {{trans('messages.export')}}
                                </a>

                                <div id="usersExportDropdown"
                                     class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                    <span class="dropdown-header">{{trans('messages.options')}}</span>
                                    <a id="export-copy" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('public/assets/admin')}}/svg/illustrations/copy.svg"
                                             alt="Image Description">
                                        {{trans('messages.copy')}}
                                    </a>
                                    <a id="export-print" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('public/assets/admin')}}/svg/illustrations/print.svg"
                                             alt="Image Description">
                                        {{trans('messages.print')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">{{trans('messages.download')}} {{trans('messages.options')}}</span>
                                    <a id="export-excel" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('public/assets/admin')}}/svg/components/excel.svg"
                                             alt="Image Description">
                                        {{trans('messages.excel')}}
                                    </a>
                                    <a id="export-csv" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('public/assets/admin')}}/svg/components/placeholder-csv-format.svg"
                                             alt="Image Description">
                                        .{{trans('messages.csv')}}
                                    </a>
                                    <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('public/assets/admin')}}/svg/components/pdf.svg"
                                             alt="Image Description">
                                        {{trans('messages.pdf')}}
                                    </a>
                                </div>
                            </div>
                            <!-- End Unfold -->

                            <!-- Unfold -->
                            <div class="hs-unfold">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white" href="javascript:;"
                                   data-hs-unfold-options='{
                                     "target": "#showHideDropdown",
                                     "type": "css-animation"
                                   }'>
                                    <i class="tio-table mr-1"></i> {{trans('messages.columns')}} <span
                                        class="badge badge-soft-dark rounded-circle ml-1">6</span>
                                </a>

                                <div id="showHideDropdown"
                                     class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card"
                                     style="width: 15rem;">
                                    <div class="card card-sm">
                                        <div class="card-body">


                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="mr-2">{{trans('messages.Plan Name')}}</span>
                                                <label class="toggle-switch toggle-switch-sm" for="toggleColumn_name">
                                                    <input type="checkbox" class="toggle-switch-input" id="toggleColumn_name" checked>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>


                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="mr-2">{{trans('messages.User')}}</span>
                                                <label class="toggle-switch toggle-switch-sm" for="toggleColumn_name">
                                                    <input type="checkbox" class="toggle-switch-input" id="toggleColumn_name" checked>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="mr-2">{{trans('messages.amount')}}</span>
                                                <label class="toggle-switch toggle-switch-sm" for="toggleColumn_amount">
                                                    <input type="checkbox" class="toggle-switch-input" id="toggleColumn_amount" checked>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="mr-2">{{trans('messages.actions')}}</span>
                                                <label class="toggle-switch toggle-switch-sm" for="toggleColumn_actions">
                                                    <input type="checkbox" class="toggle-switch-input" id="toggleColumn_actions" checked>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Unfold -->
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable"
                       class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       style="width: 100%"
                       data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 25,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "pagination": "datatablePagination"
                   }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="">
                            {{trans('messages.#')}}
                        </th>
                        <tr>
                            <th>{{trans('messages.#')}}</th>
                            <th>{{trans('messages.Order ID')}}</th>
                            <th>{{trans('messages.Complainer Email')}}</th>
                            <th>{{trans('messages.Complainer Reason')}}</th>
                            <th>{{trans('messages.Defendant Name')}}</th>
                            <th>{{trans('messages.Defendant Phone')}}</th>
                            <th>{{trans('messages.Defendant Reason')}}</th>
                            <th>{{trans('messages.Complaint Status')}}</th>
                            <th>{{trans('messages.actions')}}</th>
                        </tr>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    @foreach($disputes as $dispute)
                        <tr>
                        <?php
                            
                            $defendant = \App\User::find($dispute->defendant_user_id);
                            $defendant_name = $defendant ? $defendant->f_name . ' ' . $defendant->l_name : '';
                            $defendant_phone = $defendant ? $defendant->phone : '';

                        ?>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dispute->order->id }}</td>
                            <td>{{ $dispute->complainer->email }}</td>
                            <td>{{ $dispute->complainer_reason }}</td>
                            <td>{{ $defendant_name }}</td>
                            <td>{{ $defendant_phone }}</td>
                            <td>{{ $dispute->defendant_reason }}</td>
                            <td>{{ $dispute->complaint_status }}</td>
                           
                            
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $dispute->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="tio-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $dispute->id }}">
                                        <a class="dropdown-item" href="{{ route('admin.dispute.edit', ['id' => $dispute->id]) }}">
                                            <i class="tio-visible"></i> {{ trans('messages.edit') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.dispute.delete', ['id' => $dispute->id]) }}" onclick="event.preventDefault(); document.getElementById('delete-form{{ $dispute->id }}').submit();">
                                            <i class="tio-delete"></i> {{ trans('messages.delete') }}
                                        </a>
                                        <form id="delete-form{{ $dispute->id }}" action="{{ route('admin.dispute.delete', ['id' => $dispute->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3" src="{{asset('public/assets/admin')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                        '<p class="mb-0">No data to show</p>' +
                        '</div>'
                }
            });

            $('#export-copy').click(function () {
                datatable.button('.buttons-copy').trigger()
            });

            $('#export-excel').click(function () {
                datatable.button('.buttons-excel').trigger()
            });

            $('#export-csv').click(function () {
                datatable.button('.buttons-csv').trigger()
            });

            $('#export-pdf').click(function () {
                datatable.button('.buttons-pdf').trigger()
            });

            $('#export-print').click(function () {
                datatable.button('.buttons-print').trigger()
            });

            $('#datatableSearch').on('mouseup', function (e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function () {
                    var newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });

            $('#toggleColumn_name').change(function (e) {
                datatable.columns(1).visible(e.target.checked)
            })

            $('#toggleColumn_email').change(function (e) {
                datatable.columns(2).visible(e.target.checked)
            })

            $('#toggleColumn_phone').change(function (e) {
                datatable.columns(3).visible(e.target.checked)
            })

            $('#toggleColumn_total_order').change(function (e) {
                datatable.columns(4).visible(e.target.checked)
            })

            $('#toggleColumn_actions').change(function (e) {
                datatable.columns(5).visible(e.target.checked)
            })

            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function () {
                var tagify = $.HSCore.components.HSTagify.init($(this));
            });
        });
    </script>

    <script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endpush
