<div class="wrap">
    <h1><?php _e( 'Adicionar Família', 'designfaustini' ); ?></h1>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                <tr class="row-nome-pai">
                    <th scope="row">
                        <label for="nome_pai"><?php _e( 'Pai Up Down', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="nome_pai" id="nome_pai" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-nome-mae">
                    <th scope="row">
                        <label for="nome_mae"><?php _e( 'Mãe Up Down', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="nome_mae" id="nome_mae" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-nome-updown">
                    <th scope="row">
                        <label for="nome_updown"><?php _e( 'Filho(a) Up Down', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="nome_updown" id="nome_updown" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-qtd-irmao">
                    <th scope="row">
                        <label for="qtd_irmao"><?php _e( 'Qtd. de irmão(s)', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="qtd_irmao" id="qtd_irmao" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" />
                    </td>
                </tr>
                <tr class="row-end">
                    <th scope="row">
                        <label for="end"><?php _e( 'Endereço', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <textarea name="end" id="end"placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" rows="5" cols="30" required="required"></textarea>
                    </td>
                </tr>
                <tr class="row-cep">
                    <th scope="row">
                        <label for="cep"><?php _e( 'CEP', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="cep" id="cep" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-cidade">
                    <th scope="row">
                        <label for="cidade"><?php _e( 'Cidade', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="cidade" id="cidade" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-uf">
                    <th scope="row">
                        <label for="uf"><?php _e( 'Estdao', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="uf" id="uf" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-pais">
                    <th scope="row">
                        <label for="pais"><?php _e( 'País', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="pais" id="pais" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-telefone">
                    <th scope="row">
                        <label for="telefone"><?php _e( 'Telefone', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="telefone" id="telefone" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-email">
                    <th scope="row">
                        <label for="email"><?php _e( 'E-mail', 'designfaustini' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="email" id="email" class="regular-text" placeholder="<?php echo esc_attr( '', 'designfaustini' ); ?>" value="" required="required" />
                    </td>
                </tr>
             </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'familia-new' ); ?>
        <?php submit_button( __( 'Adicionar Família', 'designfaustini' ), 'primary', 'submit_familia' ); ?>

    </form>
</div>