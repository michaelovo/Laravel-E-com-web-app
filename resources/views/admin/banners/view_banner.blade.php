@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Sliders</a> </div>
    <h1>Available Sliders</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
        
       
       <div class="widget-box">
         @include('includes.msg')
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Sliders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Slider id</th>
                  <th>title</th>
                  <th>Msg</th>
                  <th>link</th>
                  <th>Created at</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($banners as $banner)
                <tr class="gradeX">
                  <td>{{$banner->id}}</td>
                  <td>{{$banner->title}}</td>
                  <td>{{$banner->msg}}</td>
                  <td>{{$banner->link}}</td>
                  <td>{{$banner->created_at}}</td>
                  <td> @if($banner->status==1)Enabled @else Disabled @endif</td>
                  <td>
                    @if(!empty($banner->image))
                    <img src="{{asset('images/frontend_images/images/banners/'.$banner->image)}}" style="width:60px;">
                    @endif
                  </td>
                  <td class="center">
                    <div class="fl">
                      <a href="{{url('/admin/edit-banner/'.$banner->id)}}" class=" icon icon-edit btn btn-primary" title="Edit Slider"></a> 
                
                      <a rel="{{$banner->id}}" rel1="delete-banner" href="javascript:" class=" icon icon-trash btn btn-danger deleteRecord" title="Delete Slider"></a>                                        
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