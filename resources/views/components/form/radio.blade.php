@props([
    'type' => 'radio',
    'id' => '',
    'name' => '',
    'options' => [],
    'selected' => '',
])
@foreach ($options as $value =>$text )
<div class="form-check" id="status">
    <input class="form-check-input" type="{{$type}}" name="{{$name}}" value='{{$value}}' id="{{$id}}"
        @checked(old($name,$selected) === $value) 
        {{$attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)])}}>
    <label class="form-check-label" for="{{$id}}">
        {{ $text }}
    </label>
</div>
    
@endforeach
@error('{{ $name }}')
    <small class="text-danger">{{ $message }}</small>
    
@enderror