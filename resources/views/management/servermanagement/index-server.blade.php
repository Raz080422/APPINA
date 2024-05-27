@extends('template.backend.index')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('/') }}">Home</a> </li>
            <li class="breadcrumb-item"> <a>Setting</a> </li>
            <li class="breadcrumb-item active"> <strong>User Management</strong> </li>
        </ol>
    </div>
    <div class="col-lg-2"> </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <a href="javascript:void(0)" class="btn btn-success " onclick="form_user()"><i class="fa fa-plus"></i> Create User</a>

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
                                     <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($data as $row)
                                <tr class="gradeX">
                                    <td width="5%">{{$no++}}</td>
                                    <td>{{$row['NAMA']}}</td>
                                    <td>{{$row['USERNAME']}}</td>
                                    <td>{{$row['EMAIL']}}</td>
                                    <td>{{$row['JABATAN']}}</td>
                                    <td class="text-center" width="10%">
                                        <p><span class="badge badge-{{$row['BADGE']}}">{{$row['STATUS_USER']}}</span></p>
                                    </td>
                                    <td class="text-center" width="15%">
                                        <button class="btn btn-success btn-circle" type="button" onclick="form_user('{{$row["IDOPERATOR"]}}','detail')" data-toggle='tooltip' title="Detail User"><i class="fa fa-link"></i></button>
                                        <button class="btn btn-info btn-circle" type="button" onclick="form_user('{{$row["IDOPERATOR"]}}','edit')" data-toggle='tooltip' title="Edit User"><i class="fa fa-check"></i></button>
                                        <button class="btn btn-warning btn-circle" type="button" onclick="delete_user('{{$row["IDOPERATOR"]}}')" data-toggle='tooltip' title="Delete User"><i class="fa fa-times"></i></button>
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
@endsection
@push('script')
    <script type="text/javascript">
        function form_user(id,action=''){
            var title     =  'Form User';

            var footer = '<button class="ladda-button btn btn-primary" data-style="expand-right" onclick="form_submit()">Submit</button><button class="btn btn-white btn-sm" type="button" data-dismiss="modal">Cancel</button>';

            if(id){
                var modal_url = base_url + '/setting/user-management/form/';

                if(action == 'detail'){
                    var footer='';
                }
            }else{
                var modal_url = base_url + '/setting/user-management/form';
            }
           

            Modal('form_user', title, modal_url , footer, 'modal-lg', 'auto');
        }

    

         function delete_user(id)
        {       
            swal({
              title: 'Are you sure want to remove this user?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Process'
            }).then((result) => {
                if (result.value) {  
                    var url = base_url + '/setting/user-management/remove/' +id;
                    window.location.href = url;
                }
            })
        }
    </script>
@endpush