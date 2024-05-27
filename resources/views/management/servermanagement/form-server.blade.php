<form action="{{ url('setting/user-management/form-submit') }}" method="POST" id="form_user">
     @csrf
    <div class="form-group row">
    	<label class="col-lg-12">Username</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="username" value="{{ ($id) ? $data['USERNAME'] : '' }}" {{ ($id) ? 'readonly' : '' }} required autocomplete="off">
        </div>
    </div>
    <div class="form-group row">
    </div>
    <div class="form-group row">
        <div class="col-lg-6 ">
            <div class="form-group row">
                <label class="col-lg-12">Nama</label>
                <div class="col-lg-12">
                   <input type="text" class="form-control" name="nama" value="{{ ($id) ? $data['NAMA'] : '' }}"  required {{ ($action == 'detail') ? 'readonly' : '' }} autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="form-group row">
            	<label class="col-lg-12">Email</label>
                <div class="col-lg-12">
                	<input type="email" class="form-control" name="email" value="{{ ($id) ? $data['EMAIL'] : '' }}"   required autocomplete="off">
                    <input type="hidden" class="form-control" name="idoperator" value="{{$id}}" >
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-6 p-0">
            <label class="col-lg-12">Hak Akses</label>
            <div class="form-group col-lg-12">
            @if($action == 'detail')
                     <input type="text" class="form-control" name="idhakakses" value="{{$data['NAMAHAKAKSES']}}" readonly required autocomplete="off">
            @else 
               <select class="select2 " name="idhakakses" required>
                    <option value="">-- Select Hak Akses --</option>
                    @if($id)
                        @foreach($hak_akses as $row)
                            <option value="{{ $row['IDHAKAKSES'] }}" {{ ( strtolower($data['IDHAKAKSES']) == strtolower($row['IDHAKAKSES']) ) ? 'selected' : '' }}>{{ $row['NAMAHAKAKSES'] }}</option>
                        @endforeach   
                    @else
                        @foreach($hak_akses as $row)
                            <option value="{{ $row['IDHAKAKSES'] }}">{{ $row['NAMAHAKAKSES'] }}</option>
                        @endforeach   
                    @endif
                </select>
            @endif
            </div>
             <span class="label-error"></span>
        </div>
        <div class="col-lg-6 p-0">
        	<label class="col-lg-12">Jabatan</label>
            <div class="form-group col-lg-12">
                @if($action == 'detail')
                     <input type="text" class="form-control" name="jabatan" value="{{$data['JABATAN']}}" readonly required autocomplete="off">
                @else 
            	<select class=" select2" name="jabatan" required>
                    <option value="">-- Select Jabatan --</option>
                    @if($id)
                        @foreach($position as $row)
                            <option value="{{ $row }}" {{ ( strtolower($data['JABATAN']) == strtolower($row) ) ? 'selected' : '' }}>{{ $row }}</option>
                        @endforeach   
                    @else
                        @foreach($position as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach   
                    @endif
                </select>
                @endif
            </div>
            <span class="label-error"></span>
        </div>
    </div>
    <div class="form-group row">
    	<label class="col-lg-12">Status</label>
            <div class="col-lg-12">
            @if($action == 'detail')
                     <input type="text" class="form-control" name="status" value="{{ ($data['STATUS'] == '1') ? 'Active' : 'No Active'}}" readonly required autocomplete="off">
            @else 
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="1" name="status" {{ ($id && $data['STATUS'] == '1') ? 'checked' : 'checked'}}>
                    <label for="inlineRadio1"> Active </label>
                      &nbsp;&nbsp;
                    <input type="radio" id="inlineRadio2" value="0" name="status" {{ ($id && $data['STATUS'] == 0) ? 'checked' : '' }}>
                    <label for="inlineRadio2"> No Active </label>
                </div>
            @endif
        </div>
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