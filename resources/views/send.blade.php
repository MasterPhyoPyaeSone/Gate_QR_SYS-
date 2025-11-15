<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send PDF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-xl">
    <div class="bg-white shadow-lg rounded-2xl p-6 space-y-4">
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Mail a QRCode</h1>
        <!-- Mail icon button -->
        <button id="openMail" class="p-2 rounded-xl border hover:shadow focus:outline-none" title="Compose email" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </button>
      </div>

      @if (session('status'))
        <div class="rounded-xl bg-green-50 border border-green-200 p-3 text-green-800 text-sm">
          {{ session('status') }}
        </div>
      @endif

      <form id="mailForm" class="hidden space-y-3" action="{{ route('mail.send') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-3">
          <label class="block">
            <span class="text-sm">Recipient Email</span>
            <input required type="email" name="to" class="mt-1 w-full rounded-xl border p-2" placeholder="user@example.com" value="{{ old('to') }}">
            @error('to') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
          </label>
          <label class="block">
            <span class="text-sm">Subject</span>
            <input type="text" name="subject" class="mt-1 w-full rounded-xl border p-2" placeholder="Your subject" value="{{ old('subject') }}">
            @error('subject') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
          </label>
          <label class="block">
            <span class="text-sm">Message</span>
            <textarea name="message" rows="3" class="mt-1 w-full rounded-xl border p-2" placeholder="Write a short note">{{ old('message') }}</textarea>
            @error('message') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
          </label>
          <label class="block">
            <span class="text-sm">Attach Image</span>
            <input required type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml" class="mt-1 w-full rounded-xl border p-2">
            @error('image') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </label>
        
        </div>
        <div class="flex items-center gap-3">
          <button class="px-4 py-2 rounded-xl bg-black text-white">Send</button>
          <button type="button" id="cancelBtn" class="px-4 py-2 rounded-xl border">Cancel</button>
        </div>
      </form>

      <p class="text-xs text-gray-500">
        Tip: Click the mail icon to reveal the form.
      </p>
    </div>
  </div>

  <script>
    const openBtn = document.getElementById('openMail');
    const form = document.getElementById('mailForm');
    const cancelBtn = document.getElementById('cancelBtn');

    openBtn.addEventListener('click', () => form.classList.remove('hidden'));
    cancelBtn?.addEventListener('click', () => {
      form.reset();
      form.classList.add('hidden');
    });
  </script>
</body>
</html>
