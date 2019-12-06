@extends('layout.layout')
@section('page_icon', 'fa-home')
@section('page_name', 'Dashboard')
@section('content')
<div class="custom-tab tab " >
  <div class="tab-menu">
    <div class="tab-menu-item"><a >Profile</a></div>
    <div class="tab-menu-item {{ (\Session::has('passwordErr') || \Session::has('password_old_error') || \Session::has('password_success'))?'active':'' }}"><a >Change Password</a></div>
  </div>
  <div class="tab-content">
    <div class="tab-content-item" id="tab1">
      <div class="password-form-container card">
        <div class="form-group">
          <label>Name</label>
          <span class="form-control" >{{ $userdata['name'] }}</span>
        </div>
        <div class="form-group">
          <label>Email</label>
          <span class="form-control" >{{ $userdata['email'] }}</span>
        </div>
      </div>
    </div>
    <div class="tab-content-item" id="tab2">
      <div class="password-form-container card">
        <form action="{{ \URL::route('secure_change_password_action') }}" method="post">
            @if ( \Session::has('password_success'))    
            <div class="alert alert-success">
                <div>{{ \Session::get('password_success') }}</div>
            </div>
            @endif
            @if ($errors->all() || \Session::has('passwordErr') || \Session::has('password_old_error'))
            <div class="alert alert-danger">
                @if(\Session::has('password_old_error'))
                    <div>{{\Session::get('password_old_error')}}</div>
                @endif
                @foreach($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" name="old_password" class="form-control" />
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" />
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="new_confirm_password" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Change" />
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
