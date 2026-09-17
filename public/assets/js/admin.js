$(function(){
    var i18n = window.adminI18n || {
        loading: 'Loading…',
        failedLoad: 'Failed to load form.',
        updateFailed: 'Update failed.',
        deleteConfirm: 'Delete this image?',
        deleteFailed: 'Failed to delete image.'
    };

    // Set CSRF header for all AJAX
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content') }
    });

    // Mobile sidebar toggle
    $('.admin-sidebar-toggle').on('click', function(){
        $('.admin-shell').toggleClass('sidebar-open');
    });

    // Open edit modal and load form
    $(document).on('click', '.img-edit-btn', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#adminModalBody').html('<div class="text-center p-4">' + i18n.loading + '</div>');

        // show only the section row that contains this image to focus the admin view
        try{
            var section = $('#img-card-' + id).data('section');
            if(section){
                $('div[id^="section-"]').hide();
                $('div[id^="section-"]').each(function(){ $(this).prev('h5').hide(); });
                var $targetRow = $('#section-' + section + '-row');
                $targetRow.show();
                $targetRow.prev('h5').show();
            }
        }catch(ex){ /* ignore if DOM not structured as expected */ }

        $('#adminModal').modal('show');
        $.get('/admin/images/'+id+'/edit', function(html){
            $('#adminModalBody').html(html);
        }).fail(function(){
            $('#adminModalBody').html('<div class="alert alert-danger">' + i18n.failedLoad + '</div>');
        });
    });

    // restore section rows when modal closes
    $('#adminModal').on('hidden.bs.modal', function(){
        $('div[id^="section-"]').show();
        $('div[id^="section-"]').each(function(){ $(this).prev('h5').show(); });
        $('#adminModalBody').html('');
    });

    // Submit edit form via AJAX (delegated because form is loaded dynamically)
    $(document).on('submit', '#image-edit-form', function(e){
        e.preventDefault();
        var $form = $(this);
        var action = $form.attr('action');
        var method = $form.find('input[name=_method]').val() || 'POST';
        var formData = new FormData(this);
        $.ajax({
            url: action,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                if(res && res.success){
                    var id = res.id;
                    var newSection = res.section;
                    var cardHtml = res.card_html;
                    var $old = $('#img-card-' + id);
                    if($old.length){
                        $old.replaceWith(cardHtml);
                    } else {
                        var $row = $('#section-' + newSection + '-row');
                        if($row.length){
                            $row.prepend(cardHtml);
                        } else {
                            location.reload();
                        }
                    }
                    $('#adminModal').modal('hide');
                } else {
                    var msg = (res && res.message) ? res.message : i18n.updateFailed;
                    alert(msg);
                }
            },
            error: function(xhr){
                var msg = i18n.updateFailed;
                if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                alert(msg);
            }
        });
    });

    // Delete image via AJAX
    $(document).on('click', '.img-delete-btn', function(e){
        e.preventDefault();
        if(!confirm(i18n.deleteConfirm)) return;
        var id = $(this).data('id');
        $.ajax({
            url: '/admin/images/'+id,
            type: 'POST',
            data: { _method: 'DELETE' },
            success: function(){
                $('#img-card-'+id).fadeOut(300, function(){ $(this).remove(); });
            },
            error: function(){
                alert(i18n.deleteFailed);
            }
        });
    });
});
