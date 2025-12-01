<x-filament-panels::page.simple>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (filament()->hasLogin())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.heading') }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentAsset::getStyleHtml() }}

    <x-filament-panels::form wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    <!-- SweetAlert Script untuk menampilkan error -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Listen for login error event
            Livewire.on('login-error', (event) => {
                const data = event[0] || event;
                Swal.fire({
                    icon: 'error',
                    title: data.title || 'Login Gagal!',
                    text: data.message || 'Kredensial yang Anda masukkan tidak valid.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#7f1d1d', // Maroon color matching your theme
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
            });
        });
    </script>

    {{ \Filament\Support\Facades\FilamentAsset::getScriptHtml() }}
</x-filament-panels::page.simple>
