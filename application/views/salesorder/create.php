<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-default">Create Sales Order</h6>
            </div>
            <!-- Card Body -->
            <form action="<?= base_url() ?>sales_order/create" method="POST">
            <div class="card-body">
               
                <div class="row">
                    <div class="col-md-5">

                        <div class="form-group row">
                            <label for="tgl_dokumen" class="col-md-3 col-form-label text-right">Tgl. Dok</label>
                            <div class="col-md-9">
                                <input type="date" name="tgl_dokumen" id="tgl_dokumen" class="form-control" value="<?= set_value('tgl_dokumen') ?>">
                                <?= form_error('tgl_dokumen', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gudang_kode" class="col-md-3 col-form-label text-right">Gudang</label>
                            <div class="col-md-9">
                                <select name="gudang_kode" id="gudang_kode" class="form-control">
                                    <option value="" disabled selected>Pilih ...</option>
                                    <?php foreach ($gudangs as $row) : ?>
                                        <option value="<?= $row['kode'] ?>" <?php if(set_value('tgl_dokumen') == $row['kode']): echo 'selected'; endif ?>>
                                            <?= $row['nama'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('gudang_kode', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">

                        <div class="form-group row">
                            <label for="customer_kode" class="col-md-2 col-form-label text-right">Pelanggan</label>
                            <div class="col-md-5">
                                <select name="customer_kode" id="customer_kode" class="form-control">
                                    <option value="" disabled selected>Pilih ...</option>
                                    <?php foreach ($customers as $row) : ?>
                                        <option value="<?= $row['kode'] ?>"><?= $row['kode'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('customer_kode', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="customer_nama" id="customer_nama" class="form-control" placeholder="Nama Pelanggan">
                                <?= form_error('customer_nama', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_alamat" class="col-md-2 col-form-label text-right">Alamat</label>
                            <div class="col-md-10">
                                <textarea name="customer_alamat" id="customer_alamat" rows="3" placeholder="Alamat Tagihan" class="form-control"></textarea>
                                <?= form_error('customer_alamat', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_kota" class="col-md-2 col-form-label text-right">Kota</label>
                            <div class="col-md-4">
                                <input type="text" name="customer_kota" id="customer_kota" placeholder="Kota" class="form-control">
                                <?= form_error('customer_kota', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <label for="customer_pos" class="col-md-2 col-form-label text-right">Kode Pos</label>
                            <div class="col-md-4">
                                <input type="text" name="customer_pos" id="customer_pos" placeholder="Kode Pos" class="form-control">
                                <?= form_error('customer_pos', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_telp1" class="col-md-2 col-form-label text-right">Telp. 1</label>
                            <div class="col-md-4">
                                <input type="text" name="customer_telp1" id="customer_telp1" placeholder="Telp 1" class="form-control">
                                <?= form_error('customer_telp1', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <label for="customer_telp2" class="col-md-2 col-form-label text-right">Telp. 2</label>
                            <div class="col-md-4">
                                <input type="text" name="customer_telp2" id="customer_telp2" placeholder="Telp 2" class="form-control">
                                <?= form_error('customer_telp2', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                            
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="2%">No</th>
                                    <th>Barang</th>
                                    <th>Deskripsi</th>
                                    <th class="text-right" width="7%">Qty</th>
                                    <th width="10%">Satuan</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Diskon</th>
                                    <th class="text-right">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="dynamic_field">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">
                                        <label for="total_quantity">Total Qty</label>
                                    </th>
                                    <td>
                                        <input type="text" name="total_quantity" id="total_quantity" value="0" class="form-control" style="text-align:right;" readonly>
                                    </td>
                                    <th colspan="3" class="text-right">
                                        <label for="total_penjualan">Total</label>
                                    </th>
                                    <td>
                                        <input type="text" name="total_penjualan" id="total_penjualan" value="0" class="form-control rupiah" style="text-align:right;" readonly>
                                    </td>
                                </tr>
                            </tfoot>            
                        </table>                 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" placeholder="Keterangan" class="form-control" rows="3" cols="50"></textarea>
                    </div>
                </div>   
                
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="<?= base_url() ?>sales_order/" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>