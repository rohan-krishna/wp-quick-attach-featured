jQuery(document).ready(function($) {

	$('.adv-table').DataTable();
	
	var mediaUploader;
	
	var postID;
	
	$('.upload-image-button').click(function(e) {
		
		var uploadButton = $(e.target);
		postID = uploadButton.prev('input.post-id').val();
		
		e.preventDefault();

		if (mediaUploader) {
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			}, 
			multiple: false,

		});
			
		mediaUploader.on('select', function() {
			
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			
			console.log(postID);
			
			console.log(attachment);

			// set preview in the wrapper
			uploadButton.parent().find(".featured-image-wrapper").attr("src", attachment.sizes.thumbnail.url);
			uploadButton.parent().find(".update_attachment_form > .attachment_id").val(attachment.id);

			uploadButton.parent().find('.update_attachment_form > .save-btn').removeClass("hidden");
			
		});
			
		mediaUploader.open();
	});
});
	