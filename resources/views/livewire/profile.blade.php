<div>
    {{-- Header --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Profil</h4>
                    <p>Ini adalah halaman yang berisi detail profil anda.</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted" href="{{ route('home') }}" wire:navigate>Beranda</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Profil</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Header --}}

    {{-- Photo Profile --}}
    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Ganti Profil</h5>
                    <p class="card-subtitle mb-4">Ganti foto profil Anda di sini</p>
                    <form id="upload-photo" action="" enctype="multipart/form-data" method="POST">
                        <div class="text-center">
                            <img id="profile-image"
                                @if ($avatar) src="{{ $avatar->temporaryUrl() }}"
                                @else src="{{ $user->showAvatar() }}" @endif
                                alt="user-avatar" class="rounded-circle cursor-pointer" width="120" height="120"
                                style="object-fit: cover" @click="$refs.avatar.click()">
                            <div>
                                <p wire:loading wire:target='avatar'>Sedang upload gambar...</p>
                            </div>
                            <input id="photo-profile" type="file" name="photoProfile" class="d-none"
                                id="photo-profile-main" x-ref="avatar" wire:model='avatar' accept="image/*">
                            <div class="d-flex align-items-center justify-content-center my-4 gap-3">
                                <button id="upload-button" type="button" class="btn btn-primary"
                                    wire:click='updateAvatar'>Simpan</button>
                                <button type="button" id="delete-photo" class="btn btn-danger"
                                    wire:click='deleteAvatar'>Reset</button>
                            </div>
                            <p class="mb-0">Klik foto untuk mengubah foto, lalu klik tombol "Simpan" untuk menyimpan.
                                Dan klik tombol "Reset" untuk mereset foto.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Photo Profile --}}

        {{-- Ganti Password --}}
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Ganti Password</h5>
                    <p class="card-subtitle mb-4">Untuk mengubah kata sandi Anda, silakan konfirmasi di sini</p>
                    <form id="change-password-form" wire:submit='updatePassword'>
                        <div class="mb-4">
                            <label for="current-pass" class="form-label fw-semibold">Password Saat
                                Ini</label>
                            <input type="password" class="form-control @error('oldPassword') is-invalid @enderror"
                                id="current-pass" name="currentPass" wire:model='oldPassword'>
                            @error('oldPassword')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="new-pass" class="form-label fw-semibold">Password
                                Baru</label>
                            <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                id="new-pass" name="newPass" wire:model='newPassword'>
                            @error('newPassword')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="">
                            <label for="confirm-pass" class="form-label fw-semibold">Konfirmasi
                                Password</label>
                            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                                id="confirm-pass" name="newPass_confirmation" wire:model='confirmPassword'>
                            @error('confirmPassword')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                            <button id="update-pass-button" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Ganti Password --}}

        {{-- Detail Pribadi --}}
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Detail Pribadi</h5>
                    <p class="card-subtitle mb-4">Untuk mengubah detail pribadi Anda, edit dan simpan dari sini</p>
                    <form id="biodata-update-form" wire:submit='updateBio'>
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                    <label for="username-input" class="form-label fw-semibold">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="username-input" placeholder="Isi Nama Anda" wire:model='name'>
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="nickname-input" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="nickname-input" placeholder="Isi Email Anda" wire:model='email'>
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Detail Pribadi --}}

    </div>

    @script
        <script>
            $wire.on('notify', data => {
                Swal.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endscript
</div>
