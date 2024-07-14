<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $name, $email;
    public $avatar;
    public $oldPassword, $newPassword, $confirmPassword;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user->id),
            ],
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        ];
    }

    public function render()
    {
        return view('livewire.profile');
    }

    public function updateBio()
    {
        $validated = $this->validate();

        $this->user->update($validated);

        $this->notify('Berhasil', 'Berhasil update bio', 'success');

        $this->dispatch('profile-updated');
    }

    public function updateAvatar()
    {
        if ($this->avatar) {
            $this->checkAndDeleteCurrentAvatar();

            $path = $this->avatar->store('users-avatar', 'public');
            $avatarName = basename($path);

            $this->user->update(['avatar' => $avatarName]);
        }

        $this->notify('Berhasil', 'Foto profil sudah diperbarui', 'success');

        $this->dispatch('profile-updated');
    }

    public function deleteAvatar()
    {
        $this->checkAndDeleteCurrentAvatar();

        $this->notify('Berhasil', 'Foto profil sudah dihapus', 'success');

        $this->dispatch('profile-updated');
    }

    public function updatePassword()
    {
        $this->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|string|same:newPassword',
        ], [
            'oldPassword.required' => 'Kata sandi lama wajib diisi.',
            'newPassword.required' => 'Kata sandi baru wajib diisi.',
            'newPassword.min' => 'Kata sandi baru harus memiliki setidaknya :min karakter.',
            'confirmPassword.required' => 'Konfirmasi sandi baru wajib diisi.',
            'confirmPassword.same' => 'Konfirmasi sandi tidak cocok'
        ]);

        if (!Hash::check($this->oldPassword, $this->user->password)) {
            $this->reset('oldPassword', 'newPassword', 'confirmPassword');

            return $this->notify('Gagal', 'Kata sandi lama salah', 'error');
        }

        $this->user->update(['password' => bcrypt($this->newPassword)]);

        $this->reset('oldPassword', 'newPassword', 'confirmPassword');

        $this->notify('Berhasil', 'Berhasil memperbarui kata sandi', 'success');
    }

    private function checkAndDeleteCurrentAvatar()
    {
        if ($this->user->avatar) {
            $avatar = $this->user->avatar;

            Storage::delete('users-avatar/' . $avatar);

            $this->user->update(['avatar' => null]);
        }
    }

    private function notify(string $title, string $message, string $icon)
    {
        $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }
}
