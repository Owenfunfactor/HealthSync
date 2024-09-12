@php
    $type ??= 'text'; // Par défaut, le type est 'text' si non spécifié
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= '';
    $placeholder ??= ''; // Variable pour le placeholder
    $options ??= []; // Nouvelle variable pour les options du dropdown
@endphp

<div class="form-group {{ $class }}">
    @if($type !== 'hidden')
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    @if($type == 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>
    @elseif($type == 'select')
        <select class="form-control form-select @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @else
        <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">
    @endif

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>