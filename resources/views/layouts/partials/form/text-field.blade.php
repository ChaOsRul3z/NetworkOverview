<div class="form-group">
    <label for="name" class="col-md-12">
        <input type="{{ $type }}" class="form-control" name="{{ $name }}" placeholder="{{ str_replace('_', ' ', $name) }}" value="@if(isset($model)){{$model->$name }}@else{{ old($name) }}@endif">
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </label>
</div>