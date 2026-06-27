<x-admin-layout title="Users">
        <header class="flex flex-wrap items-center gap-4 justify-between">
          <div>
            <p class="text-sm text-slate-500">Team</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage users</h1>
          </div>
          <div class="flex items-center gap-3">
            <button id="themeBtn" class="px-4 py-2 rounded-lg border border-slate-200 hover:border-slate-300 text-slate-700">Theme</button>
            <a class="px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-semibold" href="#inviteForm">Invite</a>
          </div>
        </header>

        <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <input class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" type="search" placeholder="Search user" />
              <select class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-900 focus:border-brand-500 focus:outline-none">
                <option>All roles</option>
                @foreach(all_roles() as $role)
                <option>{{ $role }}</option>
                @endforeach
              </select>
            </div>
            <span class="text-sm text-slate-500">{{ count($users) }} users</span>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="text-slate-500">
                <tr class="text-left">
                  <th class="py-2 font-medium">Name</th>
                  <th class="py-2 font-medium">Email</th>
                  <th class="py-2 font-medium">Role</th>
                  <th class="py-2 font-medium">Status</th>
                  <th class="py-2 font-medium">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                @if(isset($users))
                @foreach($users as $user)
                <tr>
                  <td class="py-2 text-slate-900">{{ $user->name }}</td>
                  <td class="py-2 text-slate-600">{{ $user->email }}</td>
                  <td class="py-2 text-slate-600">{{ all_roles()[$user->role] }}</td>
                  <td class="py-2"><span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-medium">Active</span></td>
                  <td class="py-2 space-x-2">
                    <button class="text-slate-500 hover:text-slate-700">Edit</button>
                    <button class="text-amber-600 hover:text-amber-700">Disable</button>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  No users yet
                </tr>
                @endif
               
              </tbody>
            </table>
          </div>
        </section>

        <section id="inviteForm" class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">Invite user</h2>
            <span class="text-sm text-slate-500">Sends email (demo)</span>
          </div>
          @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
          @endif
          <form class="grid md:grid-cols-2 gap-4" id="inviteUser">
            <label class="space-y-2">
              <span class="text-sm text-slate-700">Name</span>
              <input class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" required name="name" placeholder="Full name" />
            </label>
            <label class="space-y-2">
              <span class="text-sm text-slate-700">Email</span>
              <input class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" required name="email" placeholder="user@example.com" type="email" />
            </label>
            <label class="space-y-2 md:col-span-2">
              <span class="text-sm text-slate-700">Role</span>
              <select class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required name="role">
                @foreach(all_roles() as $key => $role)
                <option value="{{ $key }}">{{ $role }}</option>
                @endforeach
              </select>
            </label>
            @csrf
            <div class="flex items-center gap-3 md:col-span-2">
              <button class="px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-semibold" type="submit">Send invite</button>
              <p class="text-sm text-emerald-600" id="inviteHint" role="status" aria-live="polite"></p>
            </div>
          </form>
        </section>
</x-admin-layout>
