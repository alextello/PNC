@foreach ($permissions as $id => $name)
<div class="checkbox">
    <label for="">
        <input type="checkbox" name="permissions[]" value="{{$id}}" {{ $user->permissions->contains($id) ? 'checked' : '' }}>
        <p>{{ $name }}</p>
    </label>
</div>
@endforeach