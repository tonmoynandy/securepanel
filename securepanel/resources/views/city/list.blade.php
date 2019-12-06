@extends('layout.layout')
@section('page_icon', 'fa-map')
@section('page_name', $panelTitle)
@push('add_menu')
<a href="{{ route('secure_city_add') }}" class="btn btn-primary btn-xs add-btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
@endpush
@section('content')

  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
    
    <!--sort by & search-->
    <form name="searchForm" action="" method="get">

      <div class="row">
        
        <div class="col-lg-2">
            <label>Sort By</label>
            <select class="form-control" name="order" id="order" onchange="this.form.submit();">
              <option value="id-D" @php if($order == 'id-D'){ echo 'selected';} @endphp>Newest first</option>
              <option value="id-A" @php if($order == 'id-A'){ echo 'selected';} @endphp>Oldest first</option>
              
              <option value="name-D" @php if($order == 'name-D'){ echo 'selected';} @endphp>Name Descending</option>
              <option value="name-A" @php if($order == 'name-A'){ echo 'selected';} @endphp>Name Ascending</option>
            
            </select>
        </div>
          <input type="hidden" id="stateId" name="stateId" value="{{$searchstate}}">
        <div class="col-lg-2">
          <label for="srch_date_from">&nbsp;</label>
          <input type="text" name="srch_text" id="srch_text" placeholder="Search By City Name" autocomplete="off" class="form-control" value="@php echo isset($srch_text)?$srch_text:''; @endphp" />
        </div>

        
        <div class="col-lg-2 multiselectOptions">
          <label>Search By Country</label>
          <select class="form-control filter-dropdown" name="searchcountry" id="searchcountry" onchange="getStateList();">
            <option value="">Select Countries</option>
            @foreach($all_countries as $key=>$country)              
              <option @if($key == $selectedCountries) selected="selected"  @endif value="{{$key}}">
                {{$country}}

              </option>
            @endforeach
          </select>
        </div>

        <div class="col-lg-2 multiselectOptions">
          <label>Search By State</label>
          <select class="form-control filter-dropdown" name="searchstate" id="searchstate">
            
          </select>
        </div>


        <div class="col-lg-3">  
          <div class="btn-wrp pull-right">            
            <button type="submit" name="srch_btn" id="srch_btn" class="btn orange_btn mt-4" >Search</button>
            <button type="button" name="rest_btn" id="rest_btn" class="btn mt-4" onclick="window.location='{{url('city/list')}}'">Reset</button>  
          </div>
        </div>

      </div>

    </form>
    <!--sort by & search-->
    <br/>
    <!--table area-->
    <div class="row">
      <div class="col-lg-12">
        <div class="gray_bg">
          <div class="white">
            <div class="table bordered ">
            <div class="table-row">
              <div class="thead-tr tr">
                <div class="td">S.No </div>
                <div class="td">City Name </div>
                <div class="td">State Name </div>
                <div class="td">Country Name</div>
                <div class="td">Status</div>
                <div class="td">Action Button</div>
              </div>
              @if (count($cityDetails) > 0)
              @php($i=1)
              @foreach ($cityDetails as $city)
              <div class="tbody-tr tr">
              <div class="td">{{ $city->id }}</div>
              <div class="td">{{ $city->name }}</div>
              <div class="td">{{ $city->state->name }} </div>
              <div class="td"> {{ $city->country->name }}</div>
              <div class="td">
                  @if($city['status'] == '1')
                      <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to inactive the city?',  'warning', true)" href="javascript:void(0)" data-href="{{ route('secure_city_change_status', [$city->id]) }}" title="Status" class="badge badge-success">
                          Active
                      </a>
                  @else
                      <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to active the city?',  'warning',  true)" href="javascript:void(0)" data-href="{{ route('secure_city_change_status', [$city->id]) }}" title="Status" class="badge badge-danger">
                          Inactive
                      </a>
                  @endif
                </div>
                <div class="td">
                  <a href="<?php echo \URL::route('secure_city_edit',$city->id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to delete the city?',  'warning',  true)" href="javascript:void(0)" data-href="<?php echo \URL::route('secure_city_delete',$city->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
              </div>
              @php($i++)
              @endforeach 
              @else
              <div class="tbody-tr tr">
                <div class="td">No Record Found </div>
                  
                </div>
              @endif
              </div>
              </div>
          </div>
        </div>

        <nav aria-label="Page navigation example" class="pull-right-not-lg">
          {{ $cityDetails->appends($queryData) }}
        </nav>
      </div>
    </div>
    <!--table area-->
    
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <script type="text/javascript">

    $(document).ready(function(){
      getStateList();
      setTimeout(function(){ $("#searchstate").val($('#stateId').val()); }, 100);
    });

  $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
  });
  $(()=>{
    //$(".filter-dropdown").select2();
  });


  /*get state list while changing country*/
  function getStateList(){

    var stateHtml ='<option value="">Select State</option>';

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
            "country_id": $('#searchcountry').find("option:selected").val(),
        },
        success: function(response){

          var data = response;
           $.each(data, function(j, item) {
                stateHtml = stateHtml + '<option value="'+data[j].id+'">'+data[j].name+'</option>';
            });
            $('#searchstate').html(stateHtml);   
        }
    })
      
  }
</script>
@endsection