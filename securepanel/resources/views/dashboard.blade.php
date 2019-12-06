@extends('layout.layout')
@section('page_icon', 'fa-home')
@section('page_name', 'Dashboard')
@section('content')
<div class="top-section">

    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="small-box bg-yellow">
            <div class="inner">
                <h3>1000</h3>
                <p>Label One</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="small-box bg-red">
            <div class="inner">
                <h3>75</h3>
                <p>Label Two</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="small-box bg-green">
            <div class="inner">
                <h3>45</h3>
                <p>label Three</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="small-box bg-green">
            <div class="inner">
                <h3>40</h3>
                <p>label Four</p>
            </div>
            <div class="icon">
                <i class="fa fa-university"></i>
            </div>
            <a href="" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>

        </div>
        <div class="col-md-4 col-xs-12">
            <div class="small-box bg-yellow">
            <div class="inner">
                <h3>55</h3>
                <p>Label Five</p>
            </div>
            <div class="icon">
                <i class="fa fa-files-o"></i>
            </div>
            <a href="" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="small-box bg-red">
            <div class="inner">
                <h3>66</h3>
                <p>Label Six</p>
            </div>
            <div class="icon">
                <i class="fa fa-files-o"></i>
            </div>
            <a href="" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>
        </div>

        

    </div>
</div>
<div class="dashboard-mid-section">
    <div class="row">
        <div class="col-xs-12 card">
            <h3>Latest Order</h3>
            <div class="table bordered">
                <div class="thead">
                    <div class="tr">
                        <div class="td">Order ID</div>
                        <div class="td">Item(s)</div>
                        <div class="td">Amount</div>
                        <div class="td">Status</div>
                    </div>
                </div>
                <div class="tbody">
                    <div class="tr">
                        <div class="td">NU-ORD-0001</div>
                        <div class="td">1</div>
                        <div class="td">$150</div>
                        <div class="td">Success</div>
                    </div>
                    <div class="tr">
                        <div class="td">NU-ORD-0002</div>
                        <div class="td">2</div>
                        <div class="td">$150</div>
                        <div class="td">Success</div>
                    </div>
                    <div class="tr">
                        <div class="td">NU-ORD-0003</div>
                        <div class="td">1</div>
                        <div class="td">$450</div>
                        <div class="td">Success</div>
                    </div>
                    <div class="tr">
                        <div class="td">NU-ORD-0004</div>
                        <div class="td">1</div>
                        <div class="td">$250</div>
                        <div class="td">Success</div>
                    </div>
                    <div class="tr">
                        <div class="td">NU-ORD-0005</div>
                        <div class="td">3</div>
                        <div class="td">$1000</div>
                        <div class="td">Success</div>
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="col-xs-12 card">
            <h3>Latest  Booking</h3>
            <div class="table bordered">
                <div class="thead">
                    <div class="tr">
                        <div class="td">Test Name</div>
                        <div class="td">Student</div>
                        <div class="td">Date</div>
                        <div class="td">Center</div>
                    </div>
                </div>
                <div class="tbody">
                    <div class="tr">
                        <div class="td">Test One</div>
                        <div class="td">Test Student</div>
                        <div class="td">25-10-2019</div>
                        <div class="td">Center one</div>
                    </div>
                    <div class="tr">
                        <div class="td">Test Two</div>
                        <div class="td">Test Student</div>
                        <div class="td">30-10-2019</div>
                        <div class="td">Center Two</div>
                    </div>
                    <div class="tr">
                        <div class="td">Test Two</div>
                        <div class="td">Test Student</div>
                        <div class="td">30-10-2019</div>
                        <div class="td">Center Two</div>
                    </div>
                    <div class="tr">
                        <div class="td">Test Two</div>
                        <div class="td">Test Student</div>
                        <div class="td">30-10-2019</div>
                        <div class="td">Center Two</div>
                    </div>
                    <div class="tr">
                        <div class="td">Test Two</div>
                        <div class="td">Test Student</div>
                        <div class="td">30-10-2019</div>
                        <div class="td">Center Two</div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
