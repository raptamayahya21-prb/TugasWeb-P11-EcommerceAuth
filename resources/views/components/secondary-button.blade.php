<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-xl font-medium text-sm text-claude-text-primary dark:text-claude-text-dark-primary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle active:scale-[0.98] transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-claude-terracotta/20 disabled:opacity-40']) }}>
    {{ $slot }}
</button>
