<div>
    {{-- Header --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Profile</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}"
                                    wire:navigate>Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Header --}}
    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Ganti Profil</h5>
                    <p class="card-subtitle mb-4">Ganti foto profilmu disini</p>
                    <form id="upload-photo" action="" enctype="multipart/form-data" method="POST">
                        <div class="text-center">
                            <img id="profile-image" src="{{ $user->showAvatar() }}" alt=""
                                class="rounded-circle cursor-pointer" width="120" height="120"
                                style="object-fit: cover" @click="$refs.avatar.click()" wire:model.live='avatar'>
                            <input id="photo-profile" type="file" name="photoProfile"
                                class="d-none" id="photo-profile-main" x-ref="avatar">
                            <div class="d-flex align-items-center justify-content-center my-4 gap-3">
                                <button id="upload-button" type="button" class="btn btn-primary">Simpan</button>
                                <button type="button" id="delete-photo" class="btn btn-danger">Hapus</button>
                            </div>
                            <p class="mb-0">Klik foto untuk ubah foto, lalu klik tombol "Simpan" untuk
                                simpan. Dan klik button "Hapus" untuk hapus foto.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Change Password</h5>
                    <p class="card-subtitle mb-4">To change your password please confirm here</p>
                    <form action="" method="POST" id="change-password-form">
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Current
                                Password</label>
                            <input type="password" class="form-control" id="current-pass" name="currentPass"
                                value="">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">New
                                Password</label>
                            <input type="password" class="form-control" id="new-pass" name="newPass" value="">
                        </div>
                        <div class="">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Confirm
                                Password</label>
                            <input type="password" class="form-control" id="confirm-pass" name="newPass_confirmation"
                                value="">
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                            <button id="update-pass-button" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Personal Details</h5>
                    <p class="card-subtitle mb-4">To change your personal detail , edit and save from here
                    </p>
                    <form action="" method="POST" id="biodata-update-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Nama</label>
                                    <input type="text" class="form-control" id="username-input"
                                        placeholder="Isi nama anda" value="" name="username">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" id="email-input"
                                        placeholder="Masukkan email anda" value="" name="email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Nickname</label>
                                    <input type="text" class="form-control complex-colorpicker"
                                        id="nickname-input" placeholder="Isi Nickname" name="nickname"
                                        value="">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Tanggal
                                        Lahir</label>
                                    <input type="text" class="form-control complex-colorpicker" id="date-input"
                                        placeholder="YYYY/MM/DD" name="date">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
