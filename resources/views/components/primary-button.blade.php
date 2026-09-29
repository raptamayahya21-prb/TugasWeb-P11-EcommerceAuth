<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white rounded-xl font-medium text-sm transition-all duration-150 shadow-sm active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-claude-terracotta/40 dark:focus:ring-claude-terracotta-dark/40 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
