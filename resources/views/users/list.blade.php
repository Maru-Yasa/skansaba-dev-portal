<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (Session::has('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="alert alert-success shadow-sm ">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <span>{{ Session::get('success') }}</span>
                </div>
            </div>
        </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-3">Add user</a>
                    <div class="overflow-x-auto">
                        <table id="table" class="table table-zebra w-full p-4">
                          <!-- head -->
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($data as $user)

                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $user->name }} {{ Auth::user()->email == $user->email ? '(You)':'' }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="flex gap-2 justify-center">
                                    <a href="{{ Auth::user()->email == $user->email ? route('profile.edit') : route('users.edit', $user->id)  }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        @if (Auth::user()->email != $user->email)
                                            <button class="btn btn-error btn-sm">Delete</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                          </tbody>
                        </table>
                        {{ $data->links() }}
                      </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
</x-app-layout>
