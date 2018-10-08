<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use PDF;

class FileController extends Controller
{
    public function word($id)
    {
        $post = Post::find($id);
        $post->load('photos');
        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontSize(12);
        $phpWord->setDefaultFontName('arial');

        /* Note: any element you append to a document must reside inside of a Section. */
        
        // Adding an empty Section to the document...
        $section = $phpWord->addSection(
            array('paperSize' => 'Folio', 'size' => 12)
        );
        
        // Adding Text element to the Section having font styled by default...
        $section->addText('titulo: '. $post->title);
        $section->addText('REF: '. $post->owner()->first()->reference.'/'.strtoupper($post->jefeDeTurno()->first()->reference));
        $section->addText('Contenido:');
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $post->body);
        
        if($post->photos->count()>0){
            foreach($post->photos as $photo){
                $section->addImage(asset('/storage/'.$photo->url));
            }
        }

        $section->addText('f._______________________________');
        $section->addText($post->jefeDeTurno()->first()->name);
        $section->addText('Jefe de turno');
        $section->addText('Subcomisaria 41-31 San Juan Ostuncalco');


        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        // try{
        //     $objWriter->save(storage_path($post->url.'.docx'));
        // }catch(Exception $e){

        // }
        // return response()->download(storage_path($post->url.'.docx'));
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
          $objWriter->save(storage_path($post->url.'.docx'));
        } catch (Exception $e) {
    
        }
        return response()->download(storage_path($post->url.'.docx'))->deleteFileAfterSend(true);;
    }

    public function pdf($id)
    {
        $post = Post::where('id',$id)->with(['owner', 'jefeDeTurno', 'photos'])->first();
        // $post->load('photos');
        // dd($post);
        $pdf = PDF::loadView('posts.pdf', ['post' => $post])->setPaper('folio');
        // return $pdf->stream();
        return $pdf->download($post->url.'.pdf');
    }
}
