@extends('layouts.admin_layout.admin_design')
@section('content')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Edit category</a> </div>
    <h1>Update category</h1>
  </div>
  <div class="container-fluid"><hr>

        @include('includes.msg')

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add category</h5>
            </div>
            <div class="widget-content nopadding">

              <form class="form-horizontal" method="post" action="{{url('/admin/edit-category/'.$categoryDetails->id)}}" name="edit_category" id="edit_category" novalidate="novalidate">
              	  {{csrf_field()}}

              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name" value="{{$categoryDetails->name}}">
                </div>
              </div>

            <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                  <select name="parent_id" style="width:220px;">
                    <option value="0">Main catgories</option>
                    <!--starts--- to auto-select parent category along when editing-->
                    @foreach($levels as $val)
                    <option value="{{$val->id}}" @if($val->id == $categoryDetails->parent_id) selected @endif>{{$val->name}}</option>
                    @endforeach
                     <!--end--- to auto-select parent category along when editing-->
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{$categoryDetails->url}}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description">{{$categoryDetails->description}}</textarea> 
                </div>
              </div>

              <div class="control-group">
                  <label class="control-label">Meta title</label>
                  <div class="controls">
                    <input type="text" name="meta_title" id="meta_title" value="{{$categoryDetails->meta_title}}" >
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Meta description</label>
                  <div class="controls">
                    <input type="text" name="meta_description" id="meta_description" value="{{$categoryDetails->meta_description}}" >
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Meta keywords</label>
                  <div class="controls">
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{$categoryDetails->meta_keywords}}" >
                  </div>
                </div>                          

               <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($categoryDetails->status=="1") checked @endif value="1">
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Update Category" class="btn btn-success">
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