@if (Auth::guest())

@else

@role('Isoctrl')

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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>




  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<script type="text/javascript">

    function initGui()
    {
        $('.date-iso8601').datepicker();
    }
   

    $(function () {
        $('.add').click(function () {


            var n = ($('.resultbody tr').length - 0) + 1;
            var tr = '<tr class="fila">' +
                    '<td>{!! Form::text('code[]', null, array('placeholder' => 'Code','class' => 'form-control','required')) !!}</td>'+
                    '<td>{!! Form::text('name[]', null, array('placeholder' => 'Name','class' => 'form-control','required')) !!}</td>'+
                    '<td>{!! Form::number('hours[]', null, array('placeholder' => 'Hours','class' => 'form-control','required')) !!}</td>'+
                    '<td><input type="button" class="btn btn-danger delete" value="x"></td></tr>';
            $('.resultbody').append(tr);


              var newRow = tr.clone();

        });

        $('.resultbody').delegate('.delete', 'click', function () {
            $(this).parent().parent().remove();
        });

        $('.resultbody').delegate('.obtainedmarks , .totalmarks', 'keyup', function () {
            var tr = $(this).parent().parent();
            var obtainedmarks = tr.find('.obtainedmarks').val() - 0;
            var totalmarks = tr.find('.totalmarks').val() - 0;

            var percentage = (obtainedmarks / totalmarks) * 100;
            tr.find('.percentage').val(percentage);
        });
    });
            
// SHOW/UPDATE MILESTONES PIPE 
$(document).on('click', '.edit-isostatus-modal', function() {
         

            $('.id').val($(this).data('id'));

            $('.area').val($(this).data('area'));
            $('.week').val($(this).data('week'));
            $('.estimated').val($(this).data('estimated'));
  

        });


</script>


                            <script type="text/javascript">
                                
                                 window.onload = function() {

                                     document.getElementById("s2").style.fontWeight='bold';
                                     document.getElementById("s2").style.fontSize=10 + "pt";
                                     document.getElementById("s2").style.fontStyle="italic";;


                                 }

                            </script> 



<br><br><br><br>
<div class="container">

    <center>

        <h2><b>Iso Controller</b></h2>
        <h3>Status</h3>

        

        
        <br>
    </center>
    <table style='width: 100%'>
        <td>
             <button onclick="location.href='{{ url('isostatus') }}'" type="button" class="btn btn-primary btn-lg" style="width:25%"><b>Status</b>
                </button>
             <button onclick="location.href='{{ url('hisoctrl') }}'" type="button" class="btn btn-info btn-lg" style="width:25%"><b>History</b>
                </button>
                <button onclick="location.href='{{ url('exportisodates') }}'" type="button" class="btn btn-success btn-lg" style="font-weight: bold">Excel</button>
       </td>         
<!-- TABLA DE TOTALES SEGUN STATUS -->
        <td>
            <?php 

                  $isostatus = DB::select("SELECT isostatus.name as status, COUNT(*) as count FROM disoctrls JOIN isostatus
                                                WHERE disoctrls.isostatus_id=isostatus.id
                                                GROUP BY isostatus.id ORDER BY isostatus.pos");

                                                      $status = $isostatus[0]->status;
                                                      $count = $isostatus[0]->count;
                  
                  echo "<table border style='width: 100%'>";
                    echo "<tr>";
                      
                          echo "<td style='text-align: center;width: 14.28%'>New</td>";
                          echo "<td style='text-align: center;width: 14.28%'>Design</td>";
                          echo "<td style='text-align: center;width: 14.28%'>Stress</td>";
                          echo "<td style='text-align: center;width: 14.28%'>Supports</td>";
                          echo "<td style='text-align: center;width: 14.28%'>Materials</td>";
                          echo "<td style='text-align: center;width: 14.28%'>To Issue</td>";
                          echo "<td style='text-align: center;width: 14.28%'>Issued</td>";

                    echo "</tr>";
                    echo "<tr>";
            
                        echo "<td style='text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[0]->count."</td>";
                        echo "<td style='text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[1]->count."</td>";
                        echo "<td style='text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[2]->count."</td>";
                        echo "<td style='text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[3]->count."</td>";
                        echo "<td style='text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[4]->count."</td>";
                        echo "<td style='text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[5]->count."</td>";
                        echo "<td style='text-align: center;background: #FFFFFF';width: 14.28%'>".$isostatus[6]->count."</td>";
                      
                    echo "</tr>";  
                  echo "</table>";

            ?>
        </td>
</table>
 <br>
<link href="{!! asset('css/jquery.dataTables.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{!! asset('js/jquery.dataTables.min.js') !!}"></script>


<table border id="isostatus" class="table table-hover table-condensed" style="width: 100%;font-size: 14px;font-weight: normal;white-space: nowrap">

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
            <th>Status</th>
            <th>Iso ID</th>
            <th>Rev</th>
<!--             <th>Design</th>
            <th>Stress</th>
            <th>Supports</th>
            <th>Materials</th> -->

        </tr>
    </thead></center>
    <tfoot><tr>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
<!--             <th style="text-align: center"></th>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th> -->

        </tr></tfoot>
  </table>
</div>
  
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

<script type="text/javascript">
var action_bt = "Edit / Delete"
$(document).ready(function() {
    oTable = $('#isostatus').DataTable({
        
        "processing": true,
        "serverSide": false,
        "ajax": "{{ route('isoctrl.isostatusindex') }}",
        "order": [[ 1, "asc" ]],
        "pageLength" : 8,
        "columns": [
            {data: 'name', name: 'name'},
            {data: 'filename', name: 'filename'},
            {data: 'revision', name: 'revision'}
            // {data: 'ddesign', name: 'ddesign'},
            // {data: 'instress', name: 'instress'},
            // {data: 'insupports', name: 'insupport'},
            // {data: 'inmaterials', name: 'inmaterials'}


        ]

    });

 
});
</script>




<br>

 <!-- BUTTONS   -->
    <center>
         <button onclick="location.href='{{ url('design') }}'" type="button" class="btn btn-default btn-lg" style="width:8%"><b>Design</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('stress') }}'" type="button" class="btn btn-default btn-lg" style="width:8%"><b>Stress</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('supports') }}'" type="button" class="btn btn-default btn-lg" style="width:8%"><b>Supports</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('materials') }}'" type="button" class="btn btn-default btn-lg" style="width:8%"><b>Materials</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('lead') }}'" type="button" class="btn btn-default btn-lg" style="width:8%"><b>Lead</b></button>&nbsp;&nbsp;

        <button onclick="location.href='{{ url('iso') }}'" type="button" class="btn btn-default btn-lg" style="width:8%"><b>IsoController</b></button>
    </center>











<script type="text/javascript">
    
    setTimeout(function() {
    $('#messages').fadeOut('slow');
}, 10000);

</script>




  </center> 



<!-- SCRIPT PARA BÚSQUEDA POR COLUMNAS   -->


<script type="text/javascript">
    
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#isostatus tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" style="width: 100%;font-size: 12px;font-weight: normal;white-space: nowrap" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#isostatus').DataTable();
 
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


    <!-- FIN DE BÚSQUEDA POR COLUMNAS   -->

    
@endsection

@else
@include('common.forbidden')

@endrole

@endif
