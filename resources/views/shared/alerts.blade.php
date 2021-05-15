@if(session()->has('successMessage'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session()->get('successMessage') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('errorMessage'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session()->get('errorMessage') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
