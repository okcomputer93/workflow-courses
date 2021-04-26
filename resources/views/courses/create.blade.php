<x-layout>
    <x-slot name="head">
        <title>Workflow | Upload a Course</title>
    </x-slot>
    <x-section type="base">
        <div class="flex items-center justify-center">
            <x-form.form method="post" action="/courses" logo="false" class="max-w-lg">
                <x-slot name="title">
                    Upload a new video course
                </x-slot>
                <x-form.input type="text" name="title">Title</x-form.input>
                <x-form.input type="url" name="video_url">Video Url</x-form.input>
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
