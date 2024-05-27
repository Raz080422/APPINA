@extends('template.backend.index')
@section('content')
	<div class="row  border-bottom white-bg dashboard-header mb-2">
        <div class="col-md-8">
            <h2>Dashboard</h2>
            <!-- <small>You have 42 messages and 6 notifications.</small> -->
            <div class="">
               <!-- <div class="flot-chart-content" id="flot-dashboard-chart"></div> -->
                <canvas id="barChart" height="90" style="margin: 15px auto 0"></canvas>
            </div>
            <!-- <div class="row text-left">
                <div class="col">
                    <div class=" m-l-md">
                        <span class="h5 font-bold m-t block">$ 406,100</span>
                        <small class="text-muted m-b block">Sales marketing report</small>
                    </div>
                </div>
                <div class="col">
                    <span class="h5 font-bold m-t block">$ 150,401</span>
                    <small class="text-muted m-b block">Annual sales revenue</small>
                </div>
                <div class="col">
                    <span class="h5 font-bold m-t block">$ 16,822</span>
                    <small class="text-muted m-b block">Half-year revenue margin</small>
                </div>
            </div> -->
        </div>
        <div class="col-md-4">
            <div class="statistic-box">
                <h4>&nbsp;</h4>
                <h4>
                    Status Transaction
                </h4>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <canvas id="doughnutChart2" width="100" height="100" style="margin: 15px auto 0"></canvas>
                        <h5>Transaction</h5>
                    </div>
                    <div class="col-lg-6">
                        <canvas id="doughnutChart" width="100" height="100" style="margin: 15px auto 0"></canvas>
                        <h5>Maintenance</h5>
                    </div>
                </div>
                <div class="m-t"> <small></small> </div>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content mb-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget lazur-bg p-xs text-center mt-0">
                            <div class="m-b-sm">
                                <i class="fa fa-thumbs-up fa-4x"></i>
                                <h1 class="m-xs">{{!isset($success->total) ? 0 : $success->total}}</h1>
                                <h3 class="font-bold no-margins">
                                    Transaction Success
                                </h3>
                                <!-- <small>We detect the error.</small> -->
                            </div>
                        </div>
                        <div class="widget red-bg p-xs text-center">
                            <div class="m-b-sm">
                                <i class="fa fa-warning fa-4x"></i>
                                <h1 class="m-xs">{{!isset($failed->total) ? 0 : $failed->total}}</h1>
                                <h3 class="font-bold no-margins">
                                    Transaction Failed
                                </h3>
                                <!-- <small>We detect the error.</small> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Latest Transaction</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-hover margin bottom">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Rek Nostro</th>
                                                <th>Rek IA Titipan</th>
                                                <th>Currency</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach($data as $row)
                                                <tr class="pointer" onclick="show_log()">
                                                    <td>{{$no++}}</td>
                                                    <td>{{$row['TRX_REKNOSTRO']}}</td>
                                                    <td>{{$row['TRX_IATITIPAN']}}</td>
                                                    <td>{{$row['TRX_CURR']}}</td>
                                                    <td class="text-right">{{ number_format($row['TRX_AMOUNT']) }}</td>
                                                    <td><span class="label label-{{$row['label']}}">{{ $row['DESCRIPTION'] }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Total Transaction Series </h5>
                             <div class="form-group row">
                                <div class="col-lg-2">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control text-center" name="period" id="period" value="@php echo date('Y') @endphp">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="ibox-content">
                            <div id="morris-one-line-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection
@push('script')

    <script type="text/javascript">
        
        function show_log(id=''){
            var modal_url = base_url + '/show-log';

            var footer = '<button class="btn btn-primary" data-style="expand-right" onclick="form_submit()">Submit</button><button class="btn btn-white" type="button" data-dismiss="modal">Cancel</button>';

            Modal('modal_log', 'Log Activity', modal_url , '', 'modal-lg', 'auto');
        }
    </script>

	<script type="text/javascript">
		$(document).ready(function() {
            let toast = $('.toast');
            setTimeout(function() {
                toast.toast({
                    delay: 5000,
                    animation: true
                });
                toast.toast('show');
            }, 2200);
            var data1 = [
                [0, 4],
                [1, 8],
                [2, 5],
                [3, 10],
                [4, 4],
                [5, 16],
                [6, 5],
                [7, 11],
                [8, 6],
                [9, 11],
                [10, 30],
                [11, 10],
                [12, 13],
                [13, 4],
                [14, 3],
                [15, 3],
                [16, 6]
            ];
            var data2 = [
                [0, 1],
                [1, 0],
                [2, 2],
                [3, 0],
                [4, 1],
                [5, 3],
                [6, 1],
                [7, 5],
                [8, 2],
                [9, 3],
                [10, 2],
                [11, 1],
                [12, 0],
                [13, 2],
                [14, 8],
                [15, 0],
                [16, 0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis: {},
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            });
            var doughnutData = {
                labels: @php echo json_encode($maintenance['status']); @endphp,
                datasets: [{
                    data: @php echo json_encode($maintenance['total']); @endphp,
                    backgroundColor:  <?php echo json_encode($maintenance['color']); ?>
                }]
            };
            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                },
                 tooltips:{
                    bodyFontSize:8.5
                }
            };
            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {
                type: 'doughnut',
                data: doughnutData,
                options: doughnutOptions
            });
            var doughnutData = {
                labels: @php echo json_encode($transaction['status']); @endphp,
                datasets: [{
                    data: @php echo json_encode($transaction['total']); @endphp,
                    backgroundColor:  <?php echo json_encode($transaction['color']); ?>
                }]
            };
            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                },
                tooltips:{
                    bodyFontSize:8.5
                }
            };
            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {
                type: 'doughnut',
                data: doughnutData,
                options: doughnutOptions
            });

           
            var barData = {
                labels: @php echo json_encode($curr['status']); @endphp,
                datasets: [
                    {
                        label: "Total Currency",
                        backgroundColor: 'rgba(26,179,148,0.5)',
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: @php echo json_encode($curr['total']); @endphp
                    }
                ]
            };

            var barOptions = {
                responsive: true
            };


            var ctx5 = document.getElementById("barChart").getContext("2d");
            new Chart(ctx5, {type: 'bar', data: barData, options:barOptions});

            var y = new Date();
            var mem = $('#period').datepicker({
                setDate:y,
                viewMode:'years',
                minViewMode:'years',
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: false,
                format: 'yyyy',
                autoclose: true
            });
            

            $("#period").on('change', function(){
                load_data_trx_series($(this).val());
            });

            load_data_trx_series(y.getFullYear());

        });

        function load_data_trx_series(year){
            loadingbar('loading');
           
            $("#morris-one-line-chart").empty();

            var url = base_url + '/dashboard/get-data-trx-series/'+year;
            var dataArr=[];
            $.ajax({
                url: url,
                type: 'GET',
                processData: false,
                contentType: 'application/json',
                success: function(res){
                   
                   if(res.length == 0){
                    $("#morris-one-line-chart").html("Transaction Not Found");
                    return false;

                   }
                   $.each(res, function(i,item){
                        dataArr.push({
                            year: item.date, value: item.total 
                        });
                       
                    });

                    Morris.Line({
                        element: 'morris-one-line-chart',
                            data: dataArr,
                            xkey: 'year',
                            ykeys: ['value'],
                            resize: true,
                            lineWidth:4,
                            labels: ['Total Transaction'],
                            lineColors: ['#1ab394'],
                            pointSize:5,
                    });

                    closeLoadingbar('loading');
                    }
              });
           
        }
	</script>

@endpush