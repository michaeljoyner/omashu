<script>
    $('#confirm-delete-modal').on('show.bs.modal', function(e) {
        $(this).find('.delete-form').attr('action', $(e.relatedTarget).data('action'));
        $(this).find('.users-name').html($(e.relatedTarget).data('usersname'));
    });
</script>