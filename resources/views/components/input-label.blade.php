@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-xs tracking-wide uppercase text-claude-text-secondary dark:text-claude-text-dark-secondary mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
