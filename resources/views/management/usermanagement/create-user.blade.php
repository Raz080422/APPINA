<form action="{{ url('/management/user-create') }}" method="POST" id="form_user">
     @csrf
    <!-- Field UserName -->
    <div class="form-group row">
    	<label class="col-lg-12">Username</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="username" value=" "autocomplete="off">
        </div>
    </div>
    <div class="form-group row">
    </div>

    <!-- Field Name -->
    <div class="form-group row">
    	<label class="col-lg-12">Name</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="name" value="" required autocomplete="off">
        </div>
    </div>
    <div class="form-group row">
    </div>

    <!-- Field Role Name -->
    <div class="form-group row">
    	<label class="col-lg-12">Role</label>
        <div class="col-lg-12">
        <select class="select2 " name="idrole" required>
            <option value="">-- Select Role --</option>
                @foreach($role as $row)
                    <!-- <input type="select2" class="form-control" name="username" value="{{$row['szRoleName']}}" required autocomplete="off"> -->
                    <option value="{{ $row['szRoleId']}}">{{$row['szRoleName'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Field Team  Name -->
    <div class="form-group row">
    	<label class="col-lg-12">Team</label>
        <div class="col-lg-12">
            <select class="select2 " name="idteam" required>
                <option value="">-- Select Team --</option>
                @foreach($team as $row)
                <option value="{{ $row['szTeamId']}}">{{$row['szTeamName'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Field Status -->
    <div class="form-group row">
    	<label class="col-lg-12">Status</label>
        <div class="col-lg-12">
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="1" name="status" >
                    <label for="inlineRadio1"> Active </label>
                      &nbsp;&nbsp;
                    <input type="radio" id="inlineRadio2" value="0" name="status">
                    <label for="inlineRadio2"> No Active </label>
                </div>
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