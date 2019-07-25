@extends('layouts.admin_layout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Page</a> <a href="#" class="current">Add CMS page</a> </div>
    <h1>CMS Page</h1>
  </div>
  <div class="container-fluid"><hr>
        @include('includes.msg')
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add CMS page</h5>
            </div>
            <div class="widget-content nopadding">

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-cms-page')}}" name="add_cms_page" id="add_cms_page">
              	  {{csrf_field()}}
                <div class="control-group">
                  <label class="control-label">Title</label>
                  <div class="controls">
                    <input type="text" name="title" id="title" placeholder="enter page title here" required="required">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Url</label>
                  <div class="controls">
                    <input type="text" name="url" id="url" placeholder="enter page url here" required="required">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Description</label>
                  <div class="controls">
                    <textarea name="description" id="description" required="required"></textarea> 
                  </div>
                </div>
             
                <div class="control-group">
                  <label class="control-label">Enable</label>
                  <div class="controls">
                    <input type="checkbox" name="status" id="status" value="1">
                  </div>
                </div>        
            
                <div class="form-actions">
                  <input type="submit" value="Add CMS page" class="btn btn-success">
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