$(function() {
    $(document).on('click', '.showModalButton', function() {
        $('#modal-universe .modal-dialog').addClass($(this).attr('size'));
        $('#modal-universe').find('#modalContent').html('');
        $('#modal-universe').find('#modalContent').html("<div id='modalContent'><div style='text-align:center'><img src='../img/loader.gif'></div></div>");
        $('#modal-universe-label').html($(this).attr('title'));
        
        if ($('#modal-universe').data('bs.modal')?._isShown) {
            $('#modal-universe').find('#modalContent').load($(this).attr('value'));
        } else {
            $('#modal-universe').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'), function(response, status, xhr) {
                    if (status == "error") {
                        $('#modal-universe .modal-dialog').addClass('modal-xl');
                        var msg = 'An error was encountered while processing your request. ';
                        if (xhr.status == 403) msg = 'Anda tidak diizinkan untuk mengakses fitur ini. ';
                        $('#modalContent').html('<div class="alert bg-light pb-0"><div class="mt-2 mb-6 alert alert-custom alert-light-danger border-light-danger"><big><b class="alert-text">'+xhr.status + '</b> ' + xhr.statusText +'</big> <br><span class="text-muted">'+msg+'</span></div><div class="p-2">'
                            +response+
                        '</div></div>'
                            +'<div><button type="button" class="btn btn-secondary float-right" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button></div>'+
                        '' );
                    }
                }
            );
        }
    });
});