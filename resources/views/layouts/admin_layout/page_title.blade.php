
<!-- Page header title -->
<div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Control panel</a>
            <a href="#" class="current">@if(isset($page_title)) {{ $page_title }} @else Untitled Page @endif</a>  
        </div>
        <h1>@if(isset($page_title)) {{ $page_title }} @else Untitled Page @endif</h1>
    </div>
    <!--h1>Permissions</h1-->
    