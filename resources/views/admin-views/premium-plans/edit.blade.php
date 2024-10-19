@extends('layouts.admin.app')

@section('title', 'Update premium-plan')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{trans('messages.update')}} {{trans('messages.Plan')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{ route('admin.premium-plans.update', [$plan['id']]) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('put')
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="name">{{trans('messages.name')}}</label>
                                <input type="text" name="name" value="{{ $plan['name'] }}" class="form-control" placeholder="Enter name" required>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="email">{{trans('messages.description')}}</label>
                                <input type="text" name="description" value="{{ $plan['description'] }}" class="form-control" placeholder="Enter description" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="service_type">{{trans('messages.amount')}}</label>
                                <input type="text" name="amount" value="{{ $plan['amount'] }}" class="form-control" placeholder="Enter amount" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{trans('messages.update')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script_2')
@endpush