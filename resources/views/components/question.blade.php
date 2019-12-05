@if($question->type == 'QCM')
<!-- general form elements disabled -->
<div class="card card-white">

    <input type="hidden" value="{{$question->id}}">
    <div class="card-header">
        <h3 class="card-title">
            @if($errors != null && in_array($question->id, $errors))
                <i class="fas fa-times" style="color:#e74c3c;padding-right: 7px"></i>
            @endif
                {{$question->label}}</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            @foreach($question->responses() as $response)
            <!--<div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{$question->id}}[]" value="{{$response}}">
                <label class="form-check-label">{{$response}}</label>
            </div>-->
                <div class="form-check custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="{{$response}}" value="{{$response}}" name="{{$question->id}}[]">
                    <label for="{{$response}}" class="custom-control-label">{{$response}}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- /.card -->

