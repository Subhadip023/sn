@props([
    'id',
    'title',
    'maxWidth' => 'w-[500px]'
])

<div id="{{ $id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 admin-modal-overlay">
    <div class="bg-white rounded-xl p-6 {{ $maxWidth }} border border-slate-200 shadow-lg space-y-4">
        {{-- Header --}}
        <div class="flex items-center justify-between border-b pb-3 text-slate-900">
            <h2 class="text-lg font-semibold">{{ $title }}</h2>
            <button type="button" class="close-modal-btn text-slate-400 hover:text-slate-600" data-modal="{{ $id }}">
                <i class="fa fa-times"></i>
            </button>
        </div>

        {{-- Content --}}
        <div class="space-y-4">
            {{ $slot }}
        </div>
    </div>
</div>

@once
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Close modal when clicking close button or clicking outside
        document.body.addEventListener('click', function(e) {
            const closeBtn = e.target.closest('.close-modal-btn');
            if (closeBtn) {
                const modalId = closeBtn.getAttribute('data-modal');
                closeModal(modalId);
            }
            
            if (e.target.classList.contains('admin-modal-overlay')) {
                closeModal(e.target.id);
            }
        });
    });

    window.openModal = function(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            // Move modal to body to avoid layout clipping inside parent containers
            if (modal.parentElement !== document.body) {
                document.body.appendChild(modal);
            }
        }
    };

    window.closeModal = function(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    };
</script>
@endonce
