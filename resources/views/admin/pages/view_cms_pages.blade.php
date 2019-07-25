@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View CMS Pages</a> </div>
    <h1>Available Pages</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">  
       <div class="widget-box">
         @include('includes.msg')
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Pages</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Paged id</th>
                  <th>Title</th>
                  <th>Url</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cmsPages as $page)
                <tr class="gradeX">
                  <td>{{$page->id}}</td>
                  <td>{{$page->title}}</td>
                  <td>{{$page->url}}</td>
                  <td>
                    @if($page->status==1)
                      <span style="color:green"> Active </span>
                    @else
                      <span style="color:red"> Inactive </span>
                    @endif
                  </td>
                  <td>{{ date('d-m-Y', strtotime($page->created_at))}}</td>

                  <td class="center">
                    <div class="fl">
                      <a href="{{url('/admin/edit-cms-page/'.$page->id)}}" class=" icon icon-edit btn btn-primary" title="Edit page"></a> 
                      
                      <a href="#myModal{{$page->id}}" data-toggle="modal" class=" icon icon-eye-open btn btn-success" title="View page"></a> 

                      <a rel="{{$page->id}}" rel1="delete-cms-page" href="javascript:" class=" icon icon-trash btn btn-danger deleteRecord" title="Delete page"></a>                                            
                    </div>                                      
                  </td>                
                </tr>

                <!--Start..... CMS page details modal class--->
                  <div id="myModal{{$page->id}}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3>{{$page->title}} Page details</h3>
                    </div>
                    <div class="modal-body">
                      <p> 
                        <strong> Page id:</strong> {{$page->id}}<br>
                        <strong>Page Title:</strong> {{$page->title}}<br>                               
                        <strong>Description:</strong>  {{$page->description}}<br> 
                        <strong>Status:</strong>  @if($page->status==1)<span style="color:green"> Active </span> @else <span style="color:red"> Inactive </span> @endif<br> 
                        <strong>Url:</strong>  {{$page->url}}<br> 
                        <strong>Created at:</strong> {{ \Carbon\Carbon::parse($page->created_at)->format('d/m/Y H:i:s')}} <br>
                      </p> 
                    </div>
                  </div>
                <!--End..... CMS page details modal class--->
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