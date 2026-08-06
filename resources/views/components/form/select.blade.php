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

    @foreach ($options as $key => $option)

    @php
        $optionValueData = is_array($option) || is_object($option)
            ? data_get($option, $optionValue)
            : $key;

        $optionLabelData = is_array($option) || is_object($option)
            ? data_get($option, $optionLabel)
            : $option;
    @endphp

    <option
        value="{{ $optionValueData }}"
        @selected(old($name, $value) == $optionValueData)
    >
        {{ $optionLabelData }}
    </option>

@endforeach
</select>

@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror