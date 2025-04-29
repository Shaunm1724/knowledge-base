<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DocumentController extends Controller
{
    public function showAddDoc() {
        return view('add-doc');
    }

    public function chatPage () {
        return view('chat');
    }

    // adds new document
    public function addDoc(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // create a new document
        Document::create($validated);

        // redirect to add page
        return redirect()->route('document.add.page');
    }

    // chat request
    public function chatRequest(Request $request) {
        $request->validate(['text']);
        $queryText = $request->input('text');
        $geminiUrl = config('app.gemini_url');
        $geminiApiKey = config('app.gemini_api_key');

        // get the document matching the query
        $document = Document::where('content', 'like', "%$queryText%")->limit(3)->get();

        // get only the content from all the found documents for context
        $context = $document->pluck('content')->implode("\n\n");

        // create a prompt text
        $promptText = [
            [
                'role' => 'user',
                'parts' => [[
                    'text' => "Answer the following question based only on the given documents.\n\nDocuments:\n$context"
                ]]
            ],
            [
                'role' => 'user',
                'parts' => [[ 'text' => $queryText ]]
            ]
        ];

        // make gemini api call
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($geminiUrl.$geminiApiKey, [
            'contents' => $promptText,
        ]);

        $reply = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? "No answer found.";

        return view('chat-response', ['reply' => $reply,]);
    }
}
