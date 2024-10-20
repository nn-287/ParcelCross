@extends('layouts.admin.app')

@section('title','Banner List')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-filter-list"></i> {{trans('messages.banner')}} {{trans('messages.list')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h5 class="card-header-title"></h5>
                        <a href="{{route('admin.banner.add-new')}}" class="btn btn-primary pull-right"><i
                                class="tio-add-circle"></i> {{trans('messages.add')}} {{trans('messages.new')}} {{trans('messages.banner')}}</a>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th>{{trans('messages.#')}}</th>
                                <th style="width: 30%">{{trans('messages.title')}}</th>
                                <th style="width: 25%">{{trans('messages.description')}}</th>
                                <th style="width: 25%">{{trans('messages.image')}}</th>
                                <th>{{trans('messages.action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($banners as $key=>$banner)

                                <tr>
                                    <td>{{$key+1}}</td>

                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{$banner['title']}}
                                        </span>
                                    </td>


                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{$banner['description']}}
                                        </span>
                                    </td>


                                    <td>
                                        <div style="height: 100px; width: 100px; overflow-x: hidden;overflow-y: hidden">
                                            <img src="{{asset('storage/app/public/banner')}}/{{$banner['image']}}" style="width: 100px"
                                                 onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'">
                                        </div>
                                    </td>

                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">

                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('admin.banner.edit', [$banner['id']]) }}">{{ trans('messages.edit') }}</a>

                                                <a class="dropdown-item" href="javascript:" onclick="form_alert('banner-{{$banner['id']}}', 'You want to delete this banner!!')">{{ trans('messages.delete') }}</a>

                                                <form action="{{ route('admin.banner.delete', [$banner['id']]) }}" method="post" id="banner-{{$banner['id']}}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <table>
                            <tfoot>
                            {!! $banners->links() !!}
                            </tfoot>
                        </table>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });

            $('#column2_search').on('keyup', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('change', function () {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function () {
                datatable
                    .columns(4)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>
@endpush
