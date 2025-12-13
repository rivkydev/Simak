@props(['id'])

<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg">
        {{ $slot }}
    </div>
</div>

<script>
    document.querySelectorAll('[data-modal-target]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelector(btn.dataset.modalTarget).classList.remove('hidden');
        });
    });

    // Optional: Add ESC or backdrop click to close modal
</script>
