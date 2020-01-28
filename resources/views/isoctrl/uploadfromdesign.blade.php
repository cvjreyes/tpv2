@if (Auth::guest())

@else
    
    <div class="modal fade" id="uploadfromdesignModal" style="top:20%"; 
     tabindex="-1" role="dialog" 
     aria-labelledby="uploadfromdesignModalLabel">
   <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
       
                @if(count($errors) >0 )
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="panel-body">


                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>


        
                   <form style="background-color: #F5F8FA" method="POST" action="{{route('subir')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                      {{ csrf_field() }}

                    {!! Form::text('pathfrom', null, array('class' => 'pathfrom','style' => 'display:none','readonly')) !!}

                    {!! Form::text('requestbydesign', null, array('class' => 'requestbydesign','style' => 'display:none','readonly')) !!}
                    {!! Form::text('requestbylead', null, array('class' => 'requestbylead','style' => 'display:none','readonly')) !!}

                      <br><center><label for="archivo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::text('filename', null, array('placeholder' => 'filename','class' => 'filename','style' => 'border:2px;width: 100%;font-size: 18px;font-weight: bold;background: #F5F8FA;border:0px;','readonly')) !!}</label></center><br>

                      

                      <center>
                         <table>

                         <tr> 
                          <td><a class="btn btn-xs btn-primary"><b>PDF</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td><input border="0" type="file" accept="application/pdf" style="width: 130%" class="btn btn-sm btn-default" name="archivo"></td>
                         </tr>

                       </table>
                       <br>
                       Attachments
                       <br>
                       <table>
                         <tr> 
                          <center><td><a class="btn btn-xs btn-default"><b>PDF</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></center>
                          <td><input border="0" type="file" accept="application/pdf" style="width: 130%" class="btn btn-sm btn-default" name="pdf"></td>
                         </tr>
                         <tr> 
                          <td><a class="btn btn-xs btn-default"><b>DXF</b></a></td>
                          <td><input border="0" type="file" accept=".dxf" style="width: 130%" class="btn btn-sm btn-default" name="dxf"></td>
                         </tr>
                         <tr> 
                          <td><a class="btn btn-xs btn-default"><b>BFL</b></a></td>
                          <td><input border="0" type="file" accept=".bfile" style="width: 130%" class="btn btn-sm btn-default" name="bfl"></td>
                         </tr>
                         <tr> 
                          <td><a class="btn btn-xs btn-default"><b>CII</b></a></td>
                          <td><input border="0" type="file" accept=".cii" style="width: 130%" class="btn btn-sm btn-default" name="cii"></td>
                         </tr>

                        </table>
                      <br>
                      <div style="background: #FFFF34;border-radius: 6px;">
                        <font size="3" style="font-weight: bold;background: #FFFF34" color="black">***WARNING!*** This action will replace the current(s) file(s). Take appropriate precautions.</font><br>
                        <font size="2" style="background: #FFFF34" color="black">If you are not sure of this action, click cancel and contact your supervisor.</font>
                      </div>
                      <br><br>
                       <input type="submit" class="btn btn-lg btn-info" style="padding: 8px 16px;font-size: 12px;" value="Upload">
                       <input type="submit" class="btn btn-lg btn-default" data-dismiss="modal" style="padding: 8px 16px;font-size: 12px;" value="Cancel">
                    </center>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

    {!! Form::close() !!}

@endif