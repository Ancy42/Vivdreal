
@extends('admin.layouts.main')
@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
            
        <div class="row">
            <div class="col-xl-6 col-xxl-6 col-sm-12">
                <div class="row">
                    <div class="col-xl-6 col-xxl-6 col-sm-6">
                        <div class="widget-stat card">
                            <div class="card-body">
                                <h4 class="card-title">Total Companies</h4>
                                <h3>0</h3>
                                <div class="progress mb-2">
                                    <div class="progress-bar progress-animated bg-primary" style="width: 0%"></div>
                                </div>
                                <small>0% Increase</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-sm-6">
                        <div class="widget-stat card">
                            <div class="card-body">
                                <h4 class="card-title">Total Employees</h4>
                                <h3>0</h3>
                                <div class="progress mb-2">
                                    <div class="progress-bar progress-animated bg-warning" style="width: 0%"></div>
                                </div>
                                <small>0% Increase</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>					
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Income/Expense Report</h3>
                    </div>
                    <div class="card-body">
                            <div id="morris_bar_2" class="morris_chart_height"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection