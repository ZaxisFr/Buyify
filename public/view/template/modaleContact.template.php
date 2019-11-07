<div id="message-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Envoyer un message</h5>
      </div>
      <div class="modal-body">
        <?php if (Utilisateur::isConnecte()): ?>
            <textarea id="textarea-modale"></textarea>
        <?php else: ?>
            <h5 class="modal-title">Vous ne pouvez pas envoyer de messages si vous n'êtes pas connécté</h5>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <?php if (Utilisateur::isConnecte()): ?>
            <button id="envoyer-message-modale" type="button" class="btn btn-primary">Envoyer</button>
        <?php else: ?>
            <a href="connexion.ctrl.php"><button class="btn btn-primary">Connexion</button></a>
        <?php endif; ?>
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
