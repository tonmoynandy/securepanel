@extends('layout.layout')
@section('page_icon', 'fa-map')
@section('page_name', 'States')
@push('add_menu')
<a href="{{ route('secure_state_add') }}" class="btn btn-primary btn-xs add-btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
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
          
        <div class="col-lg-3">
          <label for="srch_date_from">&nbsp;</label>
          <input type="text" name="srch_text" id="srch_text" placeholder="Search By State Name" autocomplete="off" class="form-control" value="@php echo isset($srch_text)?$srch_text:''; @endphp" />
        </div>

        <div class="col-lg-2 multiselectOptions">
          <label>Search By Country</label>

          <select class="form-control filter-dropdown" name="searchcountry">
            <option value="">Select Countries</option>
            @foreach($all_countries as $key=>$country)
             <option @if($key == $selectedCountries) selected="selected"  @endif value="{{$key}}">{{$country}}</option>
            @endforeach
          </select>
        </div>


        <div class="col-lg-4">  
          <div class="btn-wrp pull-right">            
            <button type="submit" name="srch_btn" id="srch_btn" class="btn orange_btn mt-4" >Search</button>
            <button type="button" name="rest_btn" id="rest_btn" class="btn mt-4" onclick="window.location='{{url('state/list')}}'">Reset</button>  
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
                <div class="td">State Name </div>
                <div class="td">Country Name</div>
                <div class="td">Status</div>
                <div class="td">Action Button</div>
              </div>
              @if (count($stateDetails) > 0)
              @php($i=1)
              @foreach ($stateDetails as $state)
              <div class="tbody-tr tr">
              <div class="td">{{$state->id }}</div>
              <div class="td">{{ $state->name }}</div>
              <div class="td">{{ $state->country->name }}</div>
              <div class="td">
                @if($state['status'] == '1')
                      <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to inactive the state?',  'warning', true)" href="javascript:void(0)" data-href="{{ route('secure_state_change_status', [$state->id]) }}" title="Status" class="badge badge-success">
                          Active
                      </a>
                  @else
                      <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to active the state?',  'warning',  true)" href="javascript:void(0)" data-href="{{ route('secure_state_change_status', [$state->id]) }}" title="Status" class="badge badge-danger">
                          Inactive
                      </a>
                  @endif
                </div>
                <div class="td">
                  
                  <a href="<?php echo \URL::route('secure_state_edit',$state->id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to delete the state?',  'warning',  true)" href="javascript:void(0)" data-href="<?php echo \URL::route('secure_state_delete',$state->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
          {{ $stateDetails->appends($queryData) }}
        </nav>
      </div>
    </div>
    <!--table area-->
    
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <script type="text/javascript">
  $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
  });
  $(()=>{
    //$(".filter-dropdown").select2();
  });
</script>
@endsection