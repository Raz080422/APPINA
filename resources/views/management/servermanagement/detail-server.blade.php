<form action="# method="POST" id="detail_user">
     @csrf

    <div class="form-group row">
    	<label class="col-lg-12">Username</label>
        <div class="col-lg-12">
    	   <input type="text" class="form-control" name="username" value="<?php echo $data['USERNAME']; ?>" readonly autocomplete="off">
        </div>
    </div>
    <div class="form-group row">
    </div>
    <div class="form-group row">
        <div class="col-lg-6 ">
            <div class="form-group row">
                <label class="col-lg-12">Nama</label> 
                <div class="col-lg-12">
                   <input type="text" class="form-control" name="nama" value="{{$data['NAMA']}}"  readonly autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="form-group row">
            	<label class="col-lg-12">Email</label>
                <div class="col-lg-12">
                	<input type="email" class="form-control" name="email" value="{{$data['EMAIL']}}"   readonly autocomplete="off">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-6 p-0">
            <label class="col-lg-12">Hak Akses</label>
             <div class="col-lg-12">
                <input type="text" class="form-control" name="idhakakses" value=""   readonly autocomplete="off">
            </div>
        </div>
        <div class="col-lg-6 p-0">
        	<label class="col-lg-12">Jabatan</label>
             <div class="col-lg-12">
                <input type="text" class="form-control" name="jabatan" value=""   readonly autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group row">
    	<label class="col-lg-12">Status</label>
            <div class="col-lg-12">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio1" value="1" name="status" readonly {{ ($data['STATUS'] == '1') ? 'checked' : 'checked'}}>
                <label for="inlineRadio1"> Active </label>
                  &nbsp;&nbsp;
                <input type="radio" id="inlineRadio2" value="0" name="status" readonly {{ ($data['STATUS'] == 0) ? 'checked' : '' }}>
                <label for="inlineRadio2"> No Active </label>
            </div>
        </div>
    </div>
     <button style="display: none;" id="btn_submit"></button>
</form>

<script type="text/javascript">
    $(".select2").select2({
        theme: 'bootstrap4',
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