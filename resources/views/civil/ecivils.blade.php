@if (Auth::guest())

@else

@role('Civil')

@extends('layouts.datatable')

@section('content')

<!-- ESTILOS DE MODAL -->
<style type="text/css">
    

.dgcAlert {top: 0;position: absolute;width: 100%;display: block;height: 1000px; background: url(http://www.dgcmedia.es/recursosExternos/fondoAlert.png) repeat; text-align:center; opacity:0; display:none; z-index:999999999999999;}
.dgcAlert .dgcVentana{width: 500px; background: white;min-height: 150px;position: relative;margin: 0 auto;color: black;padding: 10px;border-radius: 10px;}
.dgcAlert .dgcVentana .dgcCerrar {height: 25px;width: 25px;float: right; cursor:pointer; background: url(http://www.dgcmedia.es/recursosExternos/cerrarAlert.jpg) no-repeat center center;}
.dgcAlert .dgcVentana .dgcMensaje { margin: 0 auto; padding-top: 0px; text-align: center; width: 400px;font-size: 20px;}
.dgcAlert .dgcVentana .dgcAceptar{background:#09C; bottom:20px; display: inline-block; font-size: 12px; font-weight: bold; height: 24px; line-height: 24px; padding-left: 5px; padding-right: 5px;text-align: center; text-transform: uppercase; width: 75px;cursor: pointer; color:#FFF; margin-top:25px;}

</style>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<?php $areas = DB::table('areas')->pluck('name')->all();
              $type_civil = DB::table('tcivils')->pluck('name')->all(); 
              ?>

<script type="text/javascript">



    $(function () {
        $('.add').click(function () {

            var n = ($('.resultbody tr').length - 0) + 1;
            var tr = '<tr class="fila">' +
                    '<td>{!! Form::select('areas_id[]', [null => 'Select Area...'] + $areas, null, array( 'style'=>'height:34px;font-size: 14px;font-weight: normal;','rcivilred')) !!}</td>'+
                    '<td>{!! Form::select('tcivils_id[]', [null => 'Select Type...'] + $type_civil, null, array( 'style'=>'height:34px;font-size: 14px;font-weight: normal;','rcivilred')) !!}</td>'+
                    '<td>{!! Form::number('qty[]', null, array('placeholder' => 'Qty','class' => 'form-control','style' => 'width: 75px;font-size: 14px;font-weight: normal;','rcivilred')) !!}</td>'+
                    '<td><input type="button" class="btn btn-danger delete" value="x"></td></tr>';
            $('.resultbody').append(tr);
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

// SHOW/UPDATE civil 
$(document).on('click', '.edit-civil-modal', function() {
         
       
         
             //$('#est_qtya').val($(this).data('est_qty'));
            $('.id').val($(this).data('id'));


            $('.units_id').val($(this).data('units_id'));
            $('.areas_id').val($(this).data('areas_id'));
            $('.tcivils_id').val($(this).data('tcivils_id'));
            $('.tag').val($(this).data('tag'));
            $('.hours').val($(this).data('hours'));
            $('.est_qty').val($(this).data('est_qty'));

        });

// DESTROY civil 
$(document).on('click', '.del-ecivils-modal', function() {
         
            
         
             //$('#est_qtya').val($(this).data('est_qty'));
            $('.id').val($(this).data('id'));


            $('.units_id').val($(this).data('units_id'));
            $('.tcivils_id').val($(this).data('tcivils_id'));
            $('.tag').val($(this).data('tag'));
            $('.hours').val($(this).data('hours'));
            $('.est_qty').val($(this).data('est_qty'));

        });
   
</script>

                            <script type="text/javascript">
                                
                                 window.onload = function() {

                                     document.getElementById("s1").style.fontWeight='bold';
                                     document.getElementById("s1").style.fontSize=10 + "pt";
                                     document.getElementById("s1").style.fontStyle="italic";


                                 }

                            </script> 

<br><br><br><br>
<div class="container" style="width: 70%">
                                                
                                                <center>

                                   <!--   Se comprueba el peso deseado (BUDGET/AREAS) -->

                                                <?php $weight_total= DB::select("SELECT weight_total FROM pmanagers WHERE name='civil'");?>


                                                <h2><b>Civil</b></h2>

                                            <?php if ($weight_total[0]->weight_total==0) :?>    

                                                <?php $total_weight= DB::select("SELECT SUM(weight*qty) AS weight FROM ecivilsfullview;");?> 

                                            <?php else: ?>

                                                 <?php $total_weight= DB::select("SELECT weight FROM pmanagers WHERE name='civil'");?>   

                                            <?php endif ?>

                                     <!--   FIN DE LA COMPROBACIÓN (BUDGET/AREAS) -->
                                             
                                                <?php if ($total_weight[0]->weight!=0) :?>

                                                    <h3>Estimated Weight: <?php echo $total_weight[0]->weight; ?>
                                                    <?php $total_progress = DB::select("SELECT SUM((weight*progress)/".$total_weight[0]->weight.") as total_progress FROM dcivilsfullview;");

                                                  
                                                    ?>

                                                <br>Total Progress: <?php echo round($total_progress[0]->total_progress,1)."%";?></h3>


                                                <?php else: ?>

                                                    <h3>Estimated Weight: <?php echo "0"; ?>
                                                    <br>Total Progress: <?php echo "0%";?></h3>

                                                <?php endif ?>
                                                </center>

<br>


@role('CivilAdmin')<button style="align:right" type="button" class="btn btn-lg btn-default" data-toggle="modal" data-target="#createcivilModal"><img src="{{ asset('images/add-icon.ico') }}" style="width:23px" ></button>&nbsp;@endrole
<button onclick="location.href='{{ url('typescivil') }}'" type="button" class="btn btn-lg btn-default"><img src="{{ asset('images/stru-icon.png') }}" style="width:23px" ></button>
<!-- <button onclick="location.href='{{ url('exportcivil') }}'" type="button" class="btn btn-lg btn-success" style="font-size: 16px;font-weight: bold">Excel</button> --><br>

<br>



<link href="{!! asset('css/jquery.dataTables.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{!! asset('js/jquery.dataTables.min.js') !!}"></script>
<table border id="ecivil" class="table table-hover table-condensed" style="width: 100%;font-size: 14px;font-weight: normal;white-space: nowrap">
    <center><thead>
        <tr>
            <th>Area</th>
            <th>Type</th>
            <th>Quantity</th>
            <th style="text-align: center;background: #82DD7C">Modelled</th>

           <!-- SE GENERA SEGUN STEPS DE PROGRESO -->

            <?php

                $pcivils = DB::select("SELECT percentage FROM pcivils"); 

                foreach ($pcivils as $pcivilss) {

                echo "<th style='text-align: center;background: #A8E6A4'>".$pcivilss->percentage."%</th>";           

                } 

            ?>

            @role('CivilAdmin') <th>Action</th> @endrole
        </tr>
    </thead></center>
    <tfoot><tr>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
            <th style="text-align: center"></th>
             <th style="text-align: center"></th>

          <!-- SE GENERA SEGUN STEPS DE PROGRESO --> 

             <?php

                $pcivils = DB::select("SELECT percentage FROM pcivils"); 

                foreach ($pcivils as $pcivilss) {

                echo "<th style='text-align: center'></th>";    

                } 

            ?>
            
            @role('CivilAdmin') <th style="text-align: center"></th> @endrole
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

@role('CivilAdmin')
    <script type="text/javascript">
    var action_bt = "Edit / Delete"
    $(document).ready(function() {
        oTable = $('#ecivil').DataTable({
            
            pageLength: 8,

            "processing": true,
            "serverSide": false,
            "ajax": "{{ route('civil.ecivilsfullquery') }}",
            "columns": [
                     {data: 'area', name: 'area'},
            {data: 'type_civil', name: 'type_civil'},
            {data: 'qty', name: 'qty'},
            {data: 'modeled', name: 'modeled'},

            //SE GENERA SEGUN STEPS DE PROGRESO 
            <?php

                $pcivils = DB::select("SELECT percentage FROM pcivils"); 

                foreach ($pcivils as $pcivilss) {

                echo "{data: 'modeled".$pcivilss->percentage."', name: 'modeled".$pcivilss->percentage."'},";    

                } 

            ?>
            {data: 'action', name: 'action', orderable: false, searchable: false}


            ]

        });

     
    });

    </script>
@else
    <script type="text/javascript">
    var action_bt = "Edit / Delete"
    $(document).ready(function() {
        oTable = $('#ecivil').DataTable({
            
            pageLength: 8,

            "processing": true,
            "serverSide": false,
            "ajax": "{{ route('civil.ecivilsfullquery') }}",
            "columns": [
                {data: 'area', name: 'area'},
            {data: 'type_civil', name: 'type_civil'},
            {data: 'qty', name: 'qty'},
            {data: 'modeled', name: 'modeled'}
             //SE GENERA SEGUN STEPS DE PROGRESO 
            <?php

                $pcivils = DB::select("SELECT percentage FROM pcivils"); 

                foreach ($pcivils as $pcivilss) {

                echo ",{data: 'modeled".$pcivilss->percentage."', name: 'modeled".$pcivilss->percentage."'}";    

                } 

            ?>

            ]

        });

     
    });

    </script>
@endrole

<br>
<br>
<br>


    @extends('civil.createcivil')
 <!--    extends('civil.editcivil') -->
    @extends('civil.delcivil')






<?php 

    $sum_per = DB::select("SELECT SUM(percentage) as sum_per FROM pcivils");
    $sum_est_qty = DB::select("SELECT SUM(est_qty) as sum_est_qty FROM ecivils");
    $sum_hours = DB::select("SELECT SUM(hours) as sum_hours FROM civilsview");
    $mult_estimated = DB::select("SELECT SUM(`est_hours`) AS mult_estimated FROM civilsview");


    $qty_x_hours=$sum_est_qty[0]->sum_est_qty * $sum_hours[0]->sum_hours;

?>



  </center> 


  <center>
  <button onclick="location.href='{{ url('modeledcivil') }}'" type="button" class="btn btn-primary btn-lg">Modelled</button>
  <!-- <button style="align:right" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modeledcivilModal">Modelled</button> -->
<!--   <button onclick="location.href='{{ url('glinecivil') }}'" type="button" class="btn btn-primary btn-lg">CurveByArea</button> -->
  <button onclick="location.href='{{ url('glineciviltotal') }}'" type="button" class="btn btn-primary btn-lg">Curve</button>
  <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#glinecivilModal">LineChart</button> -->

  <button onclick="location.href='{{ url('home') }}'" type="button" class="btn btn-lg btn-default">Home</button>


  </center>

<!-- SCRIPT PARA BÚSQUEDA POR COLUMNAS   -->


<script type="text/javascript">
    
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#ecivil tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" style="width: 100%;font-size: 12px;font-weight: normal;white-space: nowrap" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#ecivil').DataTable();
 
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
