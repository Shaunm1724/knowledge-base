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
        
        // Use Laravel Scout to search the model for the query
        $documents = Document::search($queryText)->take(3)->get();
        
        // If no documents found, provide an empty context
        $context = '';
        
        if ($documents->isNotEmpty()) {
            // Get only the content from all the found documents for context
            $context = $documents->pluck('content')->implode("\n\n");
        }
        
        // Create a prompt text
        $promptText = [
            [
                'role' => 'user',
                'parts' => [['text' => "If no documents only then answer on your own"]]
            ],
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
        
        // Make Gemini API call
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($geminiUrl.$geminiApiKey, [
            'contents' => $promptText,
        ]);

        $reply = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? "No answer found.";

        return view('chat-response', ['reply' => $reply,]);
    }
}
