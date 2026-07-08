<div>
    {{ html()->label(__('strings.name'))->for('name')->class('form-label') }}
    {{ html()->input('text', 'name', $name)->class('form-input max-w-md') }}
    @error('name')
        <div class="form-error">{{ $message }}</div>
    @enderror
</div>
