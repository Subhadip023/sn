@php
    $layout = auth()->user()->role === 0 ? 'user-layout' : 'admin-layout';
@endphp

<x-dynamic-component :component="$layout" title="My Profile">
    <!-- CropperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">My Profile</h1>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Side: Forms -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Profile Info -->
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                @include('profile.partials.update-profile-information-form')
            </section>

            <!-- Update Password -->
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                @include('profile.partials.update-password-form')
            </section>

            <!-- Delete User -->
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                @include('profile.partials.delete-user-form')
            </section>
        </div>

        <!-- Right Side: Live Profile Preview Card -->
        <div class="space-y-6">
            <section class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <!-- Cover Banner -->
                <div class="h-32 bg-gradient-to-r from-brand-600 to-indigo-600"></div>
                
                <!-- Avatar & Info -->
                <div class="px-6 pb-6 relative">
                    <div class="flex justify-center -mt-16 mb-4">
                        <div class="w-32 h-32 rounded-full border-4 border-white bg-white overflow-hidden shadow-md flex items-center justify-center">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-4xl uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-center space-y-1">
                        <h2 class="text-xl font-bold text-slate-950">{{ $user->name }}</h2>
                        @if($user->position)
                            <p class="text-sm text-slate-500 font-medium">{{ $user->position }}</p>
                        @endif
                        <div class="inline-block px-2.5 py-0.5 rounded-full bg-brand-50 text-brand-700 text-[11px] font-semibold uppercase tracking-wider">
                            {{ all_roles()[$user->role] ?? 'User' }}
                        </div>
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-6 space-y-4">
                        <div>
                            <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Bio / Short Description</span>
                            <p class="mt-1 text-sm text-slate-600 leading-relaxed italic">
                                {{ $user->short_desc ?: 'No short description provided yet. Write something in your profile to fill this section!' }}
                            </p>
                        </div>

                        <div class="space-y-2.5">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i class="far fa-envelope text-slate-400 w-5"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i class="far fa-calendar-alt text-slate-400 w-5"></i>
                                <span>Member since {{ $user->created_at->format('F Y') }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i class="fas fa-check-circle text-emerald-500 w-5"></i>
                                <span class="capitalize">{{ $user->status }} Account</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- CropperJS JS and Modal -->
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
    
    <div id="profileCropModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60">
        <div class="bg-white rounded-lg p-6 w-[700px] border border-slate-200 shadow-xl space-y-4">
            <h3 class="text-lg font-semibold text-slate-900">Crop Profile Image</h3>
            <div class="max-h-[400px] overflow-hidden flex items-center justify-center bg-slate-50 rounded-lg">
                <img id="profileCropImage" class="max-w-full">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="cancelProfileCrop" class="px-4 py-2 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-700 font-semibold">
                    Cancel
                </button>
                <button type="button" id="saveProfileCrop" class="px-4 py-2 bg-brand-600 hover:bg-brand-500 text-white rounded-lg font-semibold">
                    Crop & Save
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let profileCropper = null;
            const input = document.getElementById('profile_image');
            if (!input) return;

            input.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (!file) return;
                if (file.name === 'cropped.png') return; // Skip if it's already cropped

                const reader = new FileReader();
                reader.onload = function (event) {
                    const modal = document.getElementById("profileCropModal");
                    const image = document.getElementById("profileCropImage");

                    image.src = event.target.result;
                    modal.classList.remove("hidden");

                    if (profileCropper) {
                        profileCropper.destroy();
                    }

                    profileCropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 1,
                        responsive: true,
                    });
                };
                reader.readAsDataURL(file);
            });

            const saveBtn = document.getElementById("saveProfileCrop");
            if (saveBtn) {
                saveBtn.addEventListener("click", function () {
                    if (!profileCropper) return;

                    profileCropper.getCroppedCanvas({
                        width: 300,
                        height: 300,
                    }).toBlob(function (blob) {
                        const file = new File(
                            [blob],
                            "cropped.png",
                            { type: "image/png" }
                        );

                        const dt = new DataTransfer();
                        dt.items.add(file);
                        input.files = dt.files;

                        profileCropper.destroy();
                        profileCropper = null;

                        document.getElementById("profileCropModal").classList.add("hidden");

                        // Trigger the file preview update
                        const preview = document.getElementById('avatar-preview');
                        const placeholder = document.getElementById('avatar-placeholder');
                        if (preview) {
                            preview.src = URL.createObjectURL(file);
                            preview.classList.remove('hidden');
                        }
                        if (placeholder) {
                            placeholder.classList.add('hidden');
                        }
                    });
                });
            }

            const cancelBtn = document.getElementById("cancelProfileCrop");
            if (cancelBtn) {
                cancelBtn.addEventListener("click", function () {
                    if (profileCropper) {
                        profileCropper.destroy();
                        profileCropper = null;
                    }
                    input.value = "";
                    document.getElementById("profileCropModal").classList.add("hidden");
                });
            }
        });
    </script>
</x-dynamic-component>
