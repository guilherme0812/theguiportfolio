
<section class="cardapio">
        <div class="modal fade" id="modalcardapio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CARDÁPIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="bg-warning">
                            <tr>
                                <th>#</th>
                                <th>Sabores</th>
                                <th>Ingredientes</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while($linha = mysqli_fetch_assoc($sabores) ){ ?>

                            <tr>
                                <th><?php echo utf8_encode($linha["saborID"]); ?></th>
                                <td><?php echo utf8_encode($linha["nomesabor"]); ?></td>
                                <td><?php echo utf8_encode($linha["ingredientes"]); ?></td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar;</button>
                </div>
            </div>
        </div>
    </section>