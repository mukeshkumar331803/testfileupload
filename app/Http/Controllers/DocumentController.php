<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Validator;

class DocumentController extends Controller
{
    // public function displayPdf()
    // {
    //     return view('pdf.view');
    // }

    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'file' => 'required|mimes:doc,docx,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName);

        Document::create([
            'title' => $request->input('title'),
            'file_path' => $filePath,
        ]);

        return response()->json(['success' => 'Document uploaded successfully']);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $results = Document::where('title', 'like', '%' . $keyword . '%')->get();
        $filePaths = $results->pluck('file_path');
        return response()->json(['results' => $results, 'filePaths' => $filePaths]);
    }

}
