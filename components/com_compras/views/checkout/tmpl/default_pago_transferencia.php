<section class="page checkout thanks">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="checkout-thanks">
                    <h1 class="page-title-thanks"><?php echo JText::_('BINNAKLE_GRACIAS_POR_TU_COMPRA');?></h1>
                    <p><?php echo JText::_('BINNAKLE_ENVIAMOS_CORREO');?> </p>
                    <p><?php echo JText::_('BINNAKLE_TU_PEDIDO');?> <?php echo $this->numeroPedido;?></p>
                    <p><a href="./"><?php echo JText::_('BINNAKLE_VOLVER_AL_HOME');?></a></p>
                    <div class="monedas">
                        <img src="/images/thumbnail_croky.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
jQuery(document).ready(function() {
        jQuery("section.footer").addClass('footer-fixed');
});
</script>






