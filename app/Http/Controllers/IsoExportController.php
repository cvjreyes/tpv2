<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class IsoExportController extends Controller{

        public function exportisodates(){


            Excel::create('IsoController', function($excel) {

                $excel->sheet('Design', function($sheet) {

                   $iso = DB::select("SELECT * FROM disoctrls ORDER BY filename");
                   $data= [];

                   foreach ($iso as $isos) {

                    $row = [];
                    $row['ISOMETRIC'] = $isos->filename;
                    $row['REV'] = $isos->revision;
                    $row['DATE'] = $isos->ddesign;
                    $data[] = $row;
                   
                   }


                   //$epipes = Epipe::all();
                   $sheet->fromArray($data);

                });

                $excel->sheet('Stress', function($sheet) {

                   $iso = DB::select("SELECT * FROM disoctrls WHERE id IN (SELECT MAX(id) FROM disoctrls GROUP BY filename) ORDER BY id DESC"); //QUERY PARA TODOS MENOS DESIGN
                   $data= [];

                   foreach ($iso as $isos) {

                    $row = [];
                    $row['ISOMETRIC'] = $isos->filename;
                    $row['INBOX'] = $isos->instress;
                    $row['DATE'] = $isos->dstress;
                    $data[] = $row;
                   
                   }


                   //$epipes = Epipe::all();
                   $sheet->fromArray($data);

                });

                $excel->sheet('Supports', function($sheet) {

                   $iso = DB::select("SELECT * FROM disoctrls WHERE id IN (SELECT MAX(id) FROM disoctrls GROUP BY filename) ORDER BY id DESC"); //QUERY PARA TODOS MENOS DESIGN
                   $data= [];

                   foreach ($iso as $isos) {

                    $row = [];
                    $row['ISOMETRIC'] = $isos->filename;
                    $row['INBOX'] = $isos->insupports;
                    $row['DATE'] = $isos->dsupports;
                    $data[] = $row;
                   
                   }


                   //$epipes = Epipe::all();
                   $sheet->fromArray($data);

                });

                $excel->sheet('Materials', function($sheet) {

                   $iso = DB::select("SELECT * FROM disoctrls WHERE id IN (SELECT MAX(id) FROM disoctrls GROUP BY filename) ORDER BY id DESC"); //QUERY PARA TODOS MENOS DESIGN
                   $data= [];

                   foreach ($iso as $isos) {

                    $row = [];
                    $row['ISOMETRIC'] = $isos->filename;
                    $row['INBOX'] = $isos->inmaterials;
                    $row['DATE'] = $isos->dmaterials;
                    $data[] = $row;
                   
                   }


                   //$epipes = Epipe::all();
                   $sheet->fromArray($data);

                });

            })->export('xlsx');
           
          
            
            }


            public function exportmodeledequi(){


            Excel::create('ModeledEqui3D', function($excel) {

                $excel->sheet('Dequis', function($sheet) {

                   $eequis = DB::select("SELECT * FROM dequisfullview");
                   $data= [];

                   foreach ($eequis as $eequi) {

                    $row = [];
                    $row['UNIT'] = $eequi->unit;
                    $row['AREA'] = $eequi->area;
                    $row['TAG'] = $eequi->tag;
                    $row['TYPE'] = $eequi->type_equi;
                    $row['WEIGHT'] = $eequi->weight;
                    $row['QUANTITY'] = $eequi->est_quantity;
                    $row['STATUS'] = $eequi->status;
                    $row['PROGRESS'] = $eequi->progress;
                    $data[] = $row;
                   
                   }


                   //$epipes = Epipe::all();
                   $sheet->fromArray($data);

                });

            })->export('xlsx');
           
          
            
            }

            public function exporttypeequi(){


            Excel::create('TypeEqui3D', function($excel) {

                $excel->sheet('Tequis', function($sheet) {

                   $eequis = DB::select("SELECT * FROM tequis");
                   $data= [];

                   foreach ($eequis as $eequi) {

                    $row = [];
                    $row['CODE'] = $eequi->code;
                    $row['NAME'] = $eequi->name;
                    $row['WEIGHT'] = $eequi->hours;
                    $data[] = $row;
                   
                   }


                   //$epipes = Epipe::all();
                   $sheet->fromArray($data);

                });

            })->export('xlsx');
           
          
            
            }

    }