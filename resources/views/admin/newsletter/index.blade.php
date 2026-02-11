<x-admin-layout title="Newsletter Subscribers">
    <header class="flex flex-wrap items-center gap-4 justify-between">
        <div>
            <p class="text-sm text-slate-500">Marketing</p>
            <h1 class="text-2xl font-semibold text-slate-900">Newsletter Subscribers</h1>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm text-slate-500">{{ $subscribers->total() }} subscribers</span>
        </div>
    </header>

    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-500">
                    <tr class="text-left">
                        <th class="py-2 font-medium">Email</th>
                        <th class="py-2 font-medium">Status</th>
                        <th class="py-2 font-medium">Subscribed At</th>
                        <th class="py-2 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($subscribers as $subscriber)
                    <tr>
                        <td class="py-2 text-slate-900">{{ $subscriber->email }}</td>
                        <td class="py-2">
                            @if($subscriber->is_active)
                                <span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-medium">Active</span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">Inactive</span>
                            @endif
                        </td>
                        <td class="py-2 text-slate-600">{{ $subscriber->created_at->format('M d, Y H:i') }}</td>
                        <td class="py-2 space-x-2">
                            <form action="{{ route('newsletter.destroy', $subscriber->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this subscriber?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-slate-500">No subscribers found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $subscribers->links() }}
        </div>
    </section>
</x-admin-layout>
