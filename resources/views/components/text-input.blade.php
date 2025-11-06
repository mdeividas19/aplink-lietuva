@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:border-amber-500 focus:ring-4 focus:ring-amber-400/30 rounded-xl shadow-sm transition-all duration-200 hover:border-gray-400']) }}>