@foreach ($roles as $role)
<div class="checkbox">
    <label for="">
        <input type="checkbox" name="roles[]" value="{{$role->id}}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
        <p>{{ $role->name }}</p>
        <small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
    </label>
</div>
@endforeach