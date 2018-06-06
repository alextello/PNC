@foreach ($permissions as $id => $name)
<div class="checkbox">
    <label for="">
        <input type="checkbox" name="permissions[]" value="{{$id}}" 
        {{ $model->getAllPermissions()->contains($id) || collect(old('permissions'))->contains($name) ? 'checked' : '' }}>
        <p>{{ $name }}</p>
    </label>
</div>
@endforeach