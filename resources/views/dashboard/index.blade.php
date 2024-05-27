@extends('template.backend.index')
@section('content')
	<div class="row  border-bottom white-bg dashboard-header mb-2">
        <div class="col-md-8">
            <h2>Dashboard</h2>
            <!-- <small>You have 42 messages and 6 notifications.</small> -->
            <div class="">
               <!-- <div class="flot-chart-content" id="flot-dashboard-chart"></div> -->
                <!-- <canvas id="barChart" height="90" style="margin: 15px auto 0"></canvas> -->
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content mb-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
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
                                                <th>Nama Aplikasi</th>
                                                <th>Total Project</th>
                                                <th>Progress Project</th>
                                                <th>Done Project</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach($application as $row)
                                                <tr class="pointer">
                                                    <td>{{$no++}}</td>
                                                    <td>{{$row['AppName']}}</td>
                                                    <td>{{$row['TotalProject']}}</td>
                                                    <td>{{$row['ProgressProject']}}</td>
                                                    <td>{{$row['DoneProject']}}</td>

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
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control text-center datepicker" name="period" id="period">
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

        function show_log($id){
            var modal_url = base_url + '/show-log';

            var footer = '<button class="btn btn-primary" data-style="expand-right" onclick="form_submit()">Submit</button><button class="btn btn-white" type="button" data-dismiss="modal">Cancel</button>';

            Modal('modal_log', 'Log Activity', modal_url , '', 'modal-lg', 'auto');
        }
    </script>

	<script type="text/javascript">
		$(document).ready(function() {
            let toast = $('.toast');

        });

        function load_data_trx_series(year){

            $("#morris-one-line-chart").empty();

            loadingbar('loading');


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
                            year: item.year, value: item.value
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
