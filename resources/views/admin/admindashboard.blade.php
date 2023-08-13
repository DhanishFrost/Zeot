<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Users</h1>

                <div x-data="{ openCreateUserPopup: false }">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block" x-on:click.prevent="openCreateUserPopup = true">Add User</a>
                    <!-- Popup -->
                    <div x-show="openCreateUserPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                       <div @click.away="openCreateUserPopup = false" class="bg-white max-w-lg mx-auto rounded shadow-lg p-6">
                          <div class="popup-content">
                             <h2 class="text-lg font-bold mb-4">Add User</h2>
                             <form @submit.prevent="submitCreateUserForm" action="{{ route('admin.users.store') }}" method="POST">
                                <div>
                                   <label for="name">Name:</label>
                                   <input type="text" id="name" name="name" class="border border-gray-300 rounded-md p-2" required>
                                </div>
                                <div class="mt-4">
                                   <label for="email">Email:</label>
                                   <input type="email" id="email" name="email" class="border border-gray-300 rounded-md p-2" required>
                                </div>
                                <div class="mt-4">
                                   <label for="password">Password:</label>
                                   <input type="password" id="password" name="password" class="border border-gray-300 rounded-md p-2" required>
                                </div>
                                <div class="mt-4">
                                    <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="openCreateUserPopup = false">Cancel</button>
                                   <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="submitCreateUserForm">Create User</button>
                                </div>
                             </form>
                          </div>
                       </div>
                    </div>
                 
                    <!-- Success message -->
                    @if (session('success'))
                    <div class="bg-green-200 text-green-800 rounded p-4 mb-4">{{ session('success') }}</div>
                    @endif
                 </div>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">
                                @if ($user->role == 1)
                                    Admin
                                @else
                                    User
                                @endif
                            </td>
                            <td class="border px-4 py-2 flex space-x-3">
                                
                                <div class="mt-1" x-data="{ openEditUserPopup: false, user: {{  json_encode($user) }}}">
                                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 rounded" x-on:click.prevent="openEditUserPopup = true;">Edit User</a>
                                <!-- Popup -->
                                <div x-show="openEditUserPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                    <div @click.away="openEditUserPopup = false" class="bg-white max-w-lg mx-auto rounded shadow-lg p-6">
                                        <div class="popup-content">
                                         <h2 class="text-lg font-bold mb-4">Edit User</h2>
                                         <form @submit.prevent="updateEditUserPopup({{ $user->id }})" action="{{ route('update.user') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" :value="user.id">
                                            <div>
                                               <label for="editUserName">Name:</label>
                                               <input type="text" :id="'editUserName-' + user.id" :name="'editUserName-' + user.id" :value="user.name" class="border border-gray-300 rounded-md p-2">
                                            </div>
                                            <div class="mt-4">
                                               <label for="editUserEmail">Email:</label>
                                               <input type="email" :id="'editUserEmail-' + user.id" :name="'editUserEmail-' + user.id" :value="user.email" class="border border-gray-300 rounded-md p-2">
                                            </div>
                                           
                                            <div class="mt-4">
                                                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" @click="openEditUserPopup = false">Cancel</button>
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Update User</button>
                                            </div>
                                         </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
