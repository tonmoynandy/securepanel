@extends('layout.layout')
@section('page_icon', 'fa-map')
@section('page_name', 'Country')
@push('add_menu')
<a href="{{ route('secure_country_add') }}" class="btn btn-primary btn-xs add-btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
@endpush
@section('content')

  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    @include('layout.alert')
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

              <option value="ccode-D" @php if($order == 'ccode-D'){ echo 'selected';} @endphp>Code Descending</option>
              <option value="ccode-A" @php if($order == 'ccode-A'){ echo 'selected';} @endphp>Code Ascending</option>
            
            </select>
        </div>
          
        <div class="col-lg-7">
          <label for="srch_date_from">&nbsp;</label>
          <input type="text" name="srch_text" id="srch_text" placeholder="Search By Country Name/Code/Phone Code/Currency Code" autocomplete="off" class="form-control" value="@php echo isset($srch_text)?$srch_text:''; @endphp" />
        </div>

        

        <div class="col-lg-3">  
          <div class="btn-wrp pull-right">            
            <button type="submit" name="srch_btn" id="srch_btn" class="btn orange_btn mt-4" >Search</button>
            <button type="button" name="rest_btn" id="rest_btn" class="btn mt-4" onclick="window.location='{{url('country/list')}}'">Reset</button>  
          </div>
        </div>

      </div>

    </form>
    <!--sort by & search-->

    <!-- add error message -->
    @if (count($errors) > 0)
      <div class="alert alert-danger val-error-list">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
<br/>  
    <!--table area-->
    <div class="row">

      <div class="col-lg-12">
      <div class="table bordered">
        <div class="table-row">
              <div class="thead-tr tr">
                <div class="td">S.No</div>
                <div class="td">Country Name</div>
                <div class="td">Country Code</div>
                <div class="td">Phone Code</div>
                <div class="td">Currency Code</div>
                <div class="td">Status</div>
                <div class="td">Action Button</div>
              </div>
            @if (count($countryDetails) > 0)
              @php($i=1)
              @foreach ($countryDetails as $country)
              <div class="tbody-tr tr">
              <div class="td">{{$country->id }}</div>
              <div class="td">{{ $country->name }}</div>
              <div class="td">{{ $country->ccode }}</div>
              <div class="td">
                  @if($country->phone_code!='')
                    +{{ $country->phone_code }}
                  @endif
                  </div>
                <div class="td">{{ $country->currency_code }}</div>
                <div class="td">
                @if($country['status'] == '1')
                    <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to inactive the country?',  'warning', true)" href="javascript:void(0)" data-href="{{ route('secure_country_change_status', [$country->id]) }}" title="Status" class="badge badge-success">
                        Active
                    </a>
                @else
                    <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to active the country?',  'warning',  true)" href="javascript:void(0)" data-href="{{ route('secure_country_change_status', [$country->id]) }}" title="Status" class="badge badge-danger">
                        Inactive
                    </a>
                @endif
                </div>
                <div class="td">
                  
                  <a href="<?php echo \URL::route('secure_country_edit',$country->id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  <a onclick="return sweetalertMessageRender(this, 'Are you sure you want to delete the country?',  'warning',  true)" href="javascript:void(0)" data-href="<?php echo \URL::route('secure_country_delete',$country->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
                </div>
              @php($i++)
              @endforeach 
              @else
              <div class="tbody-tr tr">
                <div class="td">No Record Found</div>
                  
              </div>
              @endif
              </div>
              </div> 

        <nav aria-label="Page navigation example" class="pull-right-not-lg">
          {{ $countryDetails->appends($queryData) }}
        </nav>
      </div>
    </div>
    <!--table area-->
    
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

@endsection
