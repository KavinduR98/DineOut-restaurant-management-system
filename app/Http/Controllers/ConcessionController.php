<?php

namespace App\Http\Controllers;
use App\Models\Concession;
use App\Models\ConcessionAttachment;
use Exception;

use Illuminate\Http\Request;


class ConcessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("concessions.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("concessions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $file = $request->file('file');
            $image_icon = $request->get('imageIcon');

            $concession = new Concession();

            $concession->name = $request->get('name');
            $concession->description = $request->get('description');
            $concession->price = $request->get('price');

            if ($concession->save()) {
                if ($file) {
                    $this->uploadFile($file, $concession->id);
                }

                if ($image_icon) {
                    $this->uploadImageIcon($image_icon, $concession->id);
                }

                return response()->json(["status" => "success", "file" => $file]);
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    private function uploadImageIcon($img, $id)
    {
        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        $filename = $id . '.png';
        $folderPath = public_path('attachments/concession_icon_images/');
        $filePath = $folderPath . $filename;
;
        file_put_contents($filePath, $image_base64);

        return $filename;
    }

    public function uploadFile($file, $id)
    {
        try {
            if ($file) {

                $exAttachment = ConcessionAttachment::where('concession_id', $id)->first();

                if ($exAttachment) {

                    $ex_filepath = $exAttachment->path;

                    if ($ex_filepath) {
                        $baseUrl = url('/') . "/attachments/concession_images/";
                        $file_data = str_replace($baseUrl, '', $ex_filepath);
                        $file_data = public_path('attachments/concession_images') . '/' . $file_data;

                        if (file_exists($file_data)) {
                            unlink($file_data);
                        }
                    }

                    $file_name = $file->getClientOriginalName();
                    $filename = url('/') . '/attachments/concession_images/' . uniqid() . '_' . time() . '.' . str_replace(' ', '_', $file_name);
                    $filename = str_replace(' ', '', str_replace('\'', '', $filename));
                    $file->move(public_path('attachments/concession_images'), $filename);

                    $data = ConcessionAttachment::where('concession_id', $id)
                        ->update(['path' => $filename]);
                    if ($data) {
                        Concession::where('id', $id)
                            ->update(['path' => $filename]);
                    }

                } else {
                    
                    $file_name = $file->getClientOriginalName();
                    $filename = url('/') . '/attachments/concession_images/' . uniqid() . '_' . time() . '.' . str_replace(' ', '_', $file_name);
                    $filename = str_replace(' ', '', str_replace('\'', '', $filename));
                    $file->move(public_path('attachments/concession_images'), $filename);

                    $attachment = new ConcessionAttachment();
                    $attachment->concession_id = $id;
                    $attachment->path = $filename;
                    
                    if($attachment->save()){
                        Concession::where('id', $id)
                                        ->update(['image_path' => $filename]);
                    } 

                }
            }

        } catch (Exception $ex) {
            return $ex;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
