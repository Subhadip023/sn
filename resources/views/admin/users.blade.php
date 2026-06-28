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
                  <td class="py-2 text-slate-600 {{$user->email_verified_at ? 'text-emerald-600' : 'text-red-600'}} ">{{ $user->email }}</td>
                  <td class="py-2 text-slate-600">{{ all_roles()[$user->role] }}</td>
                  <td class="py-2"><span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-medium">{{$user->status}}</span></td>
                  <td class="py-2 space-x-3">
                    <button class="text-blue-600 hover:text-blue-700 font-semibold edit-user-btn"
                      data-id="{{ $user->id }}"
                      data-name="{{ $user->name }}"
                      data-email="{{ $user->email }}"
                      data-role="{{ $user->role }}"
                      data-verified="{{ $user->email_verified_at ? 'true' : 'false' }}">
                      Edit
                    </button>
                    @if(auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Delete</button>
                    </form>
                    @else
                    <span class="text-slate-400 text-xs">Self</span>
                    @endif
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
          <form action="{{ route('admin.users.invite') }}" method="POST" class="grid md:grid-cols-2 gap-4" id="inviteUser">
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

        <!-- Edit User Modal -->
        <div id="editUserModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60">
          <div class="bg-white rounded-xl p-6 w-[500px] border border-slate-200 shadow-lg space-y-4">
            <div class="flex items-center justify-between border-b pb-3">
              <h2 class="text-lg font-semibold text-slate-900">Edit User</h2>
              <button type="button" id="closeEditModal" class="text-slate-400 hover:text-slate-600">
                <i class="fa fa-times"></i>
              </button>
            </div>
            
            <form id="editUserForm" method="POST" class="space-y-4">
              @csrf
              @method('PUT')
              
              <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Name</span>
                <input id="editName" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" required name="name" placeholder="Full name" />
              </label>

              <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Email</span>
                <input id="editEmail" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" required name="email" placeholder="user@example.com" type="email" />
              </label>

              <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Role</span>
                <select id="editRole" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required name="role">
                  @foreach(all_roles() as $key => $role)
                  <option value="{{ $key }}">{{ $role }}</option>
                  @endforeach
                </select>
              </label>

              <label class="flex items-center gap-3 py-2 cursor-pointer">
                <input type="checkbox" id="editVerified" name="verified" value="1" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500" />
                <span class="text-sm font-medium text-slate-700">Mark Email as Verified (Active Status)</span>
              </label>

              <div class="flex justify-end gap-2 border-t pt-3">
                <button type="button" id="cancelEditModal" class="px-4 py-2 border rounded-lg hover:bg-slate-50 text-slate-700 font-semibold">
                  Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-500 text-white rounded-lg font-semibold">
                  Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editUserModal');
            if (editModal) {
              document.body.appendChild(editModal);
            }
            const editForm = document.getElementById('editUserForm');
            const closeBtn = document.getElementById('closeEditModal');
            const cancelBtn = document.getElementById('cancelEditModal');
            
            const editName = document.getElementById('editName');
            const editEmail = document.getElementById('editEmail');
            const editRole = document.getElementById('editRole');
            const editVerified = document.getElementById('editVerified');

            // Open modal and populate data
            document.querySelectorAll('.edit-user-btn').forEach(button => {
              button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const userEmail = this.getAttribute('data-email');
                const userRole = this.getAttribute('data-role');
                const userVerified = this.getAttribute('data-verified') === 'true';

                editForm.action = '/admin/users/' + userId;
                editName.value = userName;
                editEmail.value = userEmail;
                editRole.value = userRole;
                editVerified.checked = userVerified;

                editModal.classList.remove('hidden');
              });
            });

            // Close modal
            function hideModal() {
              editModal.classList.add('hidden');
            }

            if (closeBtn) closeBtn.addEventListener('click', hideModal);
            if (cancelBtn) cancelBtn.addEventListener('click', hideModal);
            
            // Close on background click
            editModal.addEventListener('click', function (e) {
              if (e.target === editModal) {
                hideModal();
              }
            });
          });
        </script>
</x-admin-layout>
