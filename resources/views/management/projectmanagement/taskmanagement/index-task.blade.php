@extends('template.backend.index')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Project Task:
                {{ $project['szProjectName'] }}
            </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('/') }}">Home</a> </li>
                <li class="breadcrumb-item"> <a href="{{ url('/project/allProject') }}">Project</a></li>
                <li class="breadcrumb-item"> Project Task</a></li>
            </ol>
        </div>
        <div class="col-lg-2"> </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Task Name</th>
                                            <th>Link Document</th>
                                            <th>Plan Date</th>
                                            <th>Process Date</th>
                                            <th class="text-center">Status Task</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($data as $row)
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
                                                    @if ($row['szStatus'] == 0)
                                                        <button class="btn btn-info btn-circle" type="button"
                                                            onclick="detail_document('{{ $row['szProjectId'] }}','document')"
                                                            data-toggle='tooltip' title="Update In Progress"><i
                                                                class="fa fa-arrows"></i></button>
                                                        <button class="btn btn-primary btn-circle" type="button"
                                                            onclick="detail_document('{{ $row['szProjectId'] }}','document')"
                                                            data-toggle='tooltip' title="Update Done"><i
                                                                class="fa fa-check"></i></button>
                                                        <button class="btn btn-warning btn-circle" type="button"
                                                            onclick="delete_user('{{ $row['szProjectId'] }}')"
                                                            data-toggle='tooltip' title="Dispose Task"><i
                                                                class="fa fa-times"></i></button>
                                                    @elseif($row['szStatus'] == 1)
                                                        <button class="btn btn-primary btn-circle" type="button"
                                                            onclick="detail_document('{{ $row['szProjectId'] }}','document')"
                                                            data-toggle='tooltip' title="Update Done"><i
                                                                class="fa fa-check"></i></button>`
                                                        <button class="btn btn-warning btn-circle" type="button"
                                                            onclick="delete_user('{{ $row['szProjectId'] }}')"
                                                            data-toggle='tooltip' title="Dispose Task"><i
                                                                class="fa fa-times"></i></button>
                                                    @endif
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
            function form_project(id, detailitem,action = '') {
                var title = 'Form Project';

                var footer =
                    '<button class="ladda-button btn btn-primary" data-style="expand-right" onclick="form_submit()">Submit</button><button class="btn btn-white btn-sm" type="button" data-dismiss="modal">Cancel</button>';

                if (id) {
                    if (action == 'task') {
                        var modal_url = base_url + '/task/get-detailtask?id=' + id+ '&number=' + detailitem;
                    } else if (action == 'document') {
                        var modal_url = base_url + '/project/document-detail/' + id;
                        var footer = '';
                    } else if (action == 'edit') {
                        var modal_url = base_url + '/project/documents-edit/' + id + '?action=' + action;
                    }
                } else {
                    var modal_url = base_url + '/project/project-form/';
                }
                console.log(action);

                Modal('form_project', title, modal_url, footer, 'modal-lg', 'auto');
            }

            function detail_task(id, detailitem, action = '') {
                var url = base_url + '/project/document-detail?id=' + id + '&number=' + detailitem;
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
