<div>
    <div style="position: absolute; top: 0; right: 0; z-index: 1">
        <div class="toast" role="alert" data-delay="7000" style="min-width: 300px; max-width: 300px;">
            <div class="toast-header" style="background-color: var(--yellow); color: var(--brown);">
                <strong class="mr-auto">Notificação</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" style="color: var(--brown);">&times;</button>
            </div>
            <div class="toast-body" style="background-color: var(--white); color: var(--dark);">
                {{ session()->get('message') }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('.toast').toast('show');
        });
    </script>
@endpush