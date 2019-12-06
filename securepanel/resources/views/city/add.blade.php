@extends('layout.layout')
@section('page_icon', 'fa-map')
@section('page_name', $panelTitle)
@section('content')
@php
$languages = AdminHelper::getLanguages();
@endphp
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->



    <!-- Main content -->
    
    <section class="content">
      {!! Form::open(['route' => 'secure_city_add_action', 'method' => 'post', 'name' => 'saveCity', 'id' => 'saveCity', 'novalidate' => true ]) !!}
      
      <div class="row">
        <div class="col-md-3 col-xs-12"></div>
          <div class="col-md-6 col-xs-12">
          @include('layout.alert')
              <div class="row">
                <div class="col-lg-12">
                  <label>Choose Country <span class="required">*</span></label>
                  <select name="country" id="country" class="form-control" onchange="getStateList();" required >
                    <option value="">Select Country</option>
                    @foreach($countryDetails as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
                </div>
              </div>


              <div class="row">
                <div class="col-lg-12">
                 <label>Choose State <span class="required">*</span></label>
                  <select name="state" id="state" class="form-control" required>
                      <option value="">Select State</option>
                  </select>
                </div>
              </div>
              
                @foreach($languages as $lang)
                <div class="row">
                <div class="col-lg-12">
                  
                  <label>Name ({{ $lang->name }}) <span class="required">*</span></label>

                  <input type="text" class="form-control" name="name[{{ $lang->code }}]" id="name" value="{{ old('name.'.$lang->code) }}" placeholder="Title" @if($lang->code == 'AR') dir="rtl" @endif required/>

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
          <a href="{{ route('secure_city_list') }}" class="btn btn-info">Back</a>
        </div>
        <div class="col-md-3 col-xs-12"></div>
      </div>

      {!! Form::close() !!} 
    
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <script type="text/javascript">
      /*get state list while changing country*/
  function getStateList(){
    console.log($('#searchcountry').find("option:selected").val());
    var stateHtml = '';

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
            
    $.ajax({
        url: '{{\URL::route('secure_city_state_list')}}',
        type: "POST",
        data: {
            "_token":  "{{ csrf_token() }}",
            "country_id": $('#country').find("option:selected").val(),
        },
        success: function(response){
         
          var data = response; console.log(data);
           $.each(data, function(j, item) {
                stateHtml = stateHtml + '<option value="'+data[j].id+'">'+data[j].name+'</option>';
            });

            $('#state').append(stateHtml);   
        }
    })
      
  }
  </script>
@endsection