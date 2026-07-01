<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_image',
        'short_desc',
        'position',
    ];

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 1;
    }

    /**
     * Hook into model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $articlesQuery = \App\Models\Articles::where('author_id', $user->id);

            if ($articlesQuery->exists()) {
                // Create a manual author from the user details
                $manualAuthor = \App\Models\ManualAuthor::create([
                    'name' => $user->name,
                    'image' => $user->profile_image,
                    'position' => $user->position,
                    'description' => $user->short_desc,
                    'status' => 1,
                ]);

                // Determine a valid user ID to satisfy the foreign key constraint on articles.author_id
                $reassignAuthorId = null;
                if (auth()->check() && auth()->id() !== $user->id) {
                    $reassignAuthorId = auth()->id();
                } else {
                    $reassignAuthorId = \App\Models\User::where('role', 1)
                        ->where('id', '!=', $user->id)
                        ->first()?->id;

                    if (!$reassignAuthorId) {
                        $reassignAuthorId = \App\Models\User::where('id', '!=', $user->id)->first()?->id;
                    }
                }

                if ($reassignAuthorId) {
                    $articlesQuery->update([
                        'author_id' => $reassignAuthorId,
                        'manual_author_id' => $manualAuthor->id,
                    ]);
                }
            }
        });
    }

    /**
     * Get the user's status.
     */
    protected function status(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => $this->email_verified_at ? 'Active' : 'Pending',
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
}
