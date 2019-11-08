@extends('layouts.admin_layout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
        @include('layouts.admin_layout.page_title')

  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5><?php echo $page_title;?></h5-->
            </div>
            <div class="widget-content nopadding">

              <form class="form-horizontal" method="post" action="{{url('/admib/update-currency/'.$currency->id)}}" name="edit_currency" id="edit_currency" novalidate="novalidate">
                    {{csrf_field()}}
                    
                    <div class="control-group">
                            <label class="control-label">Country</label>
                            <div class="controls">
                            <input type="text" value="{{$currency->country_name}}" name="country_name" id="country_name" required>
                            </div>
                     </div>        

                <div class="control-group">
                    <label class="control-label">Currency code</label>
                    <div class="controls">
                    <input type="text" value="{{$currency->currency_code}}" name="currency_code" id="currency_code" required>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Exchange Rate</label>
                    <div class="controls">
                        <input type="text" value="{{$currency->exchange_rate}}" name="exchange_rate" id="exchange_rate" required>
                    </div>
                </div>                 

              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                    <input type="checkbox" name="status" id="status" @if($currency->status=="1") checked @endif value="1">
                </div>
              </div>
              


              <div class="form-actions">
                <input type="submit" value="Update Currency" class="btn btn-primary">
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