<form action="{{ url('/management/user-create') }}" method="POST" id="form_user">
     @csrf
    <!-- Field UserName -->
    <div class="form-group row">
    	<label class="col-lg-12">Username</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="username" value="{{($id) ? $data['szUserLogin']:''}}" required {{ ($action == 'edit') ? 'readonly' : '' }} autocomplete="off">
           <input type="hidden" class="form-control" name="idoperator" value="{{$id}}" >
           <input type="hidden" class="form-control" name="memberId" value="{{($id) ? $data['szMemberId']:''}}" >
        </div>
    </div>

    <!-- Field Name -->
    <div class="form-group row">
    	<label class="col-lg-12">Name</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="name" value="{{($id) ? $data['szMemberName']:''}}" required autocomplete="off">
        </div>
    </div>

    <div class="form-group row">
    <div class="col-lg-6 ">
    <!-- Option Role Name -->
    <div class="form-group row">
    	<label class="col-lg-12">Role</label>
        <div class="col-lg-12">
            @if($action == 'detail')
    	        <input type="text" class="form-control" name="idrole" value="{{($id) ? $data['szRoleName']:''}}" required autocomplete="off">
    	        <!-- <input type="text" class="form-control" name="username" value="{{var_dump($role);}}" required autocomplete="off">             -->
            @else
                <select class="select2 " name="idrole" required>
                    <option value="">-- Select Role --</option>
                    @if($id)
                        @foreach($role as $row)
                            <!-- <input type="select2" class="form-control" name="username" value="{{$row['szRoleName']}}" required autocomplete="off"> -->
                            <option value="{{ $row['szRoleId']}}" {{ ( strtolower($data['szTeamRole']) == strtolower($row['szRoleId']) ) ? 'selected' : '' }}>{{$row['szRoleName'] }}</option>
                        @endforeach
                    @else
                    @foreach($role as $row)
                            <!-- <input type="select2" class="form-control" name="username" value="{{$row['szRoleName']}}" required autocomplete="off"> -->
                            <option value="{{ $row['szRoleId']}}">{{$row['szRoleName'] }}</option>
                        @endforeach
                    @endif
                </select>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-6 ">
    <!-- Option Team  Name -->
    <div class="form-group row">
    	<label class="col-lg-12">Team</label>
        <div class="col-lg-12">
            @if($action == 'detail')
    	        <input type="text" class="form-control" name="idteam" value="{{($id) ? $data['szTeamName']:''}}" required autocomplete="off">
    	        <!-- <input type="text" class="form-control" name="username" value="{{var_dump($role);}}" required autocomplete="off">             -->
            @else
                <select class="select2 " name="idteam" required>
                    <option value="">-- Select Team --</option>
                    @if($id)
                        @foreach($team as $row)
                            <option value="{{ $row['szTeamId']}}" {{ ( strtolower($data['szTeamId']) == strtolower($row['szTeamId']) ) ? 'selected' : '' }}>{{$row['szTeamName'] }}</option>
                        @endforeach
                    @else
                    @foreach($team as $row)
                            <option value="{{ $row['szTeamId']}}">{{$row['szTeamName'] }}</option>
                        @endforeach
                    @endif
                </select>
            @endif
        </div>
    </div>
</div>
    </div>
    <div class="form-group row">
    <div class="col-lg-6 ">
    <!-- Radio Button Status -->
    <div class="form-group row">
    	<label class="col-lg-12">Status</label>
        <div class="col-lg-12">
            @if($action == 'detail')
    	        <input type="text" class="form-control" name="status" value="{{($data['szStatus'] == '1') ? 'Active' : 'No Active'}}" readonly required autocomplete="off">
    	        <!-- <input type="text" class="form-control" name="username" value="{{var_dump($role);}}" required autocomplete="off">             -->
            @else
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="1" name="status" {{ ($id && $data['szStatus'] == '1') ? 'checked' : 'checked'}}>
                    <label for="inlineRadio1"> Active </label>
                      &nbsp;&nbsp;
                    <input type="radio" id="inlineRadio2" value="0" name="status" {{ ($id && $data['szStatus'] == 0) ? 'checked' : '' }}>
                    <label for="inlineRadio2"> No Active </label>
                </div>
            @endif
        </div>
    </div>
