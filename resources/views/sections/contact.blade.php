{{-- Contact form --}}
<section id="contact" class="scroll-mt-24 bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 md:py-18">
        <div class="reveal max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-brand">Hire Me</p>
            <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Get in Touch</h2>
            <p class="mt-2 text-slate-500">Freelance, contract, or remote roles in system development, cybersecurity, and DevOps.</p>
        </div>
        <div class="mt-8 grid gap-6 md:grid-cols-5">
            <div class="reveal rounded-xl border border-slate-200 bg-white p-6 shadow-sm md:col-span-2">
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-soft text-brand-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </span>
                        <span><span class="block font-bold text-slate-900">Email</span>
                        <a href="mailto:{{ $data['profile']['email'] }}" class="text-slate-600 hover:text-brand">{{ $data['profile']['email'] }}</a></span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-soft text-brand-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4V8h4v2a6 6 0 0 1 2-2z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                        </span>
                        <span><span class="block font-bold text-slate-900">LinkedIn</span>
                        <a href="{{ $data['profile']['linkedin'] }}" target="_blank" rel="noopener" class="text-slate-600 hover:text-brand">linkedin.com/in/setiawan-risky</a></span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-soft text-brand-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <span><span class="block font-bold text-slate-900">Location</span>
                        <span class="text-slate-600">{{ $data['profile']['location'] }}</span></span>
                    </li>
                </ul>
            </div>
            <form method="POST" action="{{ Route::has('contact.send') ? route('contact.send') : url('/contact') }}" class="reveal rounded-xl border border-slate-200 bg-white p-6 shadow-sm md:col-span-3">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1 block text-sm font-semibold text-slate-700">Name</label>
                        <input id="name" name="name" type="text" required maxlength="100" value="{{ old('name') }}" placeholder="Your name"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        @error('name')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
                        <input id="email" name="email" type="email" required maxlength="150" value="{{ old('email') }}" placeholder="you@example.com"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        @error('email')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-4">
                    <label for="subject" class="mb-1 block text-sm font-semibold text-slate-700">Subject <span class="font-normal text-slate-400">(optional)</span></label>
                    <input id="subject" name="subject" type="text" maxlength="150" value="{{ old('subject') }}" placeholder="Project inquiry"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                </div>
                <div class="mt-4">
                    <label for="message" class="mb-1 block text-sm font-semibold text-slate-700">Message</label>
                    <textarea id="message" name="message" required rows="5" maxlength="5000" placeholder="Tell me about your project..."
                        class="w-full resize-y rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                </div>
                <button type="submit"
                    class="mt-5 inline-flex items-center gap-2 rounded-lg bg-brand px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>
