<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Invite a new user and send an email invitation.
     */
    public function invite(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|integer',
        ]);

        $temporaryPassword = Str::random(12);

        // Create the user with status pending (email_verified_at is null)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => (int) $request->role,
            'password' => Hash::make($temporaryPassword),
        ]);

        // Send email
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => all_roles()[$user->role] ?? 'User',
            'password' => $temporaryPassword,
            'loginUrl' => route('login'),
        ];

        try {
            Mail::send('emails.invite', $data, function ($message) use ($user) {
                $message->to($user->email, $user->name)
                        ->subject('Invitation to join ' . config('app.name'));
            });
            return redirect()->route('admin.users')->with('success', 'User invited successfully. Invitation email sent!');
        } catch (\Exception $e) {
            // If mail fails, warn the admin but keep the user
            return redirect()->route('admin.users')->with('error', 'User created, but email invitation could not be sent: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|integer',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = (int) $request->role;

        if ($request->has('verified')) {
            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
            }
        } else {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        // Reassign the user's articles to the deleting administrator
        \App\Models\Articles::where('author_id', $user->id)->update([
            'author_id' => auth()->id()
        ]);

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully. Their articles have been reassigned to you.');
    }
}
