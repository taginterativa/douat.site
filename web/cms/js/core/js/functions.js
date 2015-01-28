/**
 * Created by fernandocchaves on 06/06/14.
 */

window.returntrigger = undefined;
window.timerreturntrigger = undefined;

$(document).ready(function() {
    $("#cms_configuracoesbundle_regiao_estado").change(function() {
        $("#s2id_cms_configuracoesbundle_regiao_cidades").find(".select2-search-choice").remove();
        cms_configuracoesbundle_regiao_atualiza_cidades(null);
    });

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

    if($('.img-input').size() > 0) {
        $('.img-input').each(function() {
            var existe = 0;
            var src = $(this).attr('src');
            if(src.indexOf('jpg') > -1) {existe = 1;}
            if(src.indexOf('png') > -1) {existe = 1;}
            if(src.indexOf('gif') > -1) {existe = 1;}
            if(existe == 0) {
                var pdf = $(this).data('pdf');
                $(this).attr('src', pdf);
            }
        });
    }

    cms_configuracoesbundle_regiao_atualiza_cidades($("#cms_regiao_cidades_url").data("entity"));
});

function cms_configuracoesbundle_regiao_atualiza_cidades(regiao) {
    $("#cms_configuracoesbundle_regiao_cidades").empty();

    if($("#cms_configuracoesbundle_regiao_estado").val()) {
        $.ajax({
            url: $("#cms_regiao_cidades_url").data("url"),
            data: { estado: $("#cms_configuracoesbundle_regiao_estado").val(), regiao: regiao },
            type: 'POST',
            success: function(result) {
                $("#cms_configuracoesbundle_regiao_cidades").html(result);
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

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