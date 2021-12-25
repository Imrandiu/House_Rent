@extends('layouts.admin_layout')

@section('content')
<style>
    .pending-color{color:#2579A9;}
    .accepted-color{color:#20895E;}
    .rejected-color{color:red;}
</style>
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Payment</div>
                <div class="panel-body">
          
                	<table class="table">
                		<tr>
                		    <td>SL</td>
                			<td>Name</td>
                			<td>Title</td>                     
                		<td>Transaction</td>
                		  <td>Transaction Date</td>
                      <td>Phone</td>
                      <td>Taka</td>
                      <td>Email</td>
                			<td>Approve</td>
                				<td>Action</td>
                				
                		</tr>
            
               	 @php $i=1; @endphp
                	@foreach($payment as $payment)
                	<tr>     <td>{{$i++}}</td>
                			<td>{{$payment->name}}</td>
                			<td>{{$payment->payment_method}}</td>
                      <td>{{$payment->transaction_no}}</td>
                          <td>{{$payment->created_at}}</td>
                      <td>{{$payment->phone}}</td>
                      <td>{{$payment->taka}}</td>
                      	<td>{{$payment->email}}</td>
                      		<td>{!!$payment->status!!}</td>
                      	
                      	<td>
                      	    <a  data-placement="top"  data-trigger="click" role="button" class="btn btn-success" data-toggle="modal" data-target="#more_modal" data-owner_phone="{{$payment->phone_no}}" data-owner_name="{{$payment->owner_name}}" >More</a>
                      	    <a  class="btn btn-primary" data-placement="top"  data-trigger="click" role="button" data-toggle="modal" data-target="#update_modal" data-booking_id ="{{$payment->id}}" >Update</a></td>
                		</tr>
                		
                		</tr>
                		
                		
                	                	@endforeach
              </table>
                        
                </div>
            </div>

          </div>
    </div>
  </div>
  {{--Modal start--}}
<div class="modal fade bd-example-modal-lg " id="more_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 3rem">
        <h3 id="moda_title">More Information about payment</h3>
        <p><b>Owner Name : </b><span id="owner_name"></span></p>
        <p><b>Owner Phone : </b><span id="owner_phone"></span></p>
        
      </div>
    </div>
  </div>
</div>
{{--Modal end--}}
  {{--Update Modal start--}}
<div class="modal fade bd-example-modal-lg " id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 3rem">
        <h3 id="moda_title">Update status..</h3>
        <form method="post" action="{{url('admin/update_status')}}">
            {{csrf_field()}}
                <input type="hidden" name="booking_id" value="" id="booking_id">
                  <div class="form-group">
                    <label for="" class="col-form-label">Status change</label>
                    <select class="form-control col-md-4" id="" name="status">
                        <option value="Pending">Pending</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                  </div>
                  <input type="submit" style="margin-top:10px;" class="btn btn-primary" vlaue="update">
        </form>
        
      </div>
    </div>
  </div>
</div>
{{-- Update Modal end--}}
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
 $(function () {
     $('#more_modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var owner_name = button.data('owner_name') // Extract info from data-* attributes
  var owner_phone = button.data('owner_phone') // Extract info from data-* attributes
  var modal = $(this)
  modal.find('#owner_name').text(owner_name)
  modal.find('#owner_phone').text(owner_phone)
})


   $('#update_modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var booking_id = button.data('booking_id') // Extract info from data-* attributes
  var modal = $(this)
  modal.find('#booking_id').val(booking_id)
})


})
</script>
@endsection