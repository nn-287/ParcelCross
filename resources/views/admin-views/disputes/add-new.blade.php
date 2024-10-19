@extends('layouts.admin.app')

@section('title', 'Make New Subscription')

@push('css_or_js')
    
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> New Subscription</h1>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.dispute.put') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="order_id">Select Order</label>
                        <select class="form-control" id="order_id" name="order_id" required>
                            @foreach($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="complainer_reason">Complainer Reason</label>
                        <textarea class="form-control" id="complainer_reason" name="complainer_reason" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="defendant_name">Defendant email</label>
                        <input type="text" class="form-control" id="defendant_email" name="defendant_email" required>
                    </div>

                    <div class="form-group">
                        <label for="defendant_reason">Defendant Reason</label>
                        <textarea class="form-control" id="defendant_reason" name="defendant_reason" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="complaint_status">Complaint Status</label>
                        <select class="form-control" id="complaint_status" name="complaint_status" required>
                            <option value="pending">Pending</option>
                            <option value="resolved">Resolved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{trans('messages.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush