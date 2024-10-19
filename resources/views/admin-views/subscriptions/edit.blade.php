@extends('layouts.admin.app')

@section('title', 'Update Subscription')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{trans('messages.update')}} {{trans('messages.Subscription')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                    <form action="{{route('admin.subscription.update', ['id' => $subscription->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('put')
                        

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $subscription->user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="plan_id">Plan</label>
                            <select class="form-control" id="plan_id" name="plan_id" required>
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}" data-amount="{{ $plan->amount }}" {{ $plan->id == $subscription->plan_id ? 'selected' : '' }}>{{ $plan->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{ $subscription->amount }}" readonly required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans('messages.update')}}</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
@push('script_2')
<script>
    document.getElementById('plan_id').addEventListener('change', function() {
        var selectedPlan = this.options[this.selectedIndex];
        var amountField = document.getElementById('amount');
        amountField.value = selectedPlan.dataset.amount;
    });
</script>
@endpush