<x-layout>
    <x-slot name="head">
        <title>Workflow | Editando {{ $course->title }}</title>
    </x-slot>
    <x-section type="base">
        <div class="flex items-center justify-center">

            <x-form.form method="patch"
                         enctype="true"
                         action="{{ $course->path() }}"
                         logo="false"
                         class="max-w-lg"
            >

                <x-slot name="title">
                    Editando Video Curso
                </x-slot>

                <x-form.input type="text"
                              name="title"
                              value="{{ $course->title }}"
                >
                    Title
                </x-form.input>

                <x-form.input type="url"
                              name="video_url"
                              value="{{ $course->video_url }}"
                >
                    Video Url
                </x-form.input>

                <x-form.select :items="$categories"
                               value="{{ $course->category->id }}"
                               name="category_id"
                ></x-form.select>

                <x-form.select :items="$levels"
                               value="{{ $course->level->id }}"
                               name="level_id"
                ></x-form.select>

                <x-form.textarea type="text"
                                 name="description"
                                 value="{{ $course->description }}"
                >
                    Description
                </x-form.textarea>

                <img class="inline-block p-3 border border-gray-300"
                     src="{{ asset($course->miniature) }}"
                     alt="{{ $course->title . "'s miniature" }}"
                >

                <div>
                    <x-form.input type="file"
                                  name="miniature"
                    >
                        Miniature
                    </x-form.input>
                </div>

                <x-form.button>
                    Listo
                    <x-slot name="icon">
                        <x-icon.upload></x-icon.upload>
                    </x-slot>
                </x-form.button>

            </x-form.form>
        </div>
    </x-section>
</x-layout>
