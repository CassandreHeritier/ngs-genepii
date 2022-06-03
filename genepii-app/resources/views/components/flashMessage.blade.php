@if (Session::has('success'))
    <div class="toast-container position-fixed p-3" style="z-index: 11; top: 5px; right: 60px;">
        <div id="liveToast" class="toast hide bg-light bg-gradient" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Message</strong>
                <small>Il y a un instant</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
@elseif (Session::has('error'))
    {{ Session::get('error') }})
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif