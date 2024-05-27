@extends('template.backend.index')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Active Project</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('/') }}">Home</a> </li>
                <li class="breadcrumb-item">Project</li>
            </ol>
        </div>
        <div class="col-lg-2"> </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <a href="javascript:void(0)" class="btn btn-success " onclick="form_project()"><i
                                    class="fa fa-plus"></i> Create Project</a>

                            <div class="ibox-tools">
                                <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Aplication Name</th>
                                            <th>Project Id</th>
                                            <th>Project Name</th>
                                            <th>Progress Task</th>
                                            <th>Done Task</th>
                                            <th class="text-center">Status Documents</th>
                                            <th class="text-center">Status Assign</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($data as $row)
                                            <tr class="gradeX">
                                                <td width="5%">{{ $no++ }}</td>
                                                <td>{{ $row['AppName'] }}</td>
                                                <td>{{ $row['szJiraCode'] }}</td>
                                                <td>{{ $row['ProjectName'] }}</td>
                                                <td>{{ $row['ProgressTask'] }}</td>
                                                <td>{{ $row['DoneTask'] }}</td>
                                                <td class="text-center" width="10%">
                                                    <p><span
                                                            class="badge badge-{{ $row['DocStatus'] == 1 ? 'primary' : 'danger' }}">{{ $row['DocStatus'] == 1 ? 'Done' : 'In Progress' }}</span>
                                                    </p>
                                                </td>
                                                <td class="text-center" width="8%">
                                                    @foreach ($assignee as $dataAssignee)
                                                        @if ($dataAssignee['szProjectId'] == $row['ProjectId'])
                                                            <p><span
                                                                    class="badge badge-{{ $dataAssignee['szAssignee'] > 0 ? 'primary':'danger'}}">{{ $dataAssignee['szAssignee'] > 0 ? 'Assigneed' : 'Need Assigneed' }}</span>
                                                            </p>
                                                        @else
                                                            <p><span
                                                                    class="badge badge-danger">{{ $dataAssignee['szAssignee'] > 0 ? 'Need Assigneed' : '' }}</span>
                                                            </p>
                                                        @endif
                                                    @endforeach

                                                </td>
                                                <td class="text-center" width="15%">
                                                    <button class="btn btn-success btn-circle" type="button"
                                                        onclick="getDetail('{{ $row['ProjectId'] }}','project')"
                                                        data-toggle='tooltip' title="Detail Project"><i
                                                            class="fa fa-link"></i></button>
                                                    <button class="btn btn-info btn-circle" type="button"
                                                        onclick="detail_document('{{ $row['ProjectId'] }}','document')"
                                                        data-toggle='tooltip' title="Detail Document"><i
                                                            class="fa fa-check"></i></button>
                                                    <button class="btn btn-light btn-circle" type="button"
                                                        onclick="detail_task('{{ $row['ProjectId'] }}','task')"
                                                        data-toggle='tooltip' title="Detail Task"><i
                                                            class="fa fa-check"></i></button>
                                                    <button class="btn btn-warning btn-circle" type="button"
                                                        onclick="delete_user('{{ $row['ProjectId'] }}')"
                                                        data-toggle='tooltip' title="Delete Project"><i
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
        </div>

        <script type="text/javascript">
            function form_project(id, action = '') {
                var title = 'Form Project';

                var footer =
                    '<button class="ladda-button btn btn-primary" data-style="expand-right" onclick="form_submit()">Submit</button><button class="btn btn-white btn-sm" type="button" data-dismiss="modal">Cancel</button>';

                if (id) {
                    if (action == 'project') {
                        var modal_url = base_url + '/project/project-detail/' + id;
                    } else if (action == 'document') {
                        var modal_url = base_url + '/project/document-detail/' + id;
                        var footer = '';
                    } else if (action == 'edit') {
                        var modal_url = base_url + '/project/documents-edit/' + id + '?action=' + action;
                    }
                } else {
                    var modal_url = base_url + '/project/editproject/';
                }
                console.log(action);

                Modal('form_project', title, modal_url, footer, 'modal-lg', 'auto');
            }

            function getDetail(id, action = '') {
                var url = base_url + '/project/project-detail/' + id;
                window.location.href = url;
            }

            function detail_task(id, action = '') {
                var url = base_url + '/task/get-alltask?id=' + id + '&action=' + action;
                // var url = base_url + '/task/get-alltask/';
                window.location.href = url;
            }

            function detail_document(id) {
                var url = base_url + '/document/document-detail/' + id;
                // console.log(url);
                window.location.href = url;
            }

            function delete_user(id) {
                swal({
                    title: 'Are you sure want to remove this user?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Process'
                }).then((result) => {
                    if (result.value) {
                        var url = base_url + '/setting/user-management/remove/' + id;
                        window.location.href = url;
                    }
                })
            }
        </script>
    </div>
@endsection
