@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Coupons</a> </div>
    <h1>Available Coupons</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
        
       
       <div class="widget-box">
         @include('includes.msg')
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Coupon id</th>
                  <th>Coupon code</th>
                  <th>Amount</th>
                  <th>Amount Type</th>
                  <th>Created Date</th>
                  <th>Expiry Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($coupons as $coupon)
                  <tr class="gradeX">
                    <td>{{$coupon->id}}</td>
                    <td>{{$coupon->coupon_code}}</td>
                    <td>
                      <!-- condition to display percntage(%) or dollar($) sign --->
                      @if($coupon->amount_type=='percentage')
                        {{$coupon->amount}}%
                      @else
                        ${{$coupon->amount}}
                      @endif
                       <!-- // condition to display percntage(%) or dollar($) sign --->
                    </td>
                    <td>{{$coupon->amount_type}}</td>
                    <td>{{$coupon->created_at}}</td>
                    <td>{{$coupon->expiry_date}}</td>
                    <td> <!-- condition to display Active) or Inacative depending on status value --->
                      @if($coupon->status==1)Active @else Inactive @endif
                    </td>
                    <td class="center">
                      <div class="fl">
                        <a href="{{url('/admin/edit-coupon/'.$coupon->id)}}" class=" icon icon-edit btn btn-primary" title="Edit coupon"></a> 
                        
                        <a rel="{{$coupon->id}}" rel1="delete-coupon" href="javascript:" class=" icon icon-trash btn btn-danger deleteRecord" title="Delete coupon"></a>
                     </div>                                      
                    </td>                
                  </tr> 
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
@endsection