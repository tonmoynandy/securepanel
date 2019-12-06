@extends('layout.layout')
@section('page_icon', 'fa-edit')
@section('page_name', 'Edit CMS')
@section('content')
@php
$languages = AdminHelper::getLanguages();
$pageNo = Session::get('page_no');
@endphp
<div>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			@include('layout.alert')
			{{ Form::open(array(
				'method'=> 'POST',
				'class' => '',
				'route' => ['secure_cms_update',$allCms->id],
				'name'  => 'editCmsForm',
				'id'    => 'editCmsForm',
				'files' => true,
				'novalidate' => true)) 
			}}
			<div class="row">
				@foreach($languages as $language)						
				<div class="col-md-6 col-xs-6">
					<h6><u>{{ $language['name'] }}</u></h6>
					@foreach($allCms->translateCms as $cmsDetail)
						@if($language['code'] == $cmsDetail->lang_code)
							<input type="hidden" name="{{ $language['name'] }}[lang_code]" value="{{ $language['code'] }}" />
							<div class="form-group">
								<label for="title">Title <span class="required">*</span> :</label>
								<input type="text" class="form-control" name="{{ $language['name'] }}[title]" value="{{ $cmsDetail->title }}" @if($language['code'] == 'AR') dir="rtl" @endif placeholder="Title" required>
							</div>
							<div class="form-group">
								<label for="description">Description <span class="required">*</span> :</label>
								<textarea name="{{ $language['name'] }}[description]" placeholder="Description">{{ $cmsDetail->description }}</textarea>
							</div>
							<div class="form-group">
								<label for="meta_title">Meta Title <span class="required">*</span> :</label>
								<input type="text" class="form-control" name="{{ $language['name'] }}[meta_title]" value="{{ $cmsDetail->meta_title }}" @if($language['code'] == 'AR') dir="rtl" @endif required>
							</div>
							<div class="form-group">
								<label for="meta_description">Meta Description <span class="required">*</span> :</label>
								<textarea class="form-control" name="{{ $language['name'] }}[meta_description]" @if($language['code'] == 'AR') dir="rtl" @endif required>{{ $cmsDetail->meta_description }}</textarea>
							</div>
							<div class="form-group">
								<label for="title">New Image :</label>
								<input type="file" class="form-control" name="{{ $language['name'] }}[image]" accept="Image/*">
							</div>
							<div class="form-group">
								@if ($cmsDetail->media->media_value != null)
									@if(file_exists(public_path('/uploads/cms_banner/'.$cmsDetail->media->media_value))) 
										<img src="{{ asset('uploads/cms_banner/'.$cmsDetail->media->media_value) }}" height="80px">
									@endif
								@endif
							</div>
						@endif
					@endforeach
				</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-xs-6 col-md-6">
					<input type="submit" class="btn btn-primary" value="Update">
					<a href="{{ route('secure_cms_list').'?page='.$pageNo }}" class="btn btn-info">Back</a>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
@include('layout.ckeditor');
@endpush