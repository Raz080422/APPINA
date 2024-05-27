// MODAL
function Modal(id, title, body_url, footer, size, height='') {
    if(height==''){
        height = "70vh";
    }
    
    if(footer.length > 0)
        var modal_footer = '<div class="modal-footer"></div>';
    else
        var modal_footer = '';

    modal_dialog(id, '\
        <div class="modal-content">\
            <div class="modal-header" style="border-bottom:none">\
                <span class="modal-title" style="font-size:16px;color:#5b69bc;font-weight:bold"></span>\
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                    <span aria-hidden="true"><span class="fa fa-times"></span></span>\
                </button>\
            </div>\
            <div class="modal-body" style="min-height:'+height+';max-height:'+height+'; overflow-y: auto;">\
                <div id="modal_loading">\
                    <center><img id="input_loading" src="'+base_url+'/loader/facebook.gif" style="height:150px"></center>\
                </div>\
                <div id="modal_body_content" style="display: none"></div>\
            </div>\
            '+modal_footer+'\
        </div>');
    
    ModalTitle(id, title);
    ModalBody(id, body_url);

    if(footer.length > 0) ModalFooter(id, footer);

    ModalSize(id, size);
}

function ModalClose(id)
{
    $('#'+id).modal('hide');
}

function modal_div(id, inner) {
    div = document.createElement("div");
    div.innerHTML = '<div id="' + id + '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">' + inner + '</div>';
    document.body.appendChild(div);
}

function modal_dialog(id, inner) {
    $('#' + id).remove();
    modal_div(id, '<div class="modal-dialog" role="document">' + inner + '</div>');
    
    $('#' + id).modal({
        backdrop: 'static',
        keyboard: false
    });
}

function ModalTitle(id, title)
{   
    $('#'+id).find('.modal-title').html(title);
}

function ModalBody(id, body)
{
    $('#'+id).find('.modal-body').find('#modal_body_content').load(body,
        function () {
            $('#'+id).find('.modal-body').find('#modal_body_content').fadeIn(10);
            $('#'+id).find('.modal-body').find('#modal_loading').hide();
        }
    );
}

function ModalFooter(id, footer)
{
    $('#'+id).find('.modal-footer').html(footer);
}

function ModalSize(id, size)
{
    $('#'+id).find('.modal-dialog').addClass(size);
}

// MODAL