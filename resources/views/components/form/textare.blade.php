@props([
    'id' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
])
<textarea  id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}"
 {{$attributes->class(['form-control', 'is-invalid' => $errors->has($name)])}}>{{ old($name, $value) }}</textarea>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror