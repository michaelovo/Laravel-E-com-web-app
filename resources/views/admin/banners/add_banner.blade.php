@extends('layouts.admin_layout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Slider</a> <a href="#" class="current">Add Slider</a> </div>
    <h1>Sliders
  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Slider</h5>
            </div>
            <div class="widget-content nopadding">

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-banner')}}" name="add_banner" id="add_banner" novalidate="novalidate">
              	  {{csrf_field()}}

               <div class="control-group">
                <label class="control-label">Slider Image</label>
                <div class="controls">
                   <input type="file" name="image" id="image"> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" placeholder="enter slider title here">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Slider msg</label>
                <div class="controls">
                  <textarea name="msg" id="msg" required="required"></textarea> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Link</label>
                <div class="controls">
                  <input type="text" name="link" id="link" placeholder="enter link code here">
                </div>
              </div> 
              
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>        
            
              <div class="form-actions">
                <input type="submit" value="Add Slider" class="btn btn-success">
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