                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Nuzulul Mas'ud &copy; PT Kreator Solusi Informasi  <?= date('Y') ?></span>
                    </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/autoNumeric.js"></script>
    <script src="<?= base_url() ?>assets/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if($this->session->flashdata('success')){ ?>
                toastr.success('<?= $this->session->flashdata("success") ?>', 'Success');
            <?php } ?>
            
            $('.select2').select2({
                theme :"bootstrap"
            });

            $("#customer_kode").change(function(){
                let customer_kode = $(this).val();

                $.ajax({
                    url: '<?= base_url() ?>sales_order/getcustomer/'+customer_kode,
                    dataType: 'json',
                    method: 'POST',
                    success: function (response) {
                        console.log(response)
                        $('#customer_nama').val(response.nama);
                        $('#customer_alamat').val(response.alamat);
                        $('#customer_kota').val(response.kota);
                        $('#customer_pos').val(response.pos);
                        $('#customer_telp1').val(response.telp1);
                        $('#customer_telp2').val(response.telp2);
                    },
                });

            });

            function quantity_count(){
                var sum = 0;
                var total = 0;

                $('.quantity').each(function(){
                    sum += +$(this).val(); 
                });

                $('.sub-total').each(function(){
                    total += +$(this).autoNumeric('get'); 
                });

                console.log(sum);
                console.log(total);
                
                $("#total_quantity").val(sum);
                $("#total_penjualan").autoNumeric('set', total);
                
            }

            var count = 1; 
            add_dynamic_input_field(count);

            function add_dynamic_input_field(count){
                var button = '';
                if(count > 1){
                    button = '<button type="button" name="form-remove" id="'+count+'" class="btn btn-danger btn-sm form-remove"><span class="fas fa-minus"></span></button>';
                }else{
                    button = '<button type="button" name="form_more" id="form_more" class="btn btn-success btn-sm"><span class="fas fa-plus"></span></button>';
                }
                output = '<tr id="form-'+count+'"><td>'+button+'</td>';
                output += `
                    <td>
                        ${count}
                    </td>
                    <td>
                        <select name="barang_kode[]" id="form-${count}-barang_kode" class="form-control select2 barang-option" required>
                            <option value="" disabled selected>Pilih ...</option>
                            <?php foreach ($barangs as $row): ?>
                                <option value="<?= $row['kode'] ?>"><?= $row['kode'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('barang_kode[]', '<small class="text-danger">', '</small>') ?>
                    </td>
                    <td>
                        <input type="text" name="deskripsi[]" id="form-${count}-deskripsi" class="form-control" placeholder="Deskripsi" required>
                    </td>
                    <td>
                        <input type="number" min="1" name="quantity[]" id="form-${count}-quantity" class="form-control quantity" value="1" placeholder="Qty" style="text-align:right;" required>
                    </td>
                    <td>
                        <input type="text" name="satuan[]" id="form-${count}-satuan" class="form-control" placeholder="Satuan" required>
                    </td>
                    <td>
                        <input type="text" name="harga_satuan[]" id="form-${count}-harga_satuan" class="form-control rupiah harga" placeholder="Harga" style="text-align:right;" value="0" required>
                    </td>
                    <td>
                        <input type="text" name="diskon[]" id="form-${count}-diskon" class="form-control rupiah diskon" placeholder="Diskon" value="0" style="text-align:right;" required>
                    </td>
                    <td>
                        <input type="text" name="sub_total[]" id="form-${count}-sub_total" class="form-control rupiah sub-total" placeholder="Sub Total" value="0" style="text-align:right;" required readonly>
                    </td>
                `;
                output += '</tr>';
                $('#dynamic_field').append(output);
                $('.rupiah').autoNumeric('init', {aSign: '', aSep: '.', aDec: ',', mDec: '0', unformatOnSubmit: true});
                quantity_count();
            }

            $(document).on('click','#form_more', function(){
                count = count + 1;
                add_dynamic_input_field(count);
            });

            $(document).on('click','.form-remove', function(){
                var row_id = $(this).attr("id");
                $('#form-'+row_id).remove();
                quantity_count();
            });

            $('.rupiah').autoNumeric('init', {aSign: '', aSep: '.', aDec: ',', mDec: '0', unformatOnSubmit: true});

            $(document).on('change','.barang-option',function(){
                var arrayId = $(this).attr('id').split('-'); 
	            var key      = arrayId[1];
                var kode     = $(this).val();
                var subTotal = 0;

                $.ajax({
                    url: '<?= base_url() ?>sales_order/getbarang/'+kode,
                    dataType: 'json',
                    method: 'POST',
                    success: function (res) {
                        console.log(res)
                        $('#form-'+key+'-deskripsi').val(res.deskripsi);
                        $('#form-'+key+'-quantity').val(1);
                        $('#form-'+key+'-satuan').val(res.satuan);
                        $('#form-'+key+'-harga_satuan').autoNumeric('set', res.harga_jual);
                        $('#form-'+key+'-diskon').autoNumeric('set', 0);
                        $('#form-'+key+'-sub_total').autoNumeric('set', res.harga_jual);
                        quantity_count();
                    },
                });
            });

            $(document).on('change','.quantity',function(){
                var arrayId = $(this).attr('id').split('-'); 
	            var key     = arrayId[1];

                var quantity  = $('#form-'+key+'-quantity').val();
                var diskon = $('#form-'+key+'-diskon').autoNumeric('get');
                var harga  = $('#form-'+key+'-harga_satuan').autoNumeric('get');

                var total = (quantity * harga) - diskon;

                $('#form-'+key+'-sub_total').autoNumeric('set', total);
                quantity_count();
            });

            $(document).on('keyup','.harga',function(){
                var arrayId = $(this).attr('id').split('-'); 
	            var key      = arrayId[1];

                var quantity  = $('#form-'+key+'-quantity').val();
                var diskon = $('#form-'+key+'-diskon').autoNumeric('get');
                var harga  = $('#form-'+key+'-harga_satuan').autoNumeric('get');

                var total = (quantity * harga) - diskon;
                $('#form-'+key+'-sub_total').autoNumeric('set', total);
                quantity_count();
            });

            $(document).on('keyup','.diskon',function(){
                var arrayId = $(this).attr('id').split('-'); 
	            var key      = arrayId[1];

                var quantity  = $('#form-'+key+'-quantity').val();
                var diskon = $('#form-'+key+'-diskon').autoNumeric('get');
                var harga  = $('#form-'+key+'-harga_satuan').autoNumeric('get');

                var total = (quantity * harga) - diskon;

                $('#form-'+key+'-sub_total').autoNumeric('set', total);
                quantity_count();
            });

        });
    </script>
</body>
</html>