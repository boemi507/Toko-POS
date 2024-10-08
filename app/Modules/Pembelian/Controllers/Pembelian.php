<?php

namespace  App\Modules\Pembelian\Controllers;
/*
PT ITSHOP BISNIS DIGITAL
Website: https://itshop.biz.id
Toko Online: ITSHOP Purwokerto (https://Tokopedia.com/itshoppwt, https://Shopee.co.id/itshoppwt, https://Bukalapak.com/itshoppwt)
Dibuat oleh: Hari Wicaksono, S.Kom
06-2022
*/

use App\Controllers\BaseController;
use App\Libraries\Settings;
use App\Modules\Toko\Models\TokoModel;
use CodeIgniter\I18n\Time;

class Pembelian extends BaseController
{
	protected $setting;
	protected $toko;

	public function __construct()
	{
		//memanggil Model
		$this->setting = new Settings();
		$this->toko = new TokoModel();
	}


	public function index()
	{
		// User Agent Class
		$agent = $this->request->getUserAgent();
		if ($agent->isMobile()) {
			$view = 'pembelian_mobile';
		} else {
			$view = 'pembelian';
		}

		$cari = $this->request->getVar('faktur');
		$idToko = get_cookie('id_toko');
		$toko = $this->toko->find($idToko);
		return view('App\Modules\Pembelian\Views/' . $view, [
			'title' => lang('App.purchases'),
			'cetakUSB' => $toko['printer_usb'],
			'cetakBluetooth' => $toko['printer_bluetooth'],
			'scanKeranjang' => $toko['scan_keranjang'],
			'search' => $cari,
			'startDate' => date('Y-m-d', strtotime('-3 month', strtotime(Time::now()))),
            'endDate' => date('Y-m-d', strtotime(Time::now())),
			'hariini' => date('Y-m-d', strtotime(Time::now())),
            'kemarin' => date('Y-m-d', strtotime('-1 day', strtotime(Time::now()))),
			'tujuhHari' => date('Y-m-d', strtotime('-1 week', strtotime(Time::now()))),
			'awalBulan' => date('Y-m-', strtotime(Time::now())) . '01',
            'akhirBulan' => date('Y-m-t', strtotime(Time::now())),
			'awalTahun' => date('Y-', strtotime(Time::now())) . '01-01',
            'akhirTahun' => date('Y-', strtotime(Time::now())) . '12-31',
            'awalTahunLalu' => date('Y-', strtotime('-1 year', strtotime(Time::now()))) . '01-01',
            'akhirTahunLalu' => date('Y-', strtotime('-1 year', strtotime(Time::now()))) . '12-31',
            'satuBulanAwal' => date('Y-m-d', strtotime('-1 month', strtotime(Time::now()))),
            'satuBulanAkhir' => date('Y-m-d', strtotime('-1 day', strtotime(Time::now()))),
            'tigaBulanAwal' => date('Y-m-d', strtotime('-3 month', strtotime(Time::now()))),
            'tigaBulanAkhir' => date('Y-m-d', strtotime(Time::now())),
		]);
	}

	public function add()
	{
		// User Agent Class
		$agent = $this->request->getUserAgent();
		if ($agent->isMobile()) {
			$view = 'pembelian_baru_mobile';
		} else {
			$view = 'pembelian_baru';
		}

		$idToko = get_cookie('id_toko');
		$toko = $this->toko->find($idToko);
		
		return view('App\Modules\Pembelian\Views/' . $view, [
			'title' => lang('App.addPurchase'),
			'cetakUSB' => $toko['printer_usb'],
			'cetakBluetooth' => $toko['printer_bluetooth'],
			'scanKeranjang' => $toko['scan_keranjang'],
		]);
	}

}
