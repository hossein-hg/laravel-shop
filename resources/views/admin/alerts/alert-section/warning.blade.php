@if(session('alert-section-warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">&times; هشدار </h4>
        <hr>
        <p class="mb-0">
            {{session('alert-section-warning')}}
        </p>
        <button type="button" style="right: auto!important;left: 0!important;" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
