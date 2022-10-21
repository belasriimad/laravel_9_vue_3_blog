<div class="row my-3">
    <div class="col-md-6 mx-auto">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}    
            </div>            
        @endif
        @if (session()->has('danger'))
            <div class="alert alert-danger">
                {{session()->get('danger')}}    
            </div>            
        @endif
        @if (session()->has('info'))
            <div class="alert alert-info">
                {{session()->get('info')}}    
            </div>            
        @endif
        @if (session()->has('warning'))
            <div class="alert alert-warning">
                {{session()->get('warning')}}    
            </div>            
        @endif
    </div>
</div>