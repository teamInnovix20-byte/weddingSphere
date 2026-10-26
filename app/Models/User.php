<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'email', 'password', 'profile_photo_path'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Public URL of the profile picture uploaded in "Edit Profile".
     * Returns null when the user has no photo (the header then shows the default icon).
     *
     * Your upload code should store the picture on the "public" disk, e.g.
     *   $user->update(['profile_photo_path' => $request->file('photo')->store('profile-photos', 'public')]);
     * and `php artisan storage:link` must have been run once.
     */
    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function () {
            $path = $this->profile_photo_path;

            return $path ? Storage::disk('public')->url($path) : null;
        });
    }
}
