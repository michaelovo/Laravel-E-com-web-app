@extends('layouts.admin_layout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">Edit coupon</a> </div>
    <h1>Coupons</h1>
  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Edit coupon</h5>
            </div>
            <div class="widget-content nopadding">

              <form class="form-horizontal" method="post" action="{{url('/admin/edit-coupon/'.$couponDetails->id)}}" name="add_coupon" id="add_coupon">
              	  {{csrf_field()}}           

              <div class="control-group">
                <label class="control-label">Coupon code</label>
                <div class="controls">
                  <input type="text" name="coupon_code" id="coupon_code" value="{{$couponDetails->coupon_code}}" placeholder="enter coupon code here" minlength="5" maxlength="15" required>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="number" name="amount" id="amount" value="{{$couponDetails->amount}}" placeholder="enter coupon amount here" min="0" required><!--min="0" to prevent negative number-->
                </div>
              </div>

              <div class="control-group" >
                <label class="control-label">Amount type</label>
                <div class="controls" >
                  
                  <select name="amount_type" id="amount_type" style="width:220px;">
                    <option value="percentage" @if($couponDetails->amount_type=='percentage')Selected @endif>Percentage</option>
                    <option value="fixed" @if($couponDetails->amount_type=='fixed')Selected @endif>Fixed</option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Expiry Date</label>
                <div class="controls">
                  <input type="text" value="{{$couponDetails->expiry_date}}" name="expiry_date" id="expiry_date" autocomplete="off" placeholder="enter coupon expiry date" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($couponDetails->status=="1") checked @endif value="1">
                </div>
              </div>        
            
              <div class="form-actions">
                <input type="submit" value="Update coupon" class="btn btn-success">
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection