@props([
    'id',
    'name',
    'options' => [],
    'value' => null,
    'placeholder' => 'Select',
    'optionValue' => 'id',
    'optionLabel' => 'name',
])

<select
    id="{{ $id }}"
    name="{{ $name }}"
    @class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ])
>
    <option value="">{{ $placeholder }}</option>

    @foreach ($options as $option)
        <option
            value="{{ data_get($option, $optionValue) }}"
            @selected(old($name, $value) == data_get($option, $optionValue))
        >
            {{ data_get($option, $optionLabel) }}
        </option>
    @endforeach
</select>

@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror