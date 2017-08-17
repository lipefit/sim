<div class="modal dark_bg fade" id="mensagem_conteudo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo comentário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="mensagem" class="form-control-label">Comentário:</label>
                        <textarea class="form-control" id="message-text-conteudo" name="mensagem"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="message-button-conteudo">Salvar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#message-button-conteudo').click(function () {
        var message = $("#message-text-conteudo").val();
        $.get('/conteudos/saveMessage?mensagem=' + message + '&conteudo_id=<?= $conteudo->id; ?>&profile_id=<?=$profile['id'];?>', function (data) {
            location.reload();
        });
    });
</script>