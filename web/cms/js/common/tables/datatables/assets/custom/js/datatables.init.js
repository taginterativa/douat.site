var gerado = false;
(function($, window)
{
	$(window).on('load', function()
	{
		function fnInitCompleteCallback(that)
		{
			var p = that.parents('.dataTables_wrapper').first();
	    	var l = p.find('.row').find('label');

	    	l.each(function(index, el) {
	    		var iw = $("<div>").addClass('col-md-8').appendTo($(el).parent());
	    		$(el).parent().addClass('form-group margin-none').parent().addClass('form-horizontal');
	            $(el).find('input, select').addClass('form-control').removeAttr('size').appendTo(iw);
	            $(el).addClass('col-md-4 control-label');
	    	});

	    	var s = p.find('select');
	    	s.addClass('.selectpicker').selectpicker();
		}

		/* DataTables */
		if ($('#form-list').size() > 0 && $('.dynamicTable').size() > 0 && gerado == false)
		{
            gerado = true;
			$('.dynamicTable').each(function()
			{
                if ($(this).is('.ajax'))
                {
                    var tableAjaxUrl = $(this).attr('rel');
                    $(this).dataTable().fnDestroy();
                    $(this).dataTable({
                        "sPaginationType": "bootstrap",
                        "sDom": "<'row separator bottom'<'col-md-5'T><'col-md-3'l><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                        "oLanguage": {
                            "sLengthMenu": "_MENU_ Mostrar"
                        },
                        "processing": true,
                        "serverSide": true,
                        "ajax": rootPath + tableAjaxUrl,
                        "sScrollX": "100%",
                        "sScrollXInner": "100%",
                        "bScrollCollapse": true,
                        "fnInitComplete": function () {
                            fnInitCompleteCallback(this);
                        }
                    });
                }
				// DataTables with TableTools
				else if ($(this).is('.tableTools'))
				{
					$(this).dataTable().fnDestroy();

					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"sDom": "<'row separator bottom'<'col-md-5'T><'col-md-3'l><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ Mostrar"
						},
						"oTableTools": {
							"sSwfPath": componentsPath + "common/tables/datatables/assets/lib/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
					    },
					    "aoColumnDefs": [
				          { 'bSortable': false, 'aTargets': [ 0 ] }
				       	],
				       	"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
					    "fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
				// colVis extras initialization
				else if ($(this).is('.colVis'))
				{
					$(this).dataTable().fnDestroy();
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"sDom": "<'row separator bottom'<'col-md-3'f><'col-md-3'l><'col-md-6'C>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ por página"
						},
						"oColVis": {
							"buttonText": "Mostrat / Esconder campos",
							"sAlign": "right"
						},
						"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
						"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
				else if ($(this).is('.scrollVertical'))
				{
					$(this).dataTable().fnDestroy();
					$(this).dataTable({
						"bPaginate": false,
						"sScrollY": "200px",
						"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"sDom": "<'row separator bottom'<'col-md-12'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
				else if ($(this).is('.fixedHeaderColReorder'))
				{
					$(this).dataTable().fnDestroy();
					$(this).dataTable({
						"sPaginationType": "bootstrap",
				       	"sDom": "R<'clear'><'row separator bottom'<'col-md-12'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				       	"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
					    	var t = this;
					    	setTimeout(function(){
					    		new FixedHeader( t );
					    	}, 1000);
				        }
					});
				}
				// default initialization
				else
				{
					$(this).dataTable().fnDestroy();
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"sDom": "<'row separator bottom'<'col-md-5'T><'col-md-3'l><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
						"oLanguage": {
							"sLengthMenu": "_MENU_ por página"
						},
						"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
			});
		}
	});

})(jQuery, window);