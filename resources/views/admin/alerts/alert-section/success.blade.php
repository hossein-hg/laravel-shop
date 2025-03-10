@if(session('alert-section-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h6 class="alert-heading"> موفق </h6>
        <hr>
        <p class="mb-0">
            {{session('alert-section-success')}}
        </p>
        <button type="button" style="right: auto!important;left: 0!important;" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
