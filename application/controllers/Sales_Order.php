<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Barang_model');
		$this->load->model('Gudang_model');
		$this->load->model('Customer_model');
		$this->load->model('Sales_Order_model');
		$this->load->model('Sales_Order_Line_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Sales Order';

		$data['sales_orders'] = $this->Sales_Order_model->getAllOrderByDesc();

		$this->load->view('templates/header', $data);
		$this->load->view('salesorder/index', $data);
		$this->load->view('templates/footer');
	}

	public function getcustomer($kode)
	{
		$customer = $this->Customer_model->getCustomerByCode($kode);
		header('Content-Type: application/json');
    	echo json_encode($customer);
	}

	public function getbarang($kode)
	{
		$barang = $this->Barang_model->getBarangByCode($kode);
		header('Content-Type: application/json');
    	echo json_encode($barang);
	}

	public function create()
	{
		$this->form_validation->set_rules('tgl_dokumen', 'Tanggal Dokumen', 'required');
		$this->form_validation->set_rules('gudang_kode', 'Gudang', 'required');
		$this->form_validation->set_rules('customer_kode', 'Pelanggan', 'required');
		$this->form_validation->set_rules('customer_nama', 'Nama Pelanggan', 'required|trim');
		$this->form_validation->set_rules('customer_alamat', 'Alamat Penagihan', 'required|trim');
		$this->form_validation->set_rules('customer_kota', 'Kota', 'required|trim');
		$this->form_validation->set_rules('customer_pos', 'Kode Pos', 'required|trim');
		$this->form_validation->set_rules('customer_telp1', 'Telp 1', 'required|trim');
		$this->form_validation->set_rules('customer_telp2', 'Telp 2', 'required|trim');
		$this->form_validation->set_rules('barang_kode[]', 'Barang', 'required');

		if($this->form_validation->run() == false){

			$data['title'] 	 	= 'Create Sales Order';
			$data['barangs'] 	= $this->Barang_model->getAll();
			$data['gudangs'] 	= $this->Gudang_model->getAll();
			$data['customers'] 	= $this->Customer_model->getAll();

			$this->load->view('templates/header', $data);
			$this->load->view('salesorder/create', $data);
			$this->load->view('templates/footer');

		}else{

			$data = [
				'tgl_dokumen' => $this->input->post('tgl_dokumen', true),
				'gudang_kode' => $this->input->post('gudang_kode', true),
				'customer_kode' => $this->input->post('customer_kode', true),
				'customer_nama' => $this->input->post('customer_nama', true),
				'customer_alamat' => $this->input->post('customer_alamat', true),
				'customer_kota' => $this->input->post('customer_kota', true),
				'customer_pos' => $this->input->post('customer_pos', true),
				'customer_telp1' => $this->input->post('customer_telp1', true),
				'customer_telp2' => $this->input->post('customer_telp2', true),
				'total_penjualan' => preg_replace('/\D/', '',$this->input->post('total_penjualan', true)),
				'total_quantity' => $this->input->post('total_quantity', true),
				'keterangan' => $this->input->post('keterangan', true),
				'created_at' => date('Y-m-d H:i:s'),
			];
			
			$soID = $this->Sales_Order_model->storeSalesOrder($data);

			if($this->input->post('barang_kode')){
				foreach($this->input->post('barang_kode') as $key => $row){
					$item = [
						'sales_order_id' => $soID,
						'barang_kode' => $this->input->post('barang_kode')[$key],
						'deskripsi' => $this->input->post('deskripsi')[$key],
						'quantity' => $this->input->post('quantity')[$key],
						'satuan' => $this->input->post('satuan')[$key],
						'harga_satuan' => preg_replace('/\D/', '', $this->input->post('harga_satuan')[$key]),
						'diskon' => preg_replace('/\D/', '', $this->input->post('diskon')[$key]),
						'sub_total' => preg_replace('/\D/', '', $this->input->post('sub_total')[$key]),
					];

					$this->Sales_Order_Line_model->storeSalesOrderLine($item);
				}
			}

			$this->session->set_flashdata('success', 'Sales order berhasil ditambahkan');
			redirect('sales_order/index');
		}
		
	}
}