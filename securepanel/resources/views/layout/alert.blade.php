@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissable flash-header-alert" >
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	@foreach ($errors->all() as $error)
	<span>{{ $error }}</span><br/>
	@endforeach
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable flash-header-alert">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	{{ Session::get('success') }}
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissable flash-header-alert">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	{{ Session::get('error') }}
</div>
@endif