<x-layout>
    <x-slot name="head">
        <title>Workflow | Upload a Course</title>
    </x-slot>
    <x-section type="base">
        <div class="flex items-center justify-center">
            <x-form.form method="post" enctype="true" action="/courses" logo="true" class="max-w-lg">
                <x-slot name="title">
                    Publicar un nuevo curso
                </x-slot>
                <x-form.input type="text" name="title">Title</x-form.input>
                <x-form.input type="url" name="video_url">Video Url</x-form.input>
                <x-form.select :items="$categories" name="category_id">Selecciona una categoría</x-form.select>
                <x-form.select :items="$levels" name="level_id">Selecciona un nivel</x-form.select>
                <div>
                    <x-form.input type="file" name="miniature">Miniature</x-form.input>
                </div>
                <x-form.textarea type="text" name="description">Description</x-form.textarea>
                <x-form.button>
                    Upload
                    <x-slot name="icon">
                        <x-icon.upload></x-icon.upload>
                    </x-slot>
                </x-form.button>
            </x-form.form>
        </div>
    </x-section>
</x-layout>
