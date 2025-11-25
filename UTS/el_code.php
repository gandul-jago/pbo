<?php

class Penghasilan {
    private $gaji;
    private $tunjangan;
    private $iuranPensiun; 

    public function __construct($gaji, $tunjangan, $iuranPensiun) {
        $this->gaji = (float)$gaji;
        $this->tunjangan = (float)$tunjangan;
        $this->iuranPensiun = (float)$iuranPensiun;
    }

    public function brutoTahunan() {
        return ($this->gaji + $this->tunjangan) * 12;
    }

    public function bebanTahunan() {
        return $this->iuranPensiun * 12;
    }

    public function netoTahunan() {
        return $this->brutoTahunan() - $this->bebanTahunan();
    }
}

class PTKP {
    const PRIBADI = 54000000;
    const KAWIN = 4500000;
    const TANGGUNGAN = 4500000;
    private $kawin;
    private $tanggungan;

    public function __construct($kawin = false, $tanggungan = 0) {
        $this->kawin = (bool)$kawin;
        $this->tanggungan = min(3, max(0, (int)$tanggungan));
    }

    public function hitung() {
        $ptkp = self::PRIBADI;
        if ($this->kawin) $ptkp += self::KAWIN;
        $ptkp += $this->tanggungan * self::TANGGUNGAN;
        return $ptkp;
    }
}

class Pajak {
    private $brackets = [
        50000000      => 0.05,
        250000000     => 0.15,
        500000000     => 0.25,
        PHP_INT_MAX   => 0.30
    ];

    public function hitungPKP($penghasilanNeto, $ptkp) {
        $pkp = $penghasilanNeto - $ptkp;
        return max(0, (float)$pkp);
    }

    public function hitungPPhPerLapisan($pkp) {
        $remaining = $pkp;
        $result = [];
        $lower = 0;
        foreach ($this->brackets as $upper => $rate) {
            if ($remaining <= 0) break;
            $cap = $upper - $lower;
            $take = min($cap, $remaining);
            $tax = $take * $rate;
            $result[] = [
                'range' => ($lower + 1) . ' - ' . $upper,
                'amount' => $take,
                'rate' => $rate,
                'tax' => $tax
            ];
            $remaining -= $take;
            $lower = $upper;
        }
        return $result;
    }

    public function totalPPh($perLapisan) {
        $sum = 0;
        foreach ($perLapisan as $l) $sum += $l['tax'];
        return $sum;
    }
}


function rp($n) {
    return 'Rp ' . number_format($n, 0, ',', '.');
}


$hasil = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['clear_form'])) {
    $nama = trim($_POST['nama'] ?? '');
    $statusKawin = (isset($_POST['status_kawin']) && $_POST['status_kawin'] === 'ya');
    $tanggungan = (int)($_POST['tanggungan'] ?? 0);

    // numeric values must come from raw hidden inputs
    $gaji = floatval($_POST['gaji_raw'] ?? 0);
    $tunjangan = floatval($_POST['tunjangan_raw'] ?? 0);
    $iuran = floatval($_POST['iuran_raw'] ?? 0);

    $peng = new Penghasilan($gaji, $tunjangan, $iuran);
    $ptkp = new PTKP($statusKawin, $tanggungan);
    $pajak = new Pajak();

    $bruto = $peng->brutoTahunan();
    $beban = $peng->bebanTahunan();
    $neto = $peng->netoTahunan();
    $nilaiPTKP = $ptkp->hitung();
    $pkp = $pajak->hitungPKP($neto, $nilaiPTKP);
    $lapisan = $pajak->hitungPPhPerLapisan($pkp);
    $totalPPh = $pajak->totalPPh($lapisan);

    $hasil = [
        'nama' => $nama,
        'bruto' => $bruto,
        'beban' => $beban,
        'neto' => $neto,
        'ptkp' => $nilaiPTKP,
        'pkp' => $pkp,
        'lapisan' => $lapisan,
        'totalPPh' => $totalPPh
    ];
}
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sistem Perhitungan Pajak Penghasilan (PPh21) - OOP</title>
    <style>
        body{ font-family: Arial, sans-serif; padding:20px; }
        .field { margin-bottom: 10px; }
        label{ display:block; margin-bottom:4px; }
        input[type=text], input[type=number]{ width:320px; padding:6px; font-size:14px; }
        .money { text-align:left; }
        table{ border-collapse: collapse; margin-top:10px; }
        table, th, td{ border:1px solid #333; padding:6px; }
        .actions { margin-top:18px; }
        .actions button { padding:8px 12px; margin-right:8px; }
    </style>
</head>
<body>
    <h2>Sistem Perhitungan Pajak Penghasilan (PPh21)</h2>

    <form id="pphForm" method="post" onsubmit="prepareSubmit()">
        <div class="field">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlentities($_POST['nama'] ?? '') ?>">
        </div>

        <div class="field">
            <label>Status Kawin:</label>
            <label><input type="radio" name="status_kawin" value="ya" <?= (($_POST['status_kawin'] ?? '') == 'ya') ? 'checked' : '' ?>> Ya</label>
            <label><input type="radio" name="status_kawin" value="tidak" <?= (($_POST['status_kawin'] ?? '') == 'tidak' || !isset($_POST['status_kawin'])) ? 'checked' : '' ?>> Tidak</label>
        </div>

        <div class="field">
            <label>Jumlah Anak Tanggungan (0-3):</label>
            <input id="tanggungan_input" type="number" min="0" max="3" name="tanggungan" value="<?= htmlentities($_POST['tanggungan'] ?? 0) ?>">
        </div>

        <div class="field">
            <label>Gaji Bulanan:</label>
            <input id="gaji_vis" class="money" type="text" value="<?= isset($_POST['gaji_raw']) ? number_format((float)$_POST['gaji_raw'],0,',','.') : '0' ?>">
        </div>

        <div class="field">
            <label>Tunjangan Bulanan:</label>
            <input id="tunjangan_vis" class="money" type="text" value="<?= isset($_POST['tunjangan_raw']) ? number_format((float)$_POST['tunjangan_raw'],0,',','.') : '0' ?>">
        </div>

        <div class="field">
            <label>Iuran Pensiun per Bulan:</label>
            <input id="iuran_vis" class="money" type="text" value="<?= isset($_POST['iuran_raw']) ? number_format((float)$_POST['iuran_raw'],0,',','.') : '0' ?>">
        </div>

        <!-- hidden numeric inputs actually submitted -->
        <input type="hidden" name="gaji_raw" id="gaji_raw" value="<?= htmlentities($_POST['gaji_raw'] ?? 0) ?>">
        <input type="hidden" name="tunjangan_raw" id="tunjangan_raw" value="<?= htmlentities($_POST['tunjangan_raw'] ?? 0) ?>">
        <input type="hidden" name="iuran_raw" id="iuran_raw" value="<?= htmlentities($_POST['iuran_raw'] ?? 0) ?>">

        <div class="actions">
            <button type="submit">Hitung Pajak</button>
            <!-- tombol hapus mengirim flag clear_form supaya server juga tidak memproses -->
            <button type="button" id="btnClear">Hapus</button>
        </div>
    </form>

<script>
function onlyDigits(str){
    return (str || '').replace(/[^\d]/g, '');
}
function formatIDR(numberStr){
    if(numberStr === '') return '0';
    let n = parseInt(numberStr, 10);
    if(isNaN(n)) return '0';
    return n.toLocaleString('id-ID');
}
function attachMoneyBehavior(visId){
    const vis = document.getElementById(visId);
    vis.addEventListener('focus', function(){
        if(this.value === '0') this.value = '';
        setTimeout(()=> this.selectionStart = this.selectionEnd = this.value.length, 0);
    });
    vis.addEventListener('input', function(e){
        const digits = onlyDigits(this.value);
        this.value = formatIDR(digits);
    });
    vis.addEventListener('blur', function(){
        const digits = onlyDigits(this.value);
        if(digits === '') this.value = '0';
        else this.value = formatIDR(digits);
    });
}
['gaji_vis','tunjangan_vis','iuran_vis'].forEach(id => attachMoneyBehavior(id));

function prepareSubmit(){
    const gajiVis = document.getElementById('gaji_vis').value;
    const tunjVis = document.getElementById('tunjangan_vis').value;
    const iuranVis = document.getElementById('iuran_vis').value;

    document.getElementById('gaji_raw').value = onlyDigits(gajiVis) || 0;
    document.getElementById('tunjangan_raw').value = onlyDigits(tunjVis) || 0;
    document.getElementById('iuran_raw').value = onlyDigits(iuranVis) || 0;

    const tang = document.getElementById('tanggungan_input');
    if (tang) {
        let v = parseInt(tang.value) || 0;
        if (v > 3) tang.value = 3;
        if (v < 0) tang.value = 0;
    }
}


document.getElementById('btnClear').addEventListener('click', function(){
    document.querySelector('input[name="nama"]').value = '';
    document.querySelector('input[name="status_kawin"][value="tidak"]').checked = true;
    document.getElementById('tanggungan_input').value = 0;
    document.getElementById('gaji_vis').value = '0';
    document.getElementById('tunjangan_vis').value = '0';
    document.getElementById('iuran_vis').value = '0';

    document.getElementById('gaji_raw').value = 0;
    document.getElementById('tunjangan_raw').value = 0;
    document.getElementById('iuran_raw').value = 0;

    window.location.href = window.location.pathname;
});
</script>

<?php if ($hasil): ?>
    <h3>Hasil Perhitungan</h3>
    <p>Nama Pegawai: <?= htmlentities($hasil['nama'] ?: ' - ') ?></p>
    <p>Penghasilan Bruto Tahunan: <?= rp($hasil['bruto']) ?></p>
    <p>Beban (iuran pensiun tahunan): <?= rp($hasil['beban']) ?></p>
    <p>Penghasilan Bersih Tahunan: <?= rp($hasil['neto']) ?></p>
    <p>PTKP: <?= rp($hasil['ptkp']) ?></p>
    <p>PKP: <?= rp($hasil['pkp']) ?></p>

    <h4>Rincian PPh per Lapisan:</h4>
    <table>
        <tr>
            <th>Lapisan</th>
            <th>Jumlah</th>
            <th>Tarif</th>
            <th>Pajak</th>
        </tr>
        <?php foreach ($hasil['lapisan'] as $lap):
            if ($lap['amount'] <= 0) continue;
        ?>
        <tr>
            <td><?= htmlentities($lap['range']) ?></td>
            <td><?= rp($lap['amount']) ?></td>
            <td><?= ($lap['rate']*100) . '%' ?></td>
            <td><?= rp($lap['tax']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total PPh Terutang: <?= rp($hasil['totalPPh']) ?></h3>
<?php endif; ?>

</body>
</html>
