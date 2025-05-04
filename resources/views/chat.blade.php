<h1>Gemini chat form</h1>
<form action="{{ route('chat.request') }}" method="POST">
    @csrf
    <div>
        <label for="text">Chat with gemini</label>
        <textarea id="text" name="text"></textarea>
    </div>
    <button type="submit">Submit</button>
</form>