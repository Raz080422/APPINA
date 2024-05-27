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

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <a href="javascript:void(0)" class="btn btn-success " onclick="form_project()"><i
                                    class="fa fa-plus"></i> Add Template</a>

                            <div class="ibox-tools">
                                <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover datatables">
                                    <thead>
                                        <tr>
                                            <th>Template No</th>
                                            <th>Tittle Template</th>
                                            <th>Root Page</th>
                                            <th>Category Page</th>
                                            <th>Link Template</th>
                                            <th>Status Template</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($template as $row)
                                            <tr class="gradeX">
                                                <td>{{ $row['szTemplateId'] }}</td>
                                                <td>{{ $row['szTitle'] }}</td>
                                                <td>{{ $row['szRootPage'] }}</td>
                                                <td>{{ $row['szCategory'] }}</td>
                                                <td><a href="{{ $row['szLinkTemplate'] }}">{{ $row['szLinkTemplate'] }}</td>
                                                <td>{{ $row['szStatus'] == 1 ? 'Active' : 'Not Active' }}</td>
                                                <td class="text-center" width="15%">
                                                    <button class="btn btn-success btn-circle" type="button"
                                                        onclick="form_template('{{ $row['szTemplateId'] }}','edit')"
                                                        data-toggle='tooltip' title="Edit Template"><i
                                                            class="fa fa-link"></i></button>
                                                    <button class="btn btn-info btn-circle" type="button"
                                                        onclick="form_template('{{ $row['szTemplateId'] }}','update')"
                                                        data-toggle='tooltip' title="Update Template"><i
                                                            class="fa fa-check"></i></button>
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
            function form_template(id, action = '') {
                var title = 'Form Project';

                var footer =
                    '<button class="ladda-button btn btn-primary" data-style="expand-right" onclick="form_submit()">Submit</button><button class="btn btn-white btn-sm" type="button" data-dismiss="modal">Cancel</button>';

                if (id) {
                        var modal_url = base_url + '/document/template-detail/' + id + '?action=' + action;
                } else {
                    var modal_url = base_url + '/project/editproject/';
                }
                console.log(action);

                Modal('form_project', title, modal_url, footer, 'modal-lg', 'auto');
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
