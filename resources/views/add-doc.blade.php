<form action="{{ route('document.add') }}" method="POST">
    @csrf
    <div>
    <label for="title">Title</label>
    <input name="title" type="text" id="title">
    </div>
    <div>
    <label for="content">Content</label>
    <textarea name="content" id="content"></textarea>
    </div>
    <button type="submit">Submit</button>
</form>