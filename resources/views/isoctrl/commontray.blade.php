@if (Auth::guest())

@else

@extends('layouts.datatable')

@section('content')

<style type="text/css">
    

.dgcAlert {top: 0;position: absolute;width: 100%;display: block;height: 1000px; background: url(http://www.dgcmedia.es/recursosExternos/fondoAlert.png) repeat; text-align:center; opacity:0; display:none; z-index:999999999999999;}
.dgcAlert .dgcVentana{width: 500px; background: white;min-height: 150px;position: relative;margin: 0 auto;color: black;padding: 10px;border-radius: 10px;}
.dgcAlert .dgcVentana .dgcCerrar {height: 25px;width: 25px;float: right; cursor:pointer; background: url(http://www.dgcmedia.es/recursosExternos/cerrarAlert.jpg) no-repeat center center;}
.dgcAlert .dgcVentana .dgcMensaje { margin: 0 auto; padding-top: 0px; text-align: center; width: 400px;font-size: 20px;}
.dgcAlert .dgcVentana .dgcAceptar{background:#09C; bottom:20px; display: inline-block; font-size: 12px; font-weight: bold; height: 24px; line-height: 24px; padding-left: 5px; padding-right: 5px;text-align: center; text-transform: uppercase; width: 75px;cursor: pointer; color:#FFF; margin-top:25px;}

</style>
<script type="text/javascript">
    
function alertDGC(mensaje)
    {
    var dgcTiempo=500
    var ventanaCS='<div class="dgcAlert"><div class="dgcVentana"><div class="dgcCerrar"></div><div class="dgcMensaje">'+mensaje+'<br><div class="dgcAceptar">CLOSE</div></div></div></div>';
    $('body').append(ventanaCS);
    var alVentana=$('.dgcVentana').height();
    var alNav=$(window).height();
    var supNav=0//$(window).scrollTop();
    $('.dgcAlert').css('height',$(document).height());
    $('.dgcVentana').css('top',(30)+'%');
    //$('.dgcVentana').css('top',((alNav-alVentana)/2+supNav-100)+'px');
    $('.dgcAlert').css('display','block');
    $('.dgcAlert').animate({opacity:1},dgcTiempo);
     $('.dgcCerrar,.dgcAceptar').click(function(e) {
         $('.dgcAlert').animate({opacity:0},dgcTiempo);
         setTimeout("$('.dgcAlert').remove()",dgcTiempo);
     });
        }
        window.alert = function (message) {
          alertDGC(message);
        };


</script>

<!doctype html>
<script type="text/javascript">
  
  $(document).on('click', '.comments-design-modal', function() {

            $('.filename').val($(this).data('filename'));
            $('.pathfrom').val($(this).data('pathfrom'));
            $('.requestbydesign').val($(this).data('requestbydesign'));
            $('.requestbylead').val($(this).data('requestbylead'));

        });

   $(document).on('click', '.comments-design-to-supports-modal', function() {

            $('.filename').val($(this).data('filename'));
            $('.pathfrom').val($(this).data('pathfrom'));
            $('.requestbydesign').val($(this).data('requestbydesign'));
            $('.requestbylead').val($(this).data('requestbylead'));

        });

    $(document).on('click', '.comments-design-to-materials-modal', function() {

            $('.filename').val($(this).data('filename'));
            $('.pathfrom').val($(this).data('pathfrom'));
            $('.requestbydesign').val($(this).data('requestbydesign'));
            $('.requestbylead').val($(this).data('requestbylead'));

        });

    $(document).on('click', '.comments-design-to-iso-modal', function() {

            $('.filename').val($(this).data('filename'));
            $('.pathfrom').val($(this).data('pathfrom'));
            $('.requestbydesign').val($(this).data('requestbydesign'));
            $('.requestbylead').val($(this).data('requestbylead'));

        });

    

  $(document).on('click', '.upload-tie-modal', function() {

            $('.tie').val($(this).data('tie'));
            $('.filename').val($(this).data('filename'));
            $('.pathfrom').val($(this).data('pathfrom'));
            $('.requestbydesign').val($(this).data('requestbydesign'));
            $('.requestbylead').val($(this).data('requestbylead'));
            $('.tray').val($(this).data('tray'));


        });
</script>

<html>
<head>
<title>TIE/SPO/SIT Tray</title>

</head>
<body>

<div class="container">
  <div class="row">
    <!-- <h4>Agregar Nueva Descarga</h4> -->
    <hr style="margin-top:5px;margin-bottom: 5px;">
    <center><h2 style="padding-top: 4%"><b>Iso Controller</b></h2>
      <h3>TIE/SPO/SIT Tray</h3></center>
      <div class="panel-body">
    <form id="frm-example" class="form-horizontal" role="form" method="POST" action="{{ url('/sendfromdesignbulk') }}">    
       {!! csrf_field() !!}
      <table style='width: 100%'> 
        <td>      
        <button onclick="location.href='{{ url('isostatus') }}'" type="button" class="btn btn-info btn-lg" style="width:30%"><b>Status</b>
        </button>
         <button onclick="location.href='{{ url('hisoctrl') }}'" type="button" class="btn btn-info btn-lg" style="width:30%"><b>History</b>
        </button>
        <?php if (auth()->user()->hasRole('DesignAdmin')){ ?> 
        <button onclick="location.href='{{ url('file') }}'" type="button" class="btn btn-info btn-lg" style="width:30%"><b>Upload Isofiles</b>
        </button><?php }?>
      </td>
      <td>
        <!-- TABLA DE TOTALES SEGUN STATUS -->
            <?php 

                              $isostatus = DB::select("SELECT isostatus.name as status, COUNT(*) as count FROM disoctrls JOIN isostatus
                                                            WHERE disoctrls.isostatus_id=isostatus.id
                                                            GROUP BY isostatus.id ORDER BY isostatus.pos");

                                                                  $status = $isostatus[0]->status;
                                                                  $count = $isostatus[0]->count;
                  echo "<table border style='width: 100%'>";
                    echo "<tr>";
                      
                          echo "<td style='text-align: center;width: 14.28%;font-size:14px;font-weight:bold'>New</td>";
                          echo "<td style='text-align: center;width: 14.28%;font-size:14px;font-weight:bold'>Design</td>";
                          echo "<td style='text-align: center;width: 14.28%;font-size:14px;font-weight:bold'>Stress</td>";
                          echo "<td style='text-align: center;width: 14.28%;font-size:14px;font-weight:bold'>Supports</td>";
                          echo "<td style='text-align: center;width: 14.28%;font-size:14px;font-weight:bold'>Materials</td>";
                          echo "<td style='text-align: center;width: 14.28%;font-size:14px;font-weight:bold'>To Issue</td>";
                          echo "<td style='text-align: center;width: 14.28%;font-size:14px;font-weight:bold'>Issued</td>";

                    echo "</tr>";
                    echo "<tr>";
            
                        echo "<td style='font-size:14px;font-weight:bold;text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[0]->count."</td>";
                        echo "<td style='font-size:14px;font-weight:bold;text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[1]->count."</td>";
                        echo "<td style='font-size:14px;font-weight:bold;text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[2]->count."</td>";
                        echo "<td style='font-size:14px;font-weight:bold;text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[3]->count."</td>";
                        echo "<td style='font-size:14px;font-weight:bold;text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[4]->count."</td>";
                        echo "<td style='font-size:14px;font-weight:bold;text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[5]->count."</td>";
                        echo "<td style='font-size:14px;font-weight:bold;text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[6]->count."</td>";
                      
                    echo "</tr>";  
                  echo "</table>";

                    ?>
      </td>
       </table>


      
      <table class="table">

      <!-- DATATABLE-->

      <link href="{!! asset('css/jquery.dataTables.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
      <script type="text/javascript" src="{!! asset('js/jquery.dataTables.min.js') !!}"></script>

      <table border id="tabla" class="table table-hover table-condensed" style="width: 100%;font-size: 14px;font-weight: normal;white-space: nowrap">

        
         <script type="text/javascript">
    
function vcomments(val)
    {

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        // Esta es la variable que vamos a pasar
 
        var miVariableJS= val;
        // Enviamos la variable de javascript a archivo.php
        $.post("jsvcomments",{"texto":miVariableJS},function(respuesta){
            alert(respuesta);

        });


    }

$(document).on('click', '.show-vcomments-modal', function() {
         
         

            $('.id').val($(this).data('id'));


            $('.filename').val($(this).data('filename'));
            $('.comments').val($(this).data('comments'));

        });

</script>

    <center><thead>
        <tr>
            <th style="text-align: center"><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>          
            <th style="text-align: center">Iso ID</th>
            <th style="text-align: center">Check by</th>
            <th style="text-align: center">Date</th>
            <th style="text-align: center">Actions</th>
        </tr>
    </thead></center>
    <tfoot><tr>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
        </tr></tfoot>
  
    <!-- Buttons for export -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet">

     

      <tbody>
            <?php


            foreach ($filenames as $key => $filename) {
  
            ?>

   
    <tr>

        <td><?php echo $filename; ?></td>

        

        <td><?php 

        $afilename=explode(".", $filename);

        $pdfcl= "../public/storage/isoctrl/design/attach/".$afilename[0]."-CL.pdf";
        $bfile= "../public/storage/isoctrl/design/attach/".$afilename[0].".bfile";
        $dxf= "../public/storage/isoctrl/design/attach/".$afilename[0].".dxf";
        $cii= "../public/storage/isoctrl/design/attach/".$afilename[0].".cii";

        $pdftie= "../public/storage/isoctrl/design/attach/".$afilename[0]."-TIE.pdf";
        $pdfspo= "../public/storage/isoctrl/design/attach/".$afilename[0]."-SPO.pdf";
        $pdfsit= "../public/storage/isoctrl/design/attach/".$afilename[0]."-SIT.pdf";

           $issued = DB::select("SELECT * FROM hisoctrls WHERE id=(SELECT max(id) FROM hisoctrls WHERE  filename LIKE '%".$afilename[0]."%')");

           $requested = DB::select("SELECT * FROM hisoctrls WHERE id=(SELECT max(id) FROM hisoctrls WHERE  filename LIKE '%".$afilename[0]."%')"); // same query for request

            if ($issued[0]->requested==1 OR $issued[0]->requested==2){ ?> <!-- solicitud diseño -->

              <a class="btn btn-xs btn-warning"><b>RBD</b></a>
          
            <?php } ?>

            <?php if ($issued[0]->requestedlead==1 OR $issued[0]->requestedlead==2){ ?> <!-- solicitud lead -->

              <a class="btn btn-xs btn-warning"><b>RBL</b></a>
          
            <?php } ?>


         <?php echo "<a target='_blank' href='../public/storage/isoctrl/".$filename."'>".$filename."</a>"; ?></td>

         <td>
          <center>
           
            <?php if ($requested[0]->tie==1){ ?>  <!--TIE  -->

                 <a class="upload-tie-modal btn btn-xs btn-warning" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromtieModal"><b>TIE</b></a>
           
            <?php }elseif($requested[0]->tie==2){ ?>  
            
                <a class="upload-tie-modal btn btn-xs btn-primary" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromtieModal"><b>TIE</b></a>

            <?php }elseif($requested[0]->tie==3){ ?>  
            
                <a class="upload-tie-modal btn btn-xs btn-danger" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromtieModal"><b>TIE</b></a>

            <?php }else{ ?>
         
                  <a class="btn btn-xs btn-default" data-filename ="<?php echo $filename; ?>" data-request = "1"><b>TIE</b></a>
                  {!! Form::text('tie', 0, array('style' => 'display:none')) !!}

            <?php } ?>

            <?php if ($requested[0]->spo==1){ ?>  <!--SPO  -->

                 <a class="upload-spo-modal btn btn-xs btn-warning" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromspoModal"><b>SPO</b></a>
           
            <?php }elseif($requested[0]->spo==2){ ?>  
            
                <a class="upload-spo-modal btn btn-xs btn-primary" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromspoModal"><b>SPO</b></a>

            <?php }elseif($requested[0]->spo==3){ ?>  
            
                <a class="upload-spo-modal btn btn-xs btn-danger" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromspoModal"><b>SPO</b></a>

            <?php }else{ ?>
         
                  <a class="btn btn-xs btn-default" data-filename ="<?php echo $filename; ?>" data-request = "1"><b>SPO</b></a>
                  {!! Form::text('spo', 0, array('style' => 'display:none')) !!}

            <?php } ?>

            <?php if ($requested[0]->sit==1){ ?>  <!--SIT  -->

                 <a class="upload-sit-modal btn btn-xs btn-warning" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromsitModal"><b>SIT</b></a>
           
            <?php }elseif($requested[0]->sit==2){ ?>  
            
                <a class="upload-sit-modal btn btn-xs btn-primary" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromsitModal"><b>SIT</b></a>

            <?php }elseif($requested[0]->sit==3){ ?>  
            
                <a class="upload-sit-modal btn btn-xs btn-danger" data-filename ="<?php echo $filename; ?>" data-tray="<?php echo $trays[$key]; ?>" data-toggle="modal" data-target="#uploadfromsitModal"><b>SIT</b></a>

            <?php }else{ ?>
         
                  <a class="btn btn-xs btn-default" data-filename ="<?php echo $filename; ?>" data-request = "1"><b>SIT</b></a>
                  {!! Form::text('sit', 0, array('style' => 'display:none')) !!}

            <?php } ?>

          </center>
        </td> 


      <?php if ($issued[0]->issued==2){ ?>
      
          <td><?php echo ""; ?></td>
          <td><?php echo ""; ?></td> <!-- Se utiliza la variable $issued solo para aprovechar -->    

      <?php }else{ ?>

      <td><?php echo $issued[0]->created_at; ?></td> <!-- Se utiliza la variable $issued solo para aprovechar -->
      
      <?php } ?>

      <td>


        <?php if (auth()->user()->hasRole('DesignAdmin')){ ?> 

          <?php if ($issued[0]->issued==0 OR $issued[0]->issued==2){ ?>

<!--             <a class="comments-design-modal btn btn-xs btn-success" data-filename ="<?php echo $filename; ?>" data-requestbydesign ="<?php echo $requested[0]->requested; ?>" data-requestbylead ="<?php echo $requested[0]->requestedlead; ?>" data-toggle="modal" data-target="#commentsfromdesignModal">Send to Stress</a>
            <a class="comments-design-to-supports-modal btn btn-xs btn-primary" data-filename ="<?php echo $filename; ?>" data-requestbydesign ="<?php echo $requested[0]->requested; ?>" data-requestbylead ="<?php echo $requested[0]->requestedlead; ?>" data-toggle="modal" data-target="#commentsfromdesigntosupportsModal">Send to Supports</a>
             <a class="comments-design-to-materials-modal btn btn-xs btn-danger" data-filename ="<?php echo $filename; ?>" data-requestbydesign ="<?php echo $requested[0]->requested; ?>" data-requestbylead ="<?php echo $requested[0]->requestedlead; ?>" data-toggle="modal" data-target="#commentsfromdesigntomaterialsModal">Send to Materials</a>
            <a class="upload-design-modal btn btn-xs btn-info" data-filename ="<?php echo $filename; ?>" data-pathfrom="design" data-requestbydesign ="<?php echo $requested[0]->requested; ?>" data-requestbylead ="<?php echo $requested[0]->requestedlead; ?>" data-toggle="modal" data-target="#uploadfromdesignModal">Upload File</a> -->
            &nbsp;&nbsp;<a onclick="vcomments(<?php echo $issued[0]->id; ?>)" ><img src="{{ asset('images/comment-icon.png') }}" class="mark-icon" style="width:20px;height:20px"></a>&nbsp;&nbsp;

          <?php if (file_exists($pdfcl)) { ?>  

             <?php echo "<a target='_blank' class='btn btn-xs btn-default' href='../public/storage/isoctrl/attach/".$afilename[0]."-CL.pdf'>". "<b>PDF</b>"."</a>"; ?>
             
          <?php } ?>

          <?php if (file_exists($bfile)) { ?>  

             <?php echo "<a class='btn btn-xs btn-default' href='../public/storage/isoctrl/attach/".$afilename[0].".bfile' download>". "<b>BFL</b>"."</a>"; ?>
             
          <?php } ?>

          <?php if (file_exists($dxf)) { ?>  

             <?php echo "<a class='btn btn-xs btn-default' href='../public/storage/isoctrl/attach/".$afilename[0].".dxf' download>". "<b>DXF</b>"."</a>"; ?>
             
          <?php } ?>

          <?php if (file_exists($cii)) { ?>  

             <?php echo "<a class='btn btn-xs btn-default' href='../public/storage/isoctrl/attach/".$afilename[0].".cii' download>". "<b>CII</b>"."</a>"; ?>

          <?php } ?>   

          <?php if (file_exists($pdftie)) { ?>  

             <?php echo "<a target='_blank' class='btn btn-xs btn-default' href='../public/storage/isoctrl/attach/".$afilename[0]."-TIE.pdf'>". "<b>TIE</b>"."</a>"; ?>
             
          <?php } ?>

          <?php if (file_exists($pdfspo)) { ?>  

             <?php echo "<a target='_blank' class='btn btn-xs btn-default' href='../public/storage/isoctrl/attach/".$afilename[0]."-SPO.pdf'>". "<b>SPO</b>"."</a>"; ?>
             
          <?php } ?>

          <?php if (file_exists($pdfsit)) { ?>  

             <?php echo "<a target='_blank' class='btn btn-xs btn-default' href='../public/storage/isoctrl/attach/".$afilename[0]."-SIT.pdf'>". "<b>SIT</b>"."</a>"; ?>
             
          <?php } ?>

          <?php }else{ ?>

            <a class="comments-design-to-iso-modal btn btn-xs btn-success" data-filename ="<?php echo $filename; ?>" data-toggle="modal" data-target="#commentsfromdesigntoisoModal">To Issue</a>
            <a class="upload-design-modal btn btn-xs btn-info" data-filename ="<?php echo $filename; ?>" data-pathfrom="design" data-requestbydesign ="<?php echo $requested[0]->requested; ?>" data-requestbylead ="<?php echo $requested[0]->requestedlead; ?>" data-toggle="modal" data-target="#uploadfromdesignModal">Upload File</a>

          <?php } ?>  
        
        <?php }else{ ?>
        
          <a class="comments-design-modal btn btn-xs btn-info" data-filename ="<?php echo $filename; ?>" data-toggle="modal" data-target=""><b>NO ACTIONS AVAILABLE!</b></a>
 
        <?php } ?>
        
      </td>
      </tr>

       <?php } ?> 

      

          </tbody>


    </table>

          


     <!-- BUTTONS FOR SELECT ALL  --> 
     <?php if (auth()->user()->hasRole('DesignAdmin')){ ?>   
      <center><b>Click an action for selected IsoFiles:</b>

      <button class="btn btn-sm btn-success" name="destination" value="stress">Send to Stress</button>
      <button class="btn btn-sm btn-primary" name="destination" value="supports">Send to Supports</button>
      <button class="btn btn-sm btn-danger" name="destination" value="materials">Send to Materials</button>
      <br><br>
      {{ Form::textarea('comments', null, ['placeholder' => 'Comments', 'class' => 'comments' , 'cols' => 100, 'rows' =>2,'required' => '', 'maxlength' => "400"]) }} 

        </center>
      <?php } ?>
<!-- 
      <b>Data submitted to the server:</b><br>
      <pre id="example-console">

      </pre>
      </form> -->

    <script type="text/javascript">
    
    setTimeout(function() {
    $('#messages').fadeOut('slow');
    }, 50000);

</script>

    <!-- BUTTONS   -->
    <br>
   <center>
       


        <button onclick="location.href='{{ url('design') }}'" type="button" class="btn btn-primary btn-lg" style="width:15%"><b>Design</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('stress') }}'" type="button" class="btn btn-default btn-lg" style="width:15%"><b>Stress</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('supports') }}'" type="button" class="btn btn-default btn-lg" style="width:15%"><b>Supports</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('materials') }}'" type="button" class="btn btn-default btn-lg" style="width:15%"><b>Materials</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('lead') }}'" type="button" class="btn btn-default btn-lg" style="width:15%"><b>LDG/Isochecker</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('iso') }}'" type="button" class="btn btn-default btn-lg" style="width:15%"><b>LDE/Isocontrol</b></button>


    </center> 


    @extends('isoctrl.uploadfromtie')

<script src="{{ asset('js/selectall.js') }}"></script> <!-- select all -->

<script type="text/javascript">
    
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    //$('#tabla').DataTable({"order": [[ 3, 'desc' ]],"pageLength" : 8});
    $('#tabla tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" style="width: 100%;font-size: 12px;font-weight: normal;white-space: nowrap" placeholder="Search '+title+'" />' );
    } );


    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );

</script>



</table>
</div>
<!-- SELECT ALL -->


<!-- Fin tabla--> 
  </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</body>
</html>
@endsection

@endif