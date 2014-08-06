/**
 * Created by fernandocchaves on 06/06/14.
 */

window.returntrigger = undefined;
window.timerreturntrigger = undefined;
$(document).ready(function(){
   $('table td a.delete').click(function(e){
       abreConfirm("Deseja relamente excluir este registro?", 'link', $(this));
       return false;
   });

    $('#form-list button.delete').click(function(){
        if($('.checkbox-single input:checked').size() > 0) {
            abreConfirm("Deseja relamente excluir todos os registros selecionados?", 'form', $('#form-list'));
            $('.modal-footer button[data-bb-handler="Excluir"]').show();
        } else {
            abreConfirm("Você precisa marcar ao menos um registro para excluir.", 'form', '');
            $('.modal-footer button[data-bb-handler="Excluir"]').hide();
        }
        return false;
    });

    $('#delete_record button.delete').click(function(){
        abreConfirm("Deseja relamente excluir este registro?", 'form', $('#delete_record'));
        return false;
    });

    if ($('.select2-offscreen').length) { $('.select2-offscreen').select2(); }
    if ($('textarea.summernote').size() > 0) {
        
        $('textarea.summernote').summernote({
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol']],
          ['table', ['table']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview']]
        ],
        locale: 'pt-BR'
      });
    }


});

function abreConfirm(message, type, element){
    bootbox.dialog({
        message: message,
        title: "Excluir",
        onEscape: function() {},
        show: true,
        backdrop: true,
        closeButton: true,
        animate: true,
        className: "delete-modal",
        buttons: {
            success: {
                label: "Cancelar",
                className: "btn-default",
                callback: function() {

                }
            },
            "Excluir": {
                className: "btn-danger",
                callback: function() {
                    if(type == 'link'){
                        window.location.href = element.attr('href');
                    }else if(type == 'form'){
                        element.submit();
                    }
                }
            }
        }
    });
}