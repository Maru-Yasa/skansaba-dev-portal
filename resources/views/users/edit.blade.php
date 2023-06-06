<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Edit User") }}
                </div>
                <div class="p-6">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('users.update', $data->id) }}">
                        @csrf
                        @method('put')
                        <div class="form-control mb-3">
                            <div>
                                <x-input-label for="title" :value="__('Name')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="name" :value="$data->name" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-control mb-3">
                            <div>
                                <x-input-label for="author" :value="__('Email')" />
                                <x-text-input id="author" class="block mt-1 w-full" type="email" name="email" :value="$data->email" required autofocus autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-control mb-3">
                            <div>
                                <x-input-label for="author" :value="__('Password')" />
                                <x-text-input id="author" class="block mt-1 w-full" type="text" name="password" :value="old('password')" autofocus autocomplete="" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-control mb-3 flex flex-row gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-error">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const inputImage = document.getElementById('imagesInput')
        const outputImage = document.getElementById('outputImage')
        inputImage.addEventListener('change', () => {
            let images = []
            for (let i = 0; i < inputImage.files.length; i++) {
                images.push(inputImage.files[i])
            }
            displayImages(images)
        })

        function displayImages(images) {
            let imageComponent = '';
            images.forEach((image, index) => {
                imageComponent += `
                <div class="image">
                    <div class="w-32 rounded indicator">
                        <img src="${URL.createObjectURL(image)}" alt="">
                    </div>
                </div>
                `
            });
            outputImage.innerHTML = imageComponent
        }

        function deleteImage(index) {
            images.splice(index, 1)
            displayImages()
        }

    </script>
</x-app-layout>
