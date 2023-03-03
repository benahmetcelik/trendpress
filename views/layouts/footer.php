<!-- Logout Modal-->
<div class="modal fade" id="cancelBackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">İşlem Başlatıldı</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">İşlem Başlatıldı! Lütfen 10 dakika içinde ikinci isteği göndermeyiniz <br>
            <p>Lütfen sayfadan ayrılmayınız. Yeni sekme ile ürünleri kontrol edebilirsiniz</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <!-- Register buttons -->
    <div class="text-center">
        <p>Copyright &copy; WebKedi 2022</p>
        <a href="https://www.instagram.com/webkedi/" target="_blank" class="btn btn-warning btn-floating mx-1">
            <i class="fab fa-instagram"></i>
        </a>

        <a href="https://webkedi.net/" target="_blank" class="btn btn-success btn-floating mx-1">
            <i class="fab fa-chrome"></i>
        </a>

        <a href="https://www.r10.net/profil/129980-webkedi.html" class="btn btn-danger  btn-floating mx-1">
            <i class="fas fa-star-and-crescent"></i>

        </a>

        <a href="https://github.com/benahmetcelik" target="_blank" class="btn btn-dark btn-floating mx-1">
            <i class="fab fa-github"></i>
        </a>
    </div>

</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>js/demo/chart-area-demo.js"></script>
<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>js/demo/chart-pie-demo.js"></script>
<script src="<?php echo TRENDPRESS_PLUGIN_URİ.'assets/'; ?>js/JSONedtr.js"></script>

<script>
    //Ajax tetiklendiüinde açılacak modal
  //  $('#cancelBackModal').modal('show');
</script>

<script>

    let ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";

    function by_categories(){
        let source_category = $('#source_category').val();
        let commission_type = $('#commission_type').val();
        let commission_amount = $('#commission_amount').val();


        let my_category = $('#my_category option:selected').val();
        let fligran = $('#fligran option:selected').val();
        let spin = $('#spin option:selected').val();
        let publish_status = $('#publish_status option:selected').val();
        let double_spin = $('#double_spin option:selected').val();
        //console.log(source_category);
        var data = {
            'action': 'tp_category_ajax',
            'source_category': source_category,
            'my_category': my_category,
            'fligran':fligran,
            'spin':spin,
            'publish_status':publish_status,
            'double_spin':double_spin,
            'commission_type':commission_type,
            'commission_amount':commission_amount
        };

        $('#cancelBackModal').modal('show');
        jQuery.post(ajaxUrl, data, function(response) {

            console.log(response);
        });

    }

    function by_brands(){
        let source_brand = $('#source_brand').val();
        let commission_type = $('#commission_type').val();
        let commission_amount = $('#commission_amount').val();
        let my_category = $('#my_category option:selected').val();
        let fligran = $('#fligran option:selected').val();
        let spin = $('#spin option:selected').val();
        let publish_status = $('#publish_status option:selected').val();
        let double_spin = $('#double_spin option:selected').val();
        //console.log(source_category);
        var data = {
            'action': 'tp_brand_ajax',
            'source_brand': source_brand,
            'my_category': my_category,
            'fligran':fligran,
            'spin':spin,
            'publish_status':publish_status,
            'double_spin':double_spin,
            'commission_type':commission_type,
            'commission_amount':commission_amount
        };

        $('#cancelBackModal').modal('show');
        jQuery.post(ajaxUrl, data, function(response) {

            console.log(response);
        });

    }

    function by_seller(){
        let seller_id = $('#seller_id').val();
        let commission_type = $('#commission_type').val();
        let commission_amount = $('#commission_amount').val();
        let my_category = $('#my_category option:selected').val();
        let fligran = $('#fligran option:selected').val();
        let spin = $('#spin option:selected').val();
        let publish_status = $('#publish_status option:selected').val();
        let double_spin = $('#double_spin option:selected').val();
        //console.log(source_category);
        var data = {
            'action': 'tp_seller_ajax',
            'seller_id': seller_id,
            'my_category': my_category,
            'fligran':fligran,
            'spin':spin,
            'publish_status':publish_status,
            'double_spin':double_spin,
            'commission_type':commission_type,
            'commission_amount':commission_amount
        };

        $('#cancelBackModal').modal('show');
        jQuery.post(ajaxUrl, data, function(response) {

            console.log(response);
        });

    }


    var data = `<?php echo file_get_contents(TRENDPRESS_PLUGIN_DIR."assets/spin.json"); ?>`;

    function getDataOnChange( data ){

        console.log('DATA WAS CHANGED', data.getDataString());
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'tp_spin_save',
                file_data: data.getDataString()
            },
            success: function (data) {
                console.log(data);
            }
        });
    }

    new JSONedtr( data, '#output', {
        runFunctionOnUpdate:'getDataOnChange',
        instantChange: true
    });
</script>
<script>
    $(document).ready(function () {
        $('#trendyol_btn').click(function () {
            var trendyol_cat = $('#trendyol_cat').val();
            var my_category = $('#my_category').val();
            var fligran = $('#fligran').val();
            var spin = $('#spin').val();
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'tp_spin_save',
                    trendyol_cat: trendyol_cat,
                    my_category: my_category,
                    fligran: fligran,
                    spin: spin
                },
                success: function (data) {
                    console.log(data);
                }
            });
        });
    });
</script>