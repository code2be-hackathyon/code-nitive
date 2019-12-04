@if($question->type == 'QCM')
<!-- general form elements disabled -->
<div class="card card-white">
    <input type="hidden" value="{{$question->id}}">
    <div class="card-header">
        <h3 class="card-title">{{$question->label}}</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            @foreach($question->responses() as $response)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{$question->id}}[]" value="{{$response}}">
                <label class="form-check-label">{{$response}}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if($question->type == 'SA')
<!-- general form elements disabled -->
<div class="card card-white">
    <input type="hidden" value="{{$question->id}}">
    <div class="card-header">
        <h3 class="card-title">{{$question->label}}</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            @foreach($question->responses() as $response)
            <div class="form-check">
                <label class="form-check-label">Votre réponse : </label>
                 <input class="form" type="text" name="{{$question->id}}[]" value="" placeholder="...">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if($question->type == 'TF')
<!-- general form elements disabled -->
<div class="card card-white">
    <input type="hidden" value="{{$question->id}}">
    <div class="card-header">
        <h3 class="card-title">{{$question->label}}</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            @foreach($question->responses() as $response)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{$question->id}}[]" value="{{$response}}">
                <label class="form-check-label">{{$response}}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- /.card -->

