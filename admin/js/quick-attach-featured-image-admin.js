(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	var mediaUploader;
	
	var postID;

	var uploadButton;
	
	$('.upload-image-button').click(function(e) {
		
		uploadButton = $(e.target);

		// postID = uploadButton.prev('input.post-id').val();
		
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

			console.log(uploadButton);
						
			console.log(attachment);

			// set preview in the wrapper
			uploadButton.parent().find(".featured-image").attr("src", attachment.sizes.thumbnail.url);
			// uploadButton.parent().find(".featured-image").attr("src", "https://images.unsplash.com/photo-1587613754067-13e9a170b42f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60");
			uploadButton.parent().find(".update_attachment_form > .attachment_id").val(attachment.id);
			uploadButton.parent().find('.save-btn').removeClass("d-none");
		});
			
		mediaUploader.open();
	});

	// $('.save-btn').click(function (e) {
	// 	e.preventDefault();
	// 	$(e.target).parent().find('.update_attachment_form').submit();
	// });

	$('.adv-table').DataTable();


})( jQuery );
