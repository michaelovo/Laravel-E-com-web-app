<!---Error message----->
@if(Session::has('flash_err_msg'))
  <div class="alert alert-error alert-block" style="background-color:#f2dfd0;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!! Session('flash_err_msg') !!}</strong>
  </div>
@endif
  <!---Success message----->
@if(Session::has('flash_success_msg'))
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!! Session('flash_success_msg') !!}</strong>
  </div>
@endif

  <!---Laravel validation error message----->
@if (count($errors) >0 )
  @foreach($errors->all() as $error)
    <div class="alert alert-error alert-block" style="background-color:#f2dfd0;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
      <strong>{{$error}}</strong>
    </div>
  @endforeach
@endif

