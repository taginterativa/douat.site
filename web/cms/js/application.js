$(window).load(function() {
	$('.note-editable').blur(function() {
		var html = $(this).html();
		console.log(html);
		$(this).parents('.col-sm-12').find('.summernote').html(html);
		//$('#cms_bannerbundle_banner_title').attr('value', html);

	});
});