<div id="message-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Envoyer un message</h5>
      </div>
      <div class="modal-body">
        <textarea id="textarea-modale"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button id="envoyer-message-modale" type="button" class="btn btn-primary">Envoyer</button>
      </div>
    </div>
  </div>
</div>

<script>
    let idContact = 0;
    $(document).on('click', '.contacter', function(e) {
        idContact = $(e.target).attr('data-id');
        $('#message-modal').modal();
    });

    $(document).on('click', '#envoyer-message-modale', function(e) {
        $.post('/api/envoyerMessage.api.php', {
            id: idContact,
            message: $('#textarea-modale').val()
        });
        $('#message-modal').modal('hide');
    });

    $('#message-modal').on('hidden.bs.modal', function(e) {
        $('#textarea-modale').val('');
    })
</script>
