<div class="grid col-span-full">
    <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ $title }}</h1>

    <div>
        {{ html()->modelForm($model, $method, $action)->open() }}
            @include($formPartial, $formData)

            <div class="mt-2">
                {{ html()->submit($submitLabel)->class('rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700') }}
            </div>
        {{ html()->closeModelForm() }}
    </div>
</div>
