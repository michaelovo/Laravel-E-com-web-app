@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View users</a> </div>
    <h1>Available users</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       <div class="widget-box">
         @include('includes.msg')
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Users</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>          
                  <th>User id</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Pincode</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Registerd</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr class="gradeX">
                  <td class="center">{{$user->id}}</td>
                  <td class="center">{{$user->name}}</td>
                  <td class="center">{{$user->address}}</td>
                  <td class="center">{{$user->city}}</td>
                  <td class="center">{{$user->state}}</td>
                  <td class="center">{{$user->country}}</td>
                  <td class="center">{{$user->pincode}}</td>
                  <td class="center">{{$user->mobile}}</td>
                  <td class="center">{{$user->email}}</td>
                  <td class="center">
                    @if($user->status==1)
                      <span style="color:green"> Active </span>
                    @else
                      <span style="color:red"> Inactive </span>
                    @endif
                  </td>
                  <td class="center">{{$user->created_at->diffforhumans()}}</td>
                  <td class="center">
                    <div class="fl">
                      <a rel="{{$user->id}}" rel1="delete-user" href="javascript:" class=" icon icon-trash btn btn-danger deleteRecord" title="Delete user"></a>                                            
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