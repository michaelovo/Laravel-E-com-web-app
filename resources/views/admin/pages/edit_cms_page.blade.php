@extends('layouts.admin_layout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS page</a> <a href="#" class="current">Edit Page</a> </div>
    <h1>Update Page</h1>
  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add CMS Page</h5>
            </div>
            <div class="widget-content nopadding">
              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/edit-cms-page/'.$cmsPages->id)}}" name="edit_cms_page" id="edit_cms_page">
                  {{csrf_field()}}
                  <div class="control-group">
                    <label class="control-label">Title</label>
                    <div class="controls">
                      <input type="text" name="title" id="title" value="{{$cmsPages->title}}" required="required">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Url</label>
                    <div class="controls">
                      <input type="text" name="url" id="url" value="{{$cmsPages->url}}"required="required">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Description</label>
                    <div class="controls">
                      <textarea name="description" id="description" required="required" value="{{$cmsPages->description}}">{{$cmsPages->description}}</textarea> 
                    </div>
                  </div>

                  <div class="control-group">
                  <label class="control-label">Meta title</label>
                  <div class="controls">
                    <input type="text" name="meta_title" id="meta_title" value="{{$cmsPages->meta_title}}" >
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Meta description</label>
                  <div class="controls">
                    <input type="text" name="meta_description" id="meta_description" value="{{$cmsPages->meta_description}}">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Meta keywords</label>
                  <div class="controls">
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{$cmsPages->meta_keywords}}" >
                  </div>
                </div>
                 <div class="control-group">
                  <label class="control-label">Enable</label>
                  <div class="controls">
                    <input type="checkbox" name="status" id="status" @if($cmsPages->status=="1") checked @endif value="1">
                  </div>
                 </div>      
               <div class="form-actions">
                <input type="submit" value="Update product" class="btn btn-success">
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