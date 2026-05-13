@extends('admin.maindesign')

@section('dashboard')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-user-1"></i></div><strong>New
                                Clients</strong>
                        </div>
                        <div class="number dashtext-1">{{$users_count??0}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                            class="progress-bar progress-bar-template dashbg-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>New
                                Orders</strong>
                        </div>
                        <div class="number dashtext-2">{{$new_order_count}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                            class="progress-bar progress-bar-template dashbg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>New
                                Invoices</strong>
                        </div>
                        <div class="number dashtext-3">140</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"
                            class="progress-bar progress-bar-template dashbg-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All
                                Orders</strong>
                        </div>
                        <div class="number dashtext-4">{{$orders_count}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"
                            class="progress-bar progress-bar-template dashbg-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('analysis')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                    <div class="title"><strong class="d-block">Credit Sales</strong><span class="d-block">Lorem ipsum dolor
                            sit</span></div>
                    <div class="piechart chart">
                        <canvas id="pieChartHome1"></canvas>
                        <div class="text"><strong class="d-block">$2.145</strong><span class="d-block">Sales</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                    <div class="title"><strong class="d-block">Channel Sales</strong><span class="d-block">Lorem ipsum
                            dolor sit</span></div>
                    <div class="piechart chart">
                        <canvas id="pieChartHome2"></canvas>
                        <div class="text"><strong class="d-block">$7.784</strong><span class="d-block">Sales</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                    <div class="title"><strong class="d-block">Direct Sales</strong><span class="d-block">Lorem ipsum dolor
                            sit</span></div>
                    <div class="piechart chart">
                        <canvas id="pieChartHome3"></canvas>
                        <div class="text"><strong class="d-block">$4.957</strong><span class="d-block">Sales</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
