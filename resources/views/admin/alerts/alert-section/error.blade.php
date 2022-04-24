@if(session('alert-section-error'))

    <div class="alert alert-danger alert-dismissible fade show " role="alert">
        <h4 class="alert-heading">&times;خطا </h4>
        <hr>
        <p class="mb-0">
            {{session('alert-section-error')}}
        </p>
        <button type="button" style="right: auto !important; left: 0 !important;" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif
