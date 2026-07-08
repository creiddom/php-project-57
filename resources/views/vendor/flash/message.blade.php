@foreach (session('flash_notification', []) as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @php
            $levelClass = match ($message['level']) {
                'success' => 'flash-alert-success',
                'danger', 'error' => 'flash-alert-danger',
                'warning' => 'flash-alert-warning',
                default => 'flash-alert-info',
            };
        @endphp
        <div class="flash-alert {{ $levelClass }}" role="alert">
            @if ($message['important'])
                <button
                    type="button"
                    class="float-right ml-4 text-lg leading-none opacity-60 transition hover:opacity-100"
                    data-dismiss="alert"
                    aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
