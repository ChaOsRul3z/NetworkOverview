<fieldset>
    <legend>{{ $header }}</legend>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <select class="form-control">
            @foreach ($units as $unit)
                <option @if(isset($selected)) @if($unit->id == $selected->unit->id) {{ 'selected' }} @endif @endif value="{{ $unit->id }}">{{ $unit->name }}</option>
            @endforeach
        </select>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <select class="form-control" id="port{{ $name }}_id" name="port{{ $name }}">
        </select>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</fieldset>