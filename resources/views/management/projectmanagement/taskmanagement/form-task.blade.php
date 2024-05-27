<form action="{{ url('setting/user-management/form-submit') }}" method="POST" id="form_task">
    @csrf
    <div class="form-group row">
        <label class="col-lg-12">Task Name</label>
        <div class="col-lg-12">
            <input type="text" class="form-control" name="username" value="{{ $id ? $data['szItem'] : '' }}"
                {{ $id ? 'readonly' : '' }} required autocomplete="off">
        </div>
    </div>
    <div class="form-group row">
    </div>
    <div class="form-group row">
        <div class="col-lg-6 ">
            <div class="form-group row">
                <label class="col-lg-12">Link Task</label>
                <div class="col-lg-12">
                    <input type="text" class="form-control" name="nama" value="{{ $id ? $data['szLink'] : '' }}"
                        {{ $action == 'detail' ? 'readonly' : '' }} autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="form-group row">
                <label class="col-lg-12">Plan Date</label>
                <div class="col-lg-12">
                    <input type="date" class="form-control text-center datepicker" name="email"
                        value="{{ $id ? $data['dtmPlan'] : '' }}"  autocomplete="off">
                    <input type="hidden" class="form-control" name="idproject" value="{{ $id }}">
                    <input type="hidden" class="form-control" name="numbertask" value="{{ $data['shItemNumber']  }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-6 p-0">
            <label class="col-lg-12">Actual Date</label>
            <div class="col-lg-12">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" class="form-control text-center datepicker" name="nama" value="{{ $id ? $data['dtmProcess'] : '' }}"
                    {{ $action == 'detail' ? 'readonly' : '' }} autocomplete="off">
            </div>
                </div>

        </div>
    <button style="display: none;" id="btn_submit"></button>
</form>

<script type="text/javascript">
    $(function() {
        @if ($action == 'detail')
            $("#form_task .form-control").attr('disabled', 'disabled');
        @endif
    });

    $(".select2").select2({
        theme: 'bootstrap4',
        dropdownParent: '#form_user'
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
            $('#form_task').modal('toggle');
            l.ladda('stop');
        }, 12000)

    });

    function form_submit() {
        var form = $('#form_task');
        var validation = input_validator('form_task');
        if (validation.fail == false) {
            $('#btn_submit').click();
        }
    }
</script>
