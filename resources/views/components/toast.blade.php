{{-- Custom flash toast (no alert()). Auto-hides after 5s, dismissible, animated. --}}
@if (session('toast'))
    @php($toast = session('toast'))
    <div id="toast" role="status" aria-live="polite"
        class="toast fixed bottom-5 right-5 z-50 w-[calc(100%-2.5rem)] max-w-sm rounded-xl border bg-white p-4 shadow-lg
        {{ ($toast['type'] ?? 'success') === 'success' ? 'border-emerald-200' : 'border-rose-200' }}">
        <div class="flex items-start gap-3">
            @if (($toast['type'] ?? 'success') === 'success')
                <span class="toast-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                </span>
            @else
                <span class="toast-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                </span>
            @endif
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-slate-900">{{ $toast['title'] ?? 'Notice' }}</p>
                <p class="mt-0.5 text-sm text-slate-600">{{ $toast['message'] ?? '' }}</p>
            </div>
            <button type="button" onclick="document.getElementById('toast').remove()" aria-label="Dismiss notification"
                class="rounded-md p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
        <div class="toast-progress mt-3 h-1 overflow-hidden rounded-full bg-slate-100">
            <div class="h-full rounded-full {{ ($toast['type'] ?? 'success') === 'success' ? 'bg-emerald-500' : 'bg-rose-500' }}"></div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            var t = document.getElementById('toast');
            if (t) { t.classList.add('toast-hide'); setTimeout(function () { t.remove(); }, 300); }
        }, 5000);
    </script>
@endif
