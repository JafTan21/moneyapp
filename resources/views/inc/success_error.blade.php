<div>
    @if ($success || $error)
    @if ($success)
    <div class="alert alert-success">
        {{ $success }}
    </div>
    @endif

    @if ($error)
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endif
    @endif
</div>