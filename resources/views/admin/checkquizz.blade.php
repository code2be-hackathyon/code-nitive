<form method="POST" action="{{ @route('admin.checkquizz.post') }}">
    {{ csrf_field() }}
    <button>CHECK QUIZZ</button>
</form>
