<x-layouts.app :title="__('Chat Response')">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-[#1e2a47] border-b border-gray-700">
                    <h1 class="mt-2 text-2xl font-medium text-white">
                        Gemini Reply
                    </h1>
                    
                    <div class="mt-6 text-gray-300 leading-relaxed">
                        <div class="prose prose-invert max-w-none">
                            {!! nl2br(e($reply)) !!}
                        </div>
                    </div>
                    
                    <div class="mt-6 flex items-center justify-end">
                        <a href="{{ route('chat.page') }}" 
                           class="inline-flex items-center px-4 py-2 bg-[#6366f1] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                            New Chat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>