@extends('layout.layout')
@section('page_icon', 'fa-map')
@section('page_name', 'Add States')
@section('content')
@php
$languages = AdminHelper::getLanguages();
@endphp
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->



    <!-- Main content -->
    
    <section class="content">
      {!! Form::open(['route' => 'secure_state_add_action', 'method' => 'post', 'name' => 'saveState', 'id' => 'saveState', 'files' => true, 'novalidate' => true ]) !!}
      
      <div class="row">
        <div class="col-md-3 col-xs-12"></div>
          <div class="col-md-6 col-xs-12">
          @include('layout.alert')
              <div class="row">
                <div class="col-lg-12">
                  <label>Choose Country <span class="required">*</span></label>
                  <select name="country" id="country" class="form-control" required>
                    <option value="">Select Country</option>
                    @foreach($countryDetails as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
                </div>
              </div>
              
                @foreach($languages as $lang)
                <div class="row">
                <div class="col-lg-12">
                  
                  <label>Name ({{ $lang->name }}) <span class="required">*</span></label>
                  <input type="text" class="form-control" name="name[{{ $lang->code }}]" id="name" value="{{ old('name.'.$lang->code) }}" required/>
                 
                </div>
                </div>
                @endforeach
        </div>
        <div class="col-md-3 col-xs-12"></div>
      </div>
  <br/>
      <div class="row">
      <div class="col-md-3 col-xs-12"></div>
        <div class="col-nd-6 col-xs-12 text-right ">
          <button type="submit"  class="btn btn-primary">Save</button> 
          <a href="{{ route('secure_state_list') }}" class="btn btn-info">Back</a>
        </div>
        <div class="col-md-3 col-xs-12"></div>
      </div>

      {!! Form::close() !!} 
    
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
@endsection