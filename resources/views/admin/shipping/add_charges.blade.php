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

              <form class="form-horizontal" method="post" action="{{url('/admin/add-charges')}}" name="add_charges" id="add_charges" novalidate="novalidate">
                    {{csrf_field()}}
                    
                    <div class="control-group">
                            <label class="control-label">Country</label>
                            <div class="controls">
                            <input type="text" value="{{ old('country') }}" name="country" id="country" required>
                            </div>
                     </div>        


                  <div class="control-group">
                    <label class="control-label">Charges</label>
                    <div class="controls">
                        <input type="text" value="{{ old('charges') }}" name="charges" id="charges" required>
                    </div>
                </div>                 

              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>


              <div class="form-actions">
                <input type="submit" value="Create Charges" class="btn btn-primary">
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