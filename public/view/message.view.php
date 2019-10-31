<div id="conversations" class="container">
    <div id="conversation-box" class="row">
        <div id="conversation-list" class="col-lg-4 col-md-4 col-12 bg-primary text-white">

        </div>
        <div id="msg-column" class="col-lg-8 col-md-8 col-12">
            <div id="message-list">

            </div>
            <div id="envoyer-message" class="form-group">
                <label for="reponse" class="d-none">Envoyer un message</label>
                <input type="text" id="reponse" class="form-control" placeholder="Envoyer un message..." />
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const convList = $('#conversation-list');
    const messageList = $('#message-list');
    let msg = <?php echo json_encode($conversations); ?>;

    function addConversation(conv, id) {
        convList.html(convList.html() + `<div class="conversation" data-id="${id}">${conv}</div>`)
    }

    function addMessage(msg) {
        const classes = (msg.emetteurUtilisateur.id === "<?= $_SESSION['id'] ?>") ? 'self' : 'bg-secondary';
        messageList.html(messageList.html() + `<div class="message"><span class="${classes}">${msg.contenu}</span></div>`);
    }

    function viderMessages() {
        messageList.html('');
    }

    function afficherMessages(msg) {
        Object.keys(msg).forEach(function(elem) {
            let conversation = msg[elem];
            addConversation(conversation.correspondant, elem);

        });

        afficherConversation(msg[Object.keys(msg)[0]]);
    }

    function afficherConversation(conversation) {
        conversation.messages.forEach(function(message) {
            addMessage(message);
        });

        messageList.scrollTop(messageList[0].scrollHeight);

        $.post('/api/lireMessage.api.php', {
            nom: conversation.correspondant,
            date: conversation.messages[conversation.messages.length - 1].date
        });
    }

    function majMessages() {
        $.get('/api/recupererMessages.api.php', [], function(data) {
            data = JSON.parse(data);
            if (data.code === 200) {
                msg = data.message;
                viderMessages();
                afficherConversation(msg[$('#conversation-list .conversation.active').attr('data-id')]);
            }
        })
    }

    afficherMessages(msg);
    $('#conversation-list .conversation:first-child').addClass('active');

    $(document).on('click', '#conversation-list .conversation', function(e) {
        const newConv = $(e.target);
        viderMessages();
        afficherConversation(msg[newConv.attr('data-id')]);

        $('#conversation-list .conversation.active').removeClass('active');
        newConv.addClass('active');
    });

    $(document).on('keypress', '#envoyer-message input', function(e) {
        if (e.which === 13) {
            const input = $(e.target);
            const contenu = input.val();
            input.val('');
            $.post('/api/envoyerMessage.api.php', {
                id: $('#conversation-list .conversation.active').attr('data-id'),
                message: contenu
            }, function(data) {
                data = JSON.parse(data);
                if (data.code === 200) {
                    majMessages();
                }
            });
        }
    });

    // Calcul de la hauteur disponible pour la boîte de messages privés
    const hauteurTotale = $('body').height();
    const header = $('header');
    const hauteurHeader = header.height() + Number(header.css('padding-top').replace('px', '')) * 2;
    const hauteurConversations = hauteurTotale - hauteurHeader;
    $('#conversations').css('height', `${hauteurConversations}px`);

    // Centrage de la boîte de messages privés
    const boiteConversation = $('#conversation-box');
    const hauteurUtilisee = boiteConversation.height();
    boiteConversation.css('padding-top', (hauteurConversations - hauteurUtilisee) / 2);

    // Hauteur pour que le scroll se fasse
    convList.css('height', hauteurUtilisee);
    messageList.css('height', hauteurUtilisee - $('#envoyer-message').height() - $('#msg-column').css('padding-top').replace('px', ''));

    setInterval(majMessages, 10000);
    messageList.scrollTop(messageList[0].scrollHeight); // Nécessaire pour le scroll au premier chargement de la page
</script>
