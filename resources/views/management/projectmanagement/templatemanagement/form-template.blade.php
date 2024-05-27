<form action="{{ url('/document/post-template') }}" method="POST" id="form_project">
    @csrf
    <!-- Field Project Name -->
    <div class="form-group row">
        <label class="col-lg-12">Template Tittle</label>
        <div class="col-lg-12">
            <input type="text" class="form-control" name="title" value="{{ $id ? $data['szTitle'] : '' }}"
                {{ strtolower($action) == 'update' ? 'readonly' : '' }} required autocomplete="off">
            <!-- <input type="hidden" class="form-control" name="idoperator" value="{{ $id }}" > -->
            <input type="hidden" class="form-control" name="templateid" value="{{ $id ? $id : '' }}">
            <input type="hidden" class="form-control" name="action" value="{{ $action ? $action : '' }}">

        </div>
    </div>

    <!-- Field Link Jira -->
    <div class="form-group row">
        <label class="col-lg-12">Root Page</label>
        <div class="col-lg-12">
            @if (strtolower($action) == 'edit')
                @if ($data['szCategory'] == 'RootPage')
                    <input type="text" class="form-control" name="rootPage"
                        value="{{ $id ? $data['szRootPage'] : '' }}"
                        {{ $data['szCategory'] == 'RootPage' ? 'readonly' : '' }} autocomplete="off">
                @else
                    <select class="select2 " name="szRootPage" required>
                        <option value="">-- Select Parent --</option>
                        @if ($id)
                            @foreach ($rootPage as $row)
                                <option value="{{ $data['szRootPage'] }}"
                                    {{ strtolower($row['szTemplateId']) == strtolower($data['szRootPage']) ? 'selected' : '' }}>
                                    {{ $row['szTitle'] }}</option>
                            @endforeach
                        @else
                            @foreach ($rootPage as $row)
                                <option value="{{ $row['szTemplateId'] }}">{{ $row['szTitle'] }}</option>
                            @endforeach
                        @endif
                    </select>
                @endif
            @else
                @if($data['szCategory'] == 'RootPage')
                        <input type="text" class="form-control" name="szRootPage" value=""
                        {{ strtolower($action) == 'update' ? 'readonly' : '' }} autocomplete="off">
                @endif
                @foreach ($rootPage as $row)
                    @if ($row['szTemplateId'] == $data['szRootPage'])
                        <input type="text" class="form-control" name="szRootPage" value="{{ $row['szTitle'] }}"
                            {{ strtolower($action) == 'update' ? 'readonly' : '' }} autocomplete="off">
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    <!-- Field Judul BRD -->
    <div class="form-group row">
        <label class="col-lg-12">Category Page</label>
        <div class="col-lg-12">
            <select class="select2 " name="categoryPage" required>
                <option value="">-- Select Parent --</option>
                @if ($id)
                    <option value="RootPage"
                        {{ strtolower($data['szCategory']) == strtolower('rootpage') ? 'selected' : '' }}>RootPage
                    </option>
                    <option value="MainPage"
                        {{ strtolower($data['szCategory']) == strtolower('mainpage') ? 'selected' : '' }}>MainPage
                    </option>
                    <option value="BugPage"
                        {{ strtolower($data['szCategory']) == strtolower('bugpage') ? 'selected' : '' }}>BugPage
                    </option>
                    <option value="SubPage"
                        {{ strtolower($data['szCategory']) == strtolower('subpage') ? 'selected' : '' }}>SubPage
                    </option>
                    <option value="ChildPage"
                        {{ strtolower($data['szCategory']) == strtolower('childpage') ? 'selected' : '' }}>ChildPage
                    </option>
                    <option value="SubChildPage"
                        {{ strtolower($data['szCategory']) == strtolower('subchildpage') ? 'selected' : '' }}>
                        SubChildPage</option>
                @else
                    <option value="RootPage">RootPage</option>
                    <option value="MainPage">MainPage</option>
                    <option value="BugPage">BugPage</option>
                    <option value="SubPage">SubPage</option>
                    <option value="ChildPage">ChildPage</option>
                    <option value="SubChildPage">SubChildPage</option>
                @endif
            </select>
        </div>
    </div>
    <!-- Field Judul Dev -->
    <div class="form-group row">
        <label class="col-lg-12">Status Template</label>
        <div class="col-lg-12">
            <select class="select2 " name="statusPage" required>
                <option value="">-- Select Parent --</option>
                @if ($id)
                    <option value="{{ $data['szStatus'] }}"
                        {{ strtolower($data['szStatus']) == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="{{ $data['szStatus'] }}"
                        {{ strtolower($data['szStatus']) == 1 ? 'selected' : '' }}>Active</option>
                @else
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-12">Template Page Name Confluence</label>
        <div class="col-lg-12">
            <input type="text" class="form-control" name="templateName"
                value="{{ $id ? $data['szTemplateName'] : '' }}" {{ strtolower($action) == 'edit' ? 'readonly' : '' }}
                {{strtolower($action) == 'update' ? 'required' : ''}} autocomplete="off">
        </div>
    </div>

    </div>

    <div class="form-group row">
    </div>
    <button style="display: none;" id="btn_submit"></button>
</form>

<script type="text/javascript">
    $(function() {

    });

    $(".select2").select2({
        theme: 'bootstrap4',
        dropdownParent: '#form_project'
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
            $('#form_project').modal('toggle');
            l.ladda('stop');
        }, 12000)

    });

    function form_submit() {
        var form = $('#form_project');
        var validation = input_validator('form_project');
        if (validation.fail == false) {
            $('#btn_submit').click();
        }
    }
</script>