</div>
    <div class="col-lg-6 ">
    <!-- Field Struktural -->
    <div class="form-group row">
    	<label class="col-lg-12">Structure</label>
        <div class="col-lg-12">
            @if($action == 'detail')
    	        <input type="text" class="form-control" name="struktur" value="{{($id) ? $data['szOrganizationalStructure']:''}}" required autocomplete="off">
            @else
            <select class="select2 " name="struktur" required>
                <option value="">-- Select Role --</option>
                <option value="Organik" {{ ($id && strtolower($data['szOrganizationalStructure']) == strtolower('Organik') ) ? 'selected' : '' }}>Organik</option>
                <option value="Insource" {{ ($id && strtolower($data['szOrganizationalStructure']) == strtolower('Insource') ) ? 'selected' : '' }}>Insource</option>
                <option value="Outsource" {{ ($id && strtolower($data['szOrganizationalStructure']) == strtolower('Outsource') ) ? 'selected' : '' }}>Outsource</option>
                </select>
            @endif
        </div>
    </div>
</div>
</div>

<div class="form-group row">
<div class="col-lg-6 ">
    <!-- Field JG PG -->
    <div class="form-group row">
    	<label class="col-lg-12">Job Grade</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="jg" value="{{($id) ? $data['szRole']:''}}" required autocomplete="off">
        </div>
    </div>
</div>
<div class="col-lg-6 ">
    <!-- Field Vendor -->
    <div class="form-group row">
    	<label class="col-lg-12">Partner(Vendor)</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="partner" value="{{($id) ? $data['szPartnerName']:''}}" required autocomplete="off">
        </div>
    </div>
</div>
</div>
<div class="form-group row">
    <div class="col-lg-6 ">
    <!-- Field PN -->
    <div class="form-group row">
    	<label class="col-lg-12">Personal Number</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="pn" value="{{($id) ? $data['szPersonalNumber']:''}}" required autocomplete="off">
        </div>
    </div>
</div>
<div class="col-lg-6 ">
    <!-- Field Jira -->
    <div class="form-group row">
    	<label class="col-lg-12">Jira User</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="jira" value="{{($id) ? $data['szJiraId']:''}}" required autocomplete="off">
        </div>
    </div>
</div>
</div>
    <!-- Field PN -->
    <div class="form-group row">
    	<label class="col-lg-12">Confluence User</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="confluence" value="{{($id) ? $data['szConfluenceId']:''}}" required autocomplete="off">
        </div>
    </div>

    <!-- Field SK -->
    <div class="form-group row">
    	<label class="col-lg-12">SK Date</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="sk" value="{{($id) ? $data['dtmTMTStarted']:''}}" required autocomplete="off">
        </div>
    </div>

    <div class="form-group row">
    </div>
     <button style="display: none;" id="btn_submit"></button>
</form>

<script type="text/javascript">
    $(function(){
        @if($action == 'detail')
            $("#form_user .form-control").attr('disabled', 'disabled');
        @endif
    });

    $(".select2").select2({
        theme: 'bootstrap4',
        dropdownParent:'#form_user'
    });
	// Bind normal buttons
        Ladda.bind( '.ladda-button',{ timeout: 2000 });

        // Bind progress buttons and simulate loading progress
        Ladda.bind( '.progress-demo .ladda-button',{
            callback: function( instance ){
                var progress = 0;
                var interval = setInterval( function(){
                    progress = Math.min( progress + Math.random() * 0.1, 1 );
                    instance.setProgress( progress );

                    if( progress === 1 ){
                        instance.stop();
                        clearInterval( interval );
                    }
                }, 200 );
            }
        });


        var l = $( '.ladda-button-demo' ).ladda();

        l.click(function(){
            // Start loading
            l.ladda( 'start' );

            // Timeout example
            // Do something in backend and then stop ladda
            setTimeout(function(){
                $('#form_user').modal('toggle');
                l.ladda('stop');
            },12000)

        });

    function form_submit(){    
        var form = $('#form_user');
        var validation = input_validator('form_user');
        if(validation.fail == false){
             $('#btn_submit').click();
        }
    }

</script>