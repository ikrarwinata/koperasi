<?php

namespace App\Controllers;

use App\Models\Ambil_simpanan_model;
use App\Models\Jenissimpan_pinjam_model;
use App\Models\Kelola_nasabah_model;
use App\Models\Saldo_nasabah_model;
use App\Models\Tambah_pinjaman_model;
use App\Models\Tambah_simpanan_model;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['html','text','form','session','default'];
	protected $alwaysDisableCache = FALSE;
    protected $PageData;
	protected $Template;
    protected $pager;
    protected $validation;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->PageData = $this->defaultPage(); // Attribute Of this Page
		$this->alwaysDisableCache = (ENVIRONMENT !== 'production'); // Always disable cache on development
		$this->baseOnLoad();
		$this->onLoad();
	}

	private function baseOnLoad()
	{
		if ($this->alwaysDisableCache){
			$this->disableCache();
		}

		$this->penghitungNotifikasi();
	}

	protected function onLoad()
	{
	}

	protected function disableCache()
	{
		$this->response->setLastModified(gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		// HTTP/1.1
		$this->response->setHeader('Cache-Control', 'no-store')
		->appendHeader('Cache-Control', 'no-cache')
		->appendHeader('Cache-Control', 'must-revalidate')
		->appendHeader('Cache-Control', 'post-check=0')
		->appendHeader('Cache-Control', 'pre-check=0');
		$this->response->setHeader('Pragma', "no-cache");
		$this->response->setHeader("Expires", "Mon, 26 Jul 1997 05:00:00 GMT");
	}

	//ATRIBUTE OF THIS PAGE
	protected function defaultPage()
	{
		return (object) [
			'parent' => 'Home',
			'header' => 'Home',
			'title' => 'Home',
			'subtitle' => [
				'Dashboard' => 'Home'
			],
			'url' => 'Home',
			'stylesheets' => [],
			'scripts' => [],
			'locale' => 'id',
			'access' => []
		];
	}

	// Localization
	protected function setLocale()
	{
		$locale = $this->request->getLocale();
		if ($locale == NULL) return NULL;
		$this->thisLocale($locale);
		session()->set('locale', $locale);
		return $locale;
	}

	protected function getLocale()
	{
		if (session()->has('locale')) {
			if (session('locale') != NULL) {
				$this->thisLocale(session('locale'));
				$this->request->setLocale(session('locale'));
			}
		} else {
			$this->setLocale();
		}
		return $this->thisLocale();
	}

	protected function thisLocale($newLocale = null)
	{
		if (isset($this->PageData->locale)) {
			if ($newLocale != NULL) $this->PageData->locale = $newLocale;
			return $this->PageData->locale;
		}
		return NULL;
	}

	protected function penghitungNotifikasi(){
		$pinjaman = new Tambah_pinjaman_model();
		$simpanan = new Tambah_simpanan_model();
		$ambil = new Ambil_simpanan_model();

		if (session("hak_akses") == "Administrator") {
			$p = $pinjaman->select("COUNT(id_pinjaman) AS total")->where("lengkap", 0)->first();
			$pj = $pinjaman->select("COUNT(id_pinjaman) AS total")->where("valid", 1)->where("sisa > 0", NULL, FALSE)->first();
			$s = $simpanan->select("COUNT(*) AS total")->where("lengkap", 0)->first();
			$a = $ambil->select("COUNT(*) AS total")->where("lengkap", 0)->first();
		} else if (session("hak_akses") == "Pimpinan") {
			$p = $pinjaman->select("COUNT(id_pinjaman) AS total")->where("valid", 0)->where("lengkap", 1)->first();
			$pj = $pinjaman->select("COUNT(id_pinjaman) AS total")->where("valid", 1)->where("sisa > 0", NULL, FALSE)->first();
			$s = $simpanan->select("COUNT(*) AS total")->where("valid", 0)->where("lengkap", 1)->first();
			$a = $ambil->select("COUNT(*) AS total")->where("valid", 0)->where("lengkap", 1)->first();
		}else {
			$d = $pinjaman->select("SUM(sisa) AS sisa")->where("id_nasabah", session("id_nasabah"))->where("valid", 1)->first();
			session()->set("pinjaman", 0);
			if (isset($d->sisa)) session()->set("pinjaman", ($d->sisa != NULL ? $d->sisa : 0));
			return TRUE;
		}

		session()->set("pengajuan_pinjaman", $p->total);
		session()->set("pinjaman_berjalan", $pj->total);
		session()->set("pengajuan_simpan", $s->total);
		session()->set("pengajuan_ambil", $a->total);
		return TRUE;
	}

	protected function hitung_saldo_nasabah($id_nasabah, $bungaPerBulan)
	{
		$saldo = new Saldo_nasabah_model();
		$saldo->columnIndex = "tanggal";
		$saldo->order = "ASC";
		$listSaldo = $saldo->getBy("id_nasabah", $id_nasabah);
		$s = 0;
		$totalS = 0;
		$summed = FALSE;
		$lastMonth = 0;
		foreach ($listSaldo as $key => $value) {
			if ($value->jenis_transaksi == "add") {
				$s += $value->nominal;
			} else {
				$s -= $value->nominal;
			}
			$sM = formatDate($value->tanggal, FALSE, "m");
			if ($lastMonth == 0) {
				$lastMonth = $sM;
			} else {
				if ($sM > $lastMonth) {
					$s -= $value->nominal;
					if ($bungaPerBulan >= 1) {
						if ($s >= 1) {
							$s += $s * ($bungaPerBulan / 100);
						} else {
							$s += ($s * -1) * ($bungaPerBulan / 100);
						}
					}
					$totalS += $s;
					$s = 0;
					$summed = TRUE;
					$lastMonth = $sM;

					if ($value->jenis_transaksi == "add") {
						$s += $value->nominal;
					} else {
						$s -= $value->nominal;
					}
					$summed = FALSE;
				} else {
					$summed = FALSE;
					$lastMonth = $sM;
				}
			}
		}
		if (!$summed) {
			if ($bungaPerBulan >= 1 && $lastMonth < date("m")) {
				if ($s >= 1) {
					$s += $s * ($bungaPerBulan / 100);
				} else {
					$s += ($s * -1) * ($bungaPerBulan / 100);
				}
			}
			$totalS += $s;
		}
		return $totalS;
	}
}
