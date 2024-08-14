<?php

namespace  App\Modules\Setting\Controllers;
/*
PT ITSHOP BISNIS DIGITAL
Website: https://itshop.biz.id
Toko Online: ITSHOP Purwokerto (https://Tokopedia.com/itshoppwt, https://Shopee.co.id/itshoppwt, https://Bukalapak.com/itshoppwt)
Dibuat oleh: Hari Wicaksono, S.Kom
06-2022
*/

use App\Controllers\BaseController;
use App\Libraries\Settings;

class Setting extends BaseController
{
	protected $setting;

	public function __construct()
	{
		//memanggil Model
		$this->setting = new Settings();
	}

	public function index()
	{
		// User Agent Class
		$agent = $this->request->getUserAgent();
		if ($agent->isMobile()) {
			$view = 'setting_mobile';
		} else {
			$view = 'setting';
		}

		return view('App\Modules\Setting\Views/' . $view, [
			'title' => lang('App.settings')
		]);
	}

}
