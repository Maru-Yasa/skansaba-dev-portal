<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Add new Project") }}
                </div>
                <div class="p-6">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('project.store') }}">
                        @csrf
                        <div class="form-control mb-3">
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-control mb-3">
                            <div>
                                <x-input-label for="title" :value="__('Link')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="link" :value="old('link')" required autofocus autocomplete="link" />
                                <x-input-error :messages="$errors->get('link')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-control mb-3">
                            <div>
                                <x-input-label for="author" :value="__('Author')" />
                                <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required autofocus autocomplete="author" />
                                <x-input-error :messages="$errors->get('author')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-control mb-3">
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-area :rows='7' id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-control mb-3">
                            <input id="imagesInput" name="images[]" class="file-input file-input-primary w-full max-w-xs" type="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg">
                            <div id="outputImage" class="flex gap-3 p-3 border rounded w-full mt-3 justify-start items-center overflow-auto">
                            </div>
                        </div>
                        <div class="form-control mb-3 flex flex-row gap-2">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('project.index') }}" class="btn btn-error">Back</a>
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
