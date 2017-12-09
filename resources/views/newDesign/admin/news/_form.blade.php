@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    {!! Form::label('name', 'Title:', ['class' => 'focus']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','id'=>'editor2']) !!}
</div>
    <br>


<script>$(document).ready(function(){CKEDITOR.replace( 'description' );});</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>