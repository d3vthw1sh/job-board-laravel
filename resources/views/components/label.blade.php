<label class="mb-2 block text-sm font-medium text-white"
  for="{{ $for }}">
  {{ $slot }} @if ($required)
    <span class="text-red-400">*</span>
  @endif
</label>
