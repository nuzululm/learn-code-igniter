<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-default">Sales Order List</h6>
                <div class="pull-right">
                   <a href="<?= base_url() ?>sales_order/create" class="btn btn-success "><i class="fas fa-fw fa-plus"></i> Create Sales Order</a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl. Dokumen</th>
                                <th>Gudang</th>
                                <th>Kode Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($sales_orders) > 0){
                            $no = 1;
                            foreach($sales_orders as $row) : 
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['tgl_dokumen'] ?></td>
                                    <td><?= $row['gudang_kode'] ?></td>
                                    <td><?= $row['customer_kode'] ?></td>
                                    <td><?= $row['customer_nama'] ?></td>
                                    <td class="text-right"><?= $row['total_quantity'] ?></td>
                                    <td class="text-right"><?= number_format($row['total_penjualan'],0,",",".");  ?></td>
                                </tr>
                            <?php 
                            $no++;
                            endforeach;
                            }else{
                                echo '<tr><td colspan="7" class="text-center">Data sales order tidak tersedia</td></tr>';
                            } 
                            ?>
                        </tbody>              
                    </table>                 
                </div>
            </div>
        </div>
    </div>
</div>