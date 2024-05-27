<form action="{{ url('/project/submitproject') }}" method="POST" id="form_project">
    @csrf
   <!-- Field Project Name -->
   <div class="form-group row">
       <label class="col-lg-12">Project Summary</label>
       <div class="col-lg-12">
          <input type="text" class="form-control" name="title" value="{{($id) ? $data['szProjectName']:''}}" required {{ ($action == 'edit') ? 'readonly' : '' }} autocomplete="off">
          <!-- <input type="hidden" class="form-control" name="idoperator" value="{{$id}}" > -->
          <input type="hidden" class="form-control" name="projectid" value="{{($id) ? $id:''}}" >
       </div>
   </div>

   <!-- Field Link Jira -->
   <div class="form-group row">
       <label class="col-lg-12">Link Jira Project</label>
       <div class="col-lg-12">
          <input type="text" class="form-control" name="jira" value="{{($id) ? $data['szJiraLink']:''}}" required autocomplete="off">
       </div>
   </div>

   <!-- Field Judul BRD -->
   <div class="form-group row">
       <label class="col-lg-12">BRD Tittle Page</label>
       <div class="col-lg-12">
          <input type="text" class="form-control" name="brdtittle" value="{{($id) ? $data['szBRDTittle']:''}}" required autocomplete="off">
       </div>
   </div>
   <!-- Field Judul Dev -->
   <div class="form-group row">
       <label class="col-lg-12">Development Tittle Page</label>
       <div class="col-lg-12">
          <input type="text" class="form-control" name="devtittle" value="{{($id) ? $data['szDevTittle']:''}}" required autocomplete="off">
       </div>
   </div>

   <div class="form-group row">
    <div class="col-lg-6 ">
        <!-- Option Role Name -->
        <div class="form-group row">
            <label class="col-lg-12">Description Project (Based BRD Docs)</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="description"
                    value="{{ $id ? $data['szDescription'] : '' }}" required autocomplete="off">
            </div>
        </div>
    </div>
    <div class="col-lg-6 ">
        <!-- Option Role Name -->
        <div class="form-group row">
            <label class="col-lg-12">Jira Id</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="jirakey"
                    value="{{ $id ? $data['szJiraCode'] : '' }}" required autocomplete="off">
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-6 ">
        <!-- Option Team  Name -->
        <div class="form-group row">
            <label class="col-lg-12">Root Confluence Docs</label>
            <div class="col-lg-12">
                @if ($action == 'task')
                    <input type="text" class="form-control" name="ancestors"
                        value="{{ $id ? $data['szAncestorsId'] : '' }}" required autocomplete="off">
                    <!-- <input type="text" class="form-control" name="username" value="{{ var_dump($role) }}" required autocomplete="off">             -->
                @else
                    <select class="select2 " name="ancestors" required>
                        <option value="">-- Select Parent --</option>

                        @if ($id)
                            @foreach ($root as $row)
                                <option value="{{ $parent['szParentConfluenceId'] }}"
                                    {{ strtolower($row['szParentId']) == strtolower($parent['szParentConfluenceId']) ? 'selected' : '' }}>
                                    {{ $row['szParentName'] }}</option>
                            @endforeach
                        @else
                            @foreach ($root as $row)
                                <option value="{{ $row['szParentId'] }}">{{ $row['szParentName'] }}</option>
                            @endforeach
                        @endif

                    </select>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 ">
        <!-- Radio Button Status -->
        <div class="form-group row">
            <label class="col-lg-12">Status Project</label>
            <div class="col-lg-12">
                @if ($action == 'task')
                    <input type="text" class="form-control" name="status" value="{{ $data['szConfigValue'] }}"
                        readonly required autocomplete="off">
                    <!-- <input type="text" class="form-control" name="username" value="{{ var_dump($role) }}" required autocomplete="off">             -->
                @else
                    <select class="select2 " name="status" required>
                        <option value="">-- Select Parent --</option>
                        @if ($id)
                            @foreach ($status as $row)
                                <option value="{{ $row['shItemNumber'] }}"
                                    {{ strtolower($data['szStatusProjectId']) == strtolower($row['shItemNumber']) ? 'selected' : '' }}>
                                    {{ $row['szConfigValue'] }}</option>
                            @endforeach
                        @else
                            @foreach ($status as $row)
                                <option value="{{ $row['shItemNumber'] }}">{{ $row['szConfigValue'] }}</option>
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
       <!-- Field Struktural -->
           <div class="form-group row">
               <label class="col-lg-12">Application</label>
               <div class="col-lg-12">
                   @if($action == 'detail')
                       <input type="text" class="form-control" name="application" value="{{($id) ? $data['szApplicationId']:''}}" required autocomplete="off">
                   @else
                       <select class="select2 " name="application" required>
                           <option value="">-- Select Role --</option>
                           @if($id)
                               @foreach($application as $row)
                                   <option value="{{ $row['szApplicationId']}}" {{ ( strtolower($data['szApplicationId']) == strtolower($row['szApplicationId']) ) ? 'selected' : '' }}>{{$row['szApplicationName'] }}</option>
                               @endforeach
                           @else
                               @foreach($application as $row)
                                   <option value="{{ $row['szApplicationId']}}">{{$row['szApplicationName'] }}</option>
                               @endforeach
                           @endif
                       </select>
                   @endif
               </div>
           </div>
       </div>
   </div>

   <div class="form-group row">
   </div>
    <button style="display: none;" id="btn_submit"></button>
</form>

<script type="text/javascript">
   $(function(){
       @if($action == 'task' || $action == 'documents')
           $("#form_project .form-control").attr('disabled', 'disabled');
       @endif
   });

   $(".select2").select2({
       theme: 'bootstrap4',
       dropdownParent:'#form_project'
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
               $('#form_project').modal('toggle');
               l.ladda('stop');
           },12000)

       });

   function form_submit(){
       var form = $('#form_project');
       var validation = input_validator('form_project');
       if(validation.fail == false){
            $('#btn_submit').click();
       }
   }

</script>
