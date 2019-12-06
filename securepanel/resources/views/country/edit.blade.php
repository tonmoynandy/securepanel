@extends('layout.layout')
@section('page_icon', 'fa-map')
@section('page_name', 'Edit Country')
@section('content')
@php
$languages = AdminHelper::getLanguages();
@endphp
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->

    <!-- Main content -->
    
    <section class="content">
    {{ Form::open(array(
                  'method'=> 'POST',
                  'class' => '',
                  'route' => ['secure_country_edit_action', $countryData->id],
                  'name'  => 'editCountryForm',
                  'id'    => 'editCountryForm',
                  'files' => true,
                  'novalidate' => true)) }}

      @include('layout.alert')
      <div class="row">
          <div class="col-lg-12">
            <div class="gray_bg clearfix">
            <div class="search">
              <div class="row">
                @foreach($languages as $lang)
                <div class="col-lg-6">
                  <div class="form-group">
                  <label>Name ({{ $lang->name }}) <span class="required">*</span></label>
                  <input type="text" class="form-control" name="name[{{ $lang->code }}]" id="name" value="{{ $localData[$lang->code] }}" required/>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                  <label>Currency Code <span class="required">*</span></label>
                  <input type="text" class="form-control" name="currency_code" id="currency_code" value="{{ $countryData->currency_code }}"  pattern="[A-Za-z]{3}" maxlength="3" placeholder="USD" required style="text-transform:uppercase"/>
                  </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                  <label>Country Code<span class="required">*</span></label>
                  <input type="text" class="form-control" name="ccode" id="ccode" value="{{ $countryData->ccode }}" pattern="[A-Z]+" maxlength="6" required />
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                <div class="form-group">
                  <label>Phone Code (Do not insert '+' sign) <span class="required">*</span></label>
                  <input type="text" class="form-control" name="phone_code" id="phone_code" value="{{ $countryData->phone_code }}" pattern="\d*" maxlength="4" required/>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                  <label>Enable for phone code option </label>
                  <input type="checkbox" class="checkbox" name="enable_phcode" {{ ($countryData->enable_phcode == '1')?'checked':'' }}  >
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  
                  <label>Upload Flag </label>
                  <input type="file" class="file-input" name="flag_image" id="flag_image">
                  @if( $countryData->flag_image_id )
                    <img src="{{ asset('uploads/country_flags/'.$countryData->flagImage->media_value) }}" />
                  @endif
                </div>
        
              </div>

               
          </div>
         </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <!-- <a href="#" class="orange_btn nxt_btn pull-right">Publish</a>  -->
          <!-- <a href="#" class="orange_btn nxt_btn pull-right">Save</a> -->
          <button type="submit"  class="btn btn-primary">Save</button> 
          <a href="{{ route('secure_country_list') }}" class="btn btn-info">Back</a>
        </div>
      </div>

      {!! Form::close() !!} 
    
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
@endsection