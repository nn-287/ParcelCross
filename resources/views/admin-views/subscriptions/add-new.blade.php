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
            <form action="{{route('admin.subscription.put')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="plan_id">Plan</label>
                    <select class="form-control" id="plan_id" name="plan_id" required>
                        <option value="">Select Plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" data-amount="{{ $plan->amount }}">{{ $plan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" readonly required>
                </div>
                <button type="submit" class="btn btn-primary">{{trans('messages.submit')}}</button>
            </form>


            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    document.getElementById('plan_id').addEventListener('change', function() {
        var selectedPlan = this.options[this.selectedIndex];
        var amountField = document.getElementById('amount');
        amountField.value = selectedPlan.dataset.amount;
    });
</script>
@endpush