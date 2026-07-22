@props([
    'type' => 'text',
    'id' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
])
<input type="{{$type}}"  id="{{$id}}" name="{{$name}}" value="{{ old($name, $value) }}"  placeholder="{{$placeholder}}"
{{$attributes->class(['form-control', 'is-invalid' => $errors->has($name)])}}>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
