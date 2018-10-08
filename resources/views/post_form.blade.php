<div class="form-group row">
    {{ Form::label('name', '*&nbsp;Title', ['class' => 'col-sm-4 col-form-label text-md-right']) }}
    <div class="col-md-6">
        {{ Form::text('title', null, ['class' => 'form-control']) }}
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>

{{-- Merge 1 --}}
<div class="form-group row">
    {{ Form::label('description', '*&nbsp;Description', ['class' => 'col-sm-4 col-form-label text-md-right')] }}
    <div class="col-md-6">
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    </div>
</div>

{{-- Comment for master branch --}}
<div class="form-group row">
    {{ Form::label('tags', '*&nbsp;Tags', ['class' => 'col-sm-4 col-form-label text-md-right']) }}
    <div class="col-md-6">
        {{ Form::select('tags[]', $arrTagNames, null, array('class' => 'form-control post-tags', 'multiple'=>'multiple')) }}
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    </div>
</div>

<div class="form-group row">
    {{ Form::label('image', 'Image', ['class' => 'col-sm-4 col-form-label text-md-right']) }}
    <div class="col-md-6">
        {{ Form::file('image', null, ['class' => 'form-control']) }}
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('image') }}</strong>
        </span>
    </div>
</div>