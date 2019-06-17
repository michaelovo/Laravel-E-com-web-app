@extends('layouts.admin_layout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Slider</a> <a href="#" class="current">Edit Slider</a> </div>
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

              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/edit-banner/'.$bannerDetails->id)}}" name="edit_banner" id="edit_banner" novalidate="novalidate">
                  {{csrf_field()}}

               <div class="control-group">
                <label class="control-label">Slider Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                    <input type="hidden" name="current_image" value="{{$bannerDetails->image}}">

                     <!--Start---Not to displayed broken image icon when image is not available on edit_banner blade file when editing-->
                    @if(!empty($bannerDetails->image))
                   <!--start---To display banner image from db on this edit_banner blade file when editing-->
                    <img src="{{ asset('/images/frontend_images/images/banners/'.$bannerDetails->image) }}" style="width:30px;"> 
                     <!--End---To display banner image from db on this edit_banner blade file when editing-->

                      <!--Start---To delete displayed banner image from edit_banner blade file when editing-->
                    | <a rel="{{$bannerDetails->id}}" rel1="delete-banner-image" href="javascript:" class="deleteRecord" title="Delete Slider Image"> Delete </a>
                     <!--End---To delete displayed banner image from edit_banner blade file when editing-->
                    @endif
                    <!--End---Not to displayed broken image icon when image is not available on edit_banner blade file when editing-->
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{$bannerDetails->title}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Slider msg</label>
                <div class="controls">
                  <textarea name="msg" id="msg" required="required">{{$bannerDetails->msg}}</textarea> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Link</label>
                <div class="controls">
                  <input type="text" name="link" id="link" value="{{$bannerDetails->link}}">
                </div>
              </div> 
              
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($bannerDetails->status=="1") checked @endif value="1">
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