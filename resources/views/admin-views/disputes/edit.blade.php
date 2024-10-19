@extends('layouts.admin.app')

@section('title', 'Update dispute ticket')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{trans('messages.update')}} {{trans('messages.dispute')}}{{trans('messages.ticket')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{ route('admin.dispute.update', $dispute->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $dispute->complainer->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="order_id">Select Order</label>
                        <select class="form-control" id="order_id" name="order_id" required>
                            @foreach($orders as $order)
                                <option value="{{ $order->id }}" {{ $order->id == $dispute->order_id ? 'selected' : '' }}>{{ $order->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="complainer_reason">Complainer Reason</label>
                        <textarea class="form-control" id="complainer_reason" name="complainer_reason" required>{{ $dispute->complainer_reason }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="defendant_email">Defendant email</label>
                        <input type="text" class="form-control" id="defendant_email" name="defendant_email" value="{{ $dispute->defendant->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="defendant_reason">Defendant Reason</label>
                        <textarea class="form-control" id="defendant_reason" name="defendant_reason" required>{{ $dispute->defendant_reason }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="complaint_status">Complaint Status</label>
                        <select class="form-control" id="complaint_status" name="complaint_status" required>
                            <option value="pending" {{ $dispute->complaint_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="resolved" {{ $dispute->complaint_status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="rejected" {{ $dispute->complaint_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('messages.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script_2')
@endpush