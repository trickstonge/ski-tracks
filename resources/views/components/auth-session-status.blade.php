@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-green-700']) }}>
        {{ $status }}
    </div>
@endif
