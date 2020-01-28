<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hisoctrl;
use App\Disoctrl;
use DB;

class FileController extends Controller
{
    
    public function index()
	{
    	return view('isoctrl.dropzone');
	}

    public function store(Request $request)
    {
            //$filespart = explode(".", $files);

            $path = public_path().'/storage/isoctrl/design/attach/';
            $files = $request->file('file');
            
            foreach($files as $file){

                $fileName = $file->getClientOriginalName();

                $fileNamePart = explode(".", $fileName);

                $fileNameExt = $file->getClientOriginalExtension();

                
                // PARA VALIDAR SI EXISTE
                $indesign = '../public/storage/isoctrl/design/'.$fileName;
                $instress = '../public/storage/isoctrl/stress/'.$fileName;
                $insupports = '../public/storage/isoctrl/supports/'.$fileName;
                $inmaterials = '../public/storage/isoctrl/materials/'.$fileName;
                $inlead = '../public/storage/isoctrl/lead/'.$fileName;
                $iniso = '../public/storage/isoctrl/iso/'.$fileName;

                // PARA VALIDAR SI EXISTE PDF
                $pdfindesign = '../public/storage/isoctrl/design/'.$fileNamePart[0].".pdf";
                $pdfinstress = '../public/storage/isoctrl/stress/'.$fileNamePart[0].".pdf";
                $pdfinsupports = '../public/storage/isoctrl/supports/'.$fileNamePart[0].".pdf";
                $pdfinmaterials = '../public/storage/isoctrl/materials/'.$fileNamePart[0].".pdf";
                $pdfinlead = '../public/storage/isoctrl/lead/'.$fileNamePart[0].".pdf";
                $pdfiniso = '../public/storage/isoctrl/iso/'.$fileNamePart[0].".pdf";

                if (file_exists($indesign) OR file_exists($instress) OR file_exists($insupports) OR file_exists($inmaterials) OR file_exists($inlead) OR file_exists($iniso)){

                        // NOTHING TO DO
                  
                   }else{

                          

                    if ($fileNameExt=="pdf"){ // SE COPIA EL PDF EN RUTA PRINCIPAL Y SE CAMBIA EL NOMBRE EN ATTACH

                        $file->move($path, $fileName);
                        copy ("../public/storage/isoctrl/design/attach/".$fileName,"../public/storage/isoctrl/design/".$fileName);
                        rename ("../public/storage/isoctrl/design/attach/".$fileName,"../public/storage/isoctrl/design/attach/".$fileNamePart[0]."-CL.pdf");

                        // SE CREA REGISTRO DE FECHA

                        $currentdate = date('d-m-Y');
                        $exist = DB::select("SELECT count(*) AS count FROM disoctrls WHERE filename='".$fileName."'");

                        //VALIDA EXISTENCIA

                        if (($exist[0]->count)==0){

                            Disoctrl::create([
                                'filename' =>$fileName,
                                'isostatus_id' =>1, //NEW
                                 ]);

                            Hisoctrl::create([
                                'filename' =>$fileName,
                                'comments' =>'Uploaded', //NEW
                                 ]);

                        }

                    }else{ // SI ES ANEXO, SE COPIA EN LA RUTA DONDE EL PDF EXISTE

                        if (file_exists($pdfindesign)){$path = public_path().'/storage/isoctrl/design/attach/';$file->move($path, $fileName);}

                        if (file_exists($pdfinstress)){$path = public_path().'/storage/isoctrl/stress/attach/';$file->move($path, $fileName);}

                        if (file_exists($pdfinsupports)){$path = public_path().'/storage/isoctrl/supports/attach/';$file->move($path, $fileName);}

                        if (file_exists($pdfinmaterials)){$path = public_path().'/storage/isoctrl/materials/attach/';$file->move($path, $fileName);}

                        if (file_exists($pdfinlead)){$path = public_path().'/storage/isoctrl/lead/attach/';$file->move($path, $fileName);}

                        if (file_exists($pdfiniso)){$path = public_path().'/storage/isoctrl/iso/attach/';$file->move($path, $fileName);}


                    }

                   }
            }
            
    }

 //    public function storeOld(Request $request)
	// {
 //            $path = public_path().'/storage/isoctrl/design/';
 //            $files = $request->file('file');
 //            foreach($files as $file){
 //                $fileName = $file->getClientOriginalName();
 //                $file->move($path, $fileName);
 //            }
	// }
}
