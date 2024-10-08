<?php

namespace App\Modules\Bank\Controllers;
/*
PT ITSHOP BISNIS DIGITAL
Website: https://itshop.biz.id
Toko Online: ITSHOP Purwokerto (https://Tokopedia.com/itshoppwt, https://Shopee.co.id/itshoppwt, https://Bukalapak.com/itshoppwt)
Dibuat oleh: Hari Wicaksono, S.Kom
02-2024
*/

use App\Controllers\BaseController;
use App\Modules\Bank\Models\BankAkunModel;
use App\Modules\Bank\Models\BankModel;
use App\Modules\Toko\Models\TokoModel;
use CodeIgniter\I18n\Time;

class Bank extends BaseController
{
    protected $bank;
    protected $bankAkun;
    protected $toko;

    public function __construct()
    {
        //memanggil function di model
        $this->bank = new BankModel();
        $this->bankAkun = new BankAkunModel();
        $this->toko = new TokoModel();
    }

    public function index()
    {
        // User Agent Class
		$agent = $this->request->getUserAgent();
		if ($agent->isMobile()) {
			$view = 'bank_mobile';
		} else {
			$view = 'bank';
		}

        $idToko = get_cookie('id_toko');
        $toko = $this->toko->find($idToko);
        $bankUtama = $toko['id_bank_akun'];
        $bankAkun = $this->bankAkun->find($bankUtama);
        return view('App\Modules\Bank\Views/' . $view, [
            'title' => 'Bank',
            'idBankUtama' => $bankUtama,
            'bankAkun' => $bankAkun,
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

    
}
