@extends('layouts.admin.app')

@section('title', 'Create New Premium-plan')

@push('css_or_js')
    
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> Create New Premium-plan</h1>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.premium-plans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" >
                    </div>
                   
                    <div class="form-group">
                        <label for="email">Description</label>
                        <input type="text" class="form-control" id="description" name="description" >
                    </div>

                    <div class="form-group">
                        <label for="password">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" >
                    </div>

                    <button type="submit" class="btn btn-primary">Create plan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush