{{-- @if($errors != '[]')
    @foreach($errors->all() as $error)
        <div class="alert alert-dismissable text-center alert-danger">
            {!!$errors!!}
        </div>
    @endforeach
@endif --}}

@if ($errors->any())
    <div class="alert alert-danger text-center fade show alert-dismissible pb-0">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="list-unstyled">{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- @if(!empty($errors->()))
    <div class="row col-lg-12">
        <div class="alert alert-danger">
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif --}}

@if (isset($success))
    <div class="alert alert-success text-center fade show alert-dismissible p-0">
        <ul>
            
                <li class="list-unstyled">{{ $success}}</li>
            
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if(session('error'))
    <div class="alert  text-center fade show alert-dismissible alert-danger">
        {!!session('error')!!}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
@endif

@if(session('success'))
    <div class="alert text-center fade show alert-dismissible alert-success">
        {{session('success')}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
@endif