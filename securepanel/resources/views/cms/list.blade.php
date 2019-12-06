@extends('layout.layout')
@section('page_icon', 'fa-list')
@section('page_name', 'CMS')
@section('content')
<section class="content">
	<div class="row">
      	<div class="col-lg-12">
      		@include('layout.alert')
      		<div class="table bordered">
        		<div class="table-row">
		            <div class="thead-tr tr">
		            	<div class="td">ID</div>
		               	<div class="td">Name</div>
		                {{-- <div class="td">Status</div> --}}
		                <div class="td">Action</div>
		            </div>
		            @if (count($allCms) > 0)
		              	@foreach ($allCms as $cmsList)
			              	<div class="tbody-tr tr">
			              		<div class="td">{{ $cmsList['id'] }}</div>
			              		<div class="td">{{ $cmsList['title'] }}</div>
				                {{-- <div class="td">
				                	@if($cmsList['status'] == '1')
						                <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to inactive the cms page?',  'warning', true)" href="javascript:void(0)" data-href="{{ route('secure_cms_change_status',$cmsList['id']) }}" title="Status" class="badge badge-success">Active</a>
						            @else
						                <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to active the cms page?',  'warning',  true)" href="javascript:void(0)" data-href="{{ route('secure_cms_change_status',$cmsList['id']) }}" title="Status" class="badge badge-danger">Inactive</a>
						            @endif
				                </div> --}}
				                <div class="td">   
				                	<a href="{{ route('secure_cms_edit',$cmsList['id']) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>         
				                </div>
		                	</div>
		              	@endforeach 
		            @else
			            <div class="tbody-tr tr">
			                <div class="td">No Record Found</div>                  
			            </div>
	            	@endif
              	</div>
            </div> 
            @if (count($allCms) > 0)
	        	{{ $allCms->links() }}
	        @endif
	    </div>
    </div>
</section>
@endsection