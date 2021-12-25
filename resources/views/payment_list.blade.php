@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-2" style="margin-top: 12%;">
           @include('layouts.side_navbar')
       </div>
    <div class="col-md-10">
        <table class="table">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th> Phone</th>
                <th>Payment Method</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            @php $i = 1; @endphp
            @if(count($payment)>0)
            @foreach($payment as $p)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$p->name}}</td>
                <td>{{$p->phone}}</td>
                <td>{{$p->payment_method}}</td>
                <td>{{$p->taka}}</td>
                <td>{!!$p->status!!}</td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
</div>
</div>
@endsection