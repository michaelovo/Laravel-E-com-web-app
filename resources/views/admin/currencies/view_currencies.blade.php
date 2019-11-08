@extends('layouts.admin_layout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <h1>  @include('layouts.admin_layout.page_title')
      </h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
        
       
       <div class="widget-box">
         @include('includes.msg')
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><?php echo $page_title;?></h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>COUNTRY</th>
                  <th>CURRENCY CODE</th>
                  <th>EXCH.RATE</th>
                  <th>STATUS</th>
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  <th>ACTIONS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($currencies as $currency)
                <tr class="gradeX">
                  <td>{{$loop->index + 1}}</td>
                  <td>{{$currency->country_name}}</td>
                  <td>{{$currency->currency_code}}</td>
                  <td>{{$currency->exchange_rate}}</td>
                  <td> 
                       @if($currency->status==1) 
                            <span style="color:green; font-weight: bold">Enabled</span>
                            @else  
                            <span style="color:red; font-weight: bold">Disabled</span>
                        @endif
                    </td>

                  <td>{{ \Carbon\Carbon::parse($currency->created_at)->format('F d, Y h:ia')}}</td>
                  <td>{{ \Carbon\Carbon::parse($currency->updated_at)->format('F d, Y h:ia')}}</td>

                  

                  <td class="center">
                    <div class="fl">
                      <a href="{{url('/admin/edit-currency/'.$currency->id)}}" class=" icon icon-edit btn btn-primary"></a> 
                      <a id ="delCat" href="{{url('/admin/delete-currency/'.$currency->id)}}" class=" icon icon-trash btn btn-danger"></a>
                        
                      
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


