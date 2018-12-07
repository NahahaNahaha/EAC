<script>
$(document).ready(function() {
	$('#item-info-modal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var recipient = button.data('whatever'); // Extract info from data-* attributes
		  var modal = $(this);
		  modal.find('.modal-title').text('New message to ' + recipient);
		  modal.find('.modal-body input').val(recipient);
	});
});
</script>