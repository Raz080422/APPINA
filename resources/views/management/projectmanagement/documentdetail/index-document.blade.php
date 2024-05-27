@extends('template.backend.index')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Project Detail:
                {{ $project['szProjectName'] }}
            </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('/') }}">Home</a> </li>
                <li class="breadcrumb-item"> <a href="{{ url('/project/allProject') }}">Project</a></li>
                <li class="breadcrumb-item"> Project Detail</a></li>
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
                            <form action="{{ url('/document/post-document') }}" method="POST" class="table-responsive px-3"
                                id="form_submit">
                                @csrf
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
                                                    <td>{{ $row['szStatus'] == '1' ? 'Created' : ($row['szStatus'] == '2' ? 'Waiting Update':($row['szStatus'] == '3' ? 'Release':'Queue')) }}</td>
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
                            </form>
                            <div class="row px-3">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button class="btn btn-success btn-xs px-5"
                                        onclick="process_transactions('approved', '{{$projectid  }}')"><i
                                            class="fa fa-check-square-o">&nbsp;</i>Process Documents</button>
                                    <button class="btn btn-info btn-xs px-5" type="button"
                                        onclick="process_transactions('check')"><i
                                            class="fa fa-info">&nbsp;</i>Checking Mapping Data</button>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function process_transactions(action, projectId) {
            $('#action').val(action);
            $('#projectId').val(projectId);
            console.log(projectId);
            swal({
                title: 'Are you sure?',
                text: 'Want to process this data?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Process'
            }).then((result) => {
                if (result.value) {
                    var url = base_url + '/document/post-document?projectid=' +projectId+'&action='+action;
                    window.location.href = url;
                }
            })
        }

        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
