<x-layouts.app :title="__('Add Document')">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-[#1e2a47] border-b border-gray-700">
                    <h1 class="mt-2 text-2xl font-medium text-white">
                        Add Document
                    </h1>
                    
                    <form action="{{ route('document.add') }}" method="POST" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-300">Title</label>
                            <input name="title" type="text" id="title" 
                                class="mt-1 block w-full border-gray-700 bg-[#2d3c59] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-white placeholder-gray-400"
                                placeholder="Document title">
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block font-medium text-sm text-gray-300">Content</label>
                            <textarea name="content" id="content" rows="6" 
                                class="mt-1 block w-full border-gray-700 bg-[#2d3c59] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-white placeholder-gray-400"
                                placeholder="Document content"></textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-[#6366f1] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Save Document
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>