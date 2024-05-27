@extends('template.backend.index')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Template Document</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('/') }}">Home</a> </li>
                <li class="breadcrumb-item">Project</li>
            </ol>
        </div>
        <div class="col-lg-2"> </div>
    </div>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <div class="form-group row">
            </div>
        </div>
        <div class="col-lg-12">
            <h4>
                <div class="form-group row">
                    <div class="col-lg-2 ">
                        <label>Project Summary : </label>
                    </div>
                    <div class="col-lg-8">
                        <label>{{ $id ? $data['szProjectName'] : '' }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Jira ID</label>
                    <div class="col-lg-8">
                        <label name="brdtittle">
                            {{ $id ? $data['szJiraCode'] : '' }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Link Jira Project</label>
                    <div class="col-lg-8">
                        <label name="jira">
                            <a href="{{ $id ? $data['szJiraLink'] : '' }}">{{ $id ? $data['szJiraLink'] : '' }}</a></label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">BRD Page</label>
                    <div class="col-lg-8">
                        <label name="brdtittle">
                            {{ $id ? $data['szBRDTittle'] : '' }} (<a
                                href="{{ $id ? $data['szBRDLink'] : '' }}">{{ $id ? $data['szBRDLink'] : '' }}</a>)</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Development Page</label>
                    <div class="col-lg-8">
                        <label name="brdtittle">
                            {{ $id ? $data['szDevTittle'] : '' }} (<a
                                href="{{ $id ? $data['szDevLink'] : '' }}">{{ $id ? $data['szDevLink'] : '' }}</a>)</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Description Project</label>
                    <div class="col-lg-8">
                        <label name="brdtittle">
                            {{ $id ? $data['szDescription'] : '' }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Assignee</label>
                    <div class="col-lg-8">
                        <div class="form-group row">
                            @foreach ($assignee as $row)
                                <div class="col-lg-8">
                                    <label name="brdtittle">
                                        {{ $row['szMemberName'] }} ({{ $row['szAssigneeId'] }})</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </h4>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="form-group row">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Document Name</th>
                                                <th>Link Document</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach ($document as $row)
                                                <tr class="gradeX">
                                                    <td width="5%">{{ $no++ }}</td>
                                                    @if ($row['szCategory'] == 'RootPage')
                                                        <td>{{ $project['szProjectName'] }}</td>
                                                    @else
                                                        <td>{{ $row['szTittleProject'] }}</td>
                                                    @endif

                                                    <td><a href="{{ $row['szShortLink'] }}">{{ $row['szShortLink'] }}</td>
                                                    <td>{{ $row['szStatus'] == '1' ? 'Created' : ($row['szStatus'] == '2' ? 'Waiting Update' : ($row['szStatus'] == '3' ? 'Release' : 'Queue')) }}
                                                    </td>
                                                    <td class="text-center" width="15%">
                                                        <button class="btn btn-success btn-circle" type="button"
                                                            onclick="form_project('{{ $row['szPageId'] }}','task')"
                                                            data-toggle='tooltip' title="Detail Project"><i
                                                                class="fa fa-link"></i></button>
                                                        <button class="btn btn-info btn-circle" type="button"
                                                            onclick="detail_document('{{ $row['szPageId'] }}','document')"
                                                            data-toggle='tooltip' title="Detail Document"><i
                                                                class="fa fa-check"></i></button>
                                                        <button class="btn btn-warning btn-circle" type="button"
                                                            onclick="delete_user('{{ $row['szPageId'] }}')"
                                                            data-toggle='tooltip' title="Delete User"><i
                                                                class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="form-group row">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Item Mapping</th>
                                                <th>Value Mapping</th>
                                                <th>Plan Date</th>
                                                <th>Last Update</th>
                                                <th class="text-center">Status Mapping</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach ($task as $row)
                                                <tr class="gradeX">
                                                    <td width="5%">{{ $no++ }}</td>
                                                    <td>{{ $row['szItem'] }}</td>
                                                    <td>{{ $row['szLink'] }}</td>
                                                    <td>{{ $row['dtmPlan'] }}</td>
                                                    <td>{{ $row['dtmProcess'] }}</td>
                                                    <td class="text-center">
                                                        <p>
                                                            <span
                                                                class="badge badge-{{ $row['szStatus'] == '0' ? 'secondary' : ($row['szStatus'] == '1' ? 'success' : ($row['szStatus'] == '2' ? 'primary' : 'danger')) }}">
                                                                <strong>{{ $row['szStatus'] == '0' ? 'OPEN' : ($row['szStatus'] == '1' ? 'IN PROGRESS' : ($row['szStatus'] == '2' ? 'DONE' : 'DISPOSE')) }}
                                                                </strong>
                                                            </span>
                                                        </p>
                                                    </td>
                                                    <td class="text-center" width="15%">
                                                        {{-- Edit Task Button --}}
                                                        <button class="btn btn-success btn-circle" type="button"
                                                            onclick="form_project('{{ $row['szProjectId'] }}','{{ $row['shItemNumber'] }}','task')"
                                                            data-toggle='tooltip' title="Edit Task"><i
                                                                class="fa fa-link"></i></button>
                                                    </td>
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
    </div>

    <script type="text/javascript">
        $(function() {
            @if ($action == 'task' || $action == 'documents')
                $("#form_project .form-control").attr('disabled', 'disabled');
            @endif
        });

        $(".select2").select2({
            theme: 'bootstrap4',
            dropdownParent: '#form_project'
        });
        // Bind normal buttons
        Ladda.bind('.ladda-button', {
            timeout: 2000
        });

        // Bind progress buttons and simulate loading progress
        Ladda.bind('.progress-demo .ladda-button', {
            callback: function(instance) {
                var progress = 0;
                var interval = setInterval(function() {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);

                    if (progress === 1) {
                        instance.stop();
                        clearInterval(interval);
                    }
                }, 200);
            }
        });


        var l = $('.ladda-button-demo').ladda();

        l.click(function() {
            // Start loading
            l.ladda('start');

            // Timeout example
            // Do something in backend and then stop ladda
            setTimeout(function() {
                $('#form_project').modal('toggle');
                l.ladda('stop');
            }, 12000)

        });

        function form_submit() {
            var form = $('#form_project');
            var validation = input_validator('form_project');
            if (validation.fail == false) {
                $('#btn_submit').click();
            }
        }
    </script>
@endsection
