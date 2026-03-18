@extends('layouts.app')
@section("title", "Create order")
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create order</div>
          <div class="card-body">
            @if($errors->any())
            <ul id="errors" class="alert alert-danger list-unstyled">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            @endif
            <form method="POST" action="{{ route('order.save') }}">
              @csrf
              <input type="text" class="form-control mb-2" placeholder="Enter total" name="total" value="{{ old('total') }}" />
              <input type="text" class="form-control mb-2" placeholder="Enter date" name="date" value="{{ old('date') }}" />
              <select name="paid" class="form-control mb-2">
                <option value="1" {{ old('paid') == 1 ? 'selected' : '' }}>Paid</option>
                <option value="0" {{ old('paid') == 0 ? 'selected' : '' }}>Not Paid</option>
            </select>
              <input type="text" class="form-control mb-2" placeholder="Enter shipped status (true/false)" name="shipped" value="{{ old('shipped') }}" />
              <select name="methodOfPayment" class="form-control mb-2">
                <option value="card" {{ old('methodOfPayment') == 'card' ? 'selected' : '' }}>Card</option>
                <option value="cash" {{ old('methodOfPayment') == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="bank" {{ old('methodOfPayment') == 'bank' ? 'selected' : '' }}>Bank</option>
            </select>
              <input type="submit" class="btn btn-lila" value="Send" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
