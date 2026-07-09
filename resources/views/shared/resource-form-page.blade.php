<div class="grid col-span-full">
    <h1 class="mb-5 text-4xl md:text-4xl xl:text-5xl">{{ $title }}</h1>

    <div>
        {{ html()->modelForm($model, $method, $action)->open() }}
            @include($formPartial, $formData)

            <div class="mt-2">
                {{ html()->submit($submitLabel)->class('app-button') }}
            </div>
        {{ html()->closeModelForm() }}
    </div>
</div>
