@extends('layout.layout')
@section('page_icon', 'fa-cogs')
@section('page_name', 'Site Settings')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			@include('layout.alert')
			<div class="table bordered">
				<div class="table-row">
		            <div class="thead-tr tr">
		               	<div class="td">Name</div>
						<div class="td">Details</div>
		            </div>
		            @if (count($allSettings) > 0)
		            	@foreach($allSettings as $settings)
		            		<div class="tbody-tr tr">
		            			<div class="td">{{ ucwords(str_replace('_',' ',$settings['param_name'])) }}</div>
		            			<div class="td">
		            				{{ Form::open(array(
			            				'method'=> 'POST',
			            				'class' => '',
			            				'route' => ['secure_settings_update',$settings->id],
			            				'name'  => 'editSettingsForm',
			            				'id'    => 'editSettingsForm',
			            				'autocomplete' => 'off',
			            				'files' => true,
			            				'novalidate' => true)) 
			            			}}	
		            				<div class="row">
			            				<div class="col-md-10">
				            				@if($settings['type'] == 'FILE')
				            					<input type="file" class="form-control" name="image" accept="Image/*">
				            					@if ($settings['param_value'] != null)
				            						@if(file_exists(public_path('/uploads/site_setting/'.$settings['param_value']))) 
				            							<img src="{{ asset('uploads/site_setting/'.$settings['param_value']) }}" height="80px">
				            						@endif
				            					@endif
				            				@else
				            					<input type="text" class="form-control" placeholder="Enter {{ ucwords(str_replace('_',' ',$settings['param_name'])) }}" name="param_value" value="{{ $settings['param_value'] }}" required>
				            				@endif
			            				</div>
			            				<div class="col-md-2">
			            					<input type="submit" class="btn btn-primary" value="Update">
			            				</div>
		            				</div>
		            				{{ Form::close() }}
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
		</div>
	</div>
</section>
@endsection