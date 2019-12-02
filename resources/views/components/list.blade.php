<div class="list-group">
    @foreach($quizzs as $quizz)
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{$quizz->label}}</h5>
        </div>
        <p class="mb-1">{{$quizz->overview}}</p>
    </a>
    @endforeach
</div>
