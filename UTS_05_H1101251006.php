    <?php
    define("D", 6); // digit akhir NIM (1006 -> 6)

    abstract class MenuPadang {
        protected $id;
        protected $nama;
        protected $hargaAsli;

        public function __construct($id, $nama, $hargaAsli) {
            $this->id = $id;
            $this->nama = $nama;
            $this->hargaAsli = $hargaAsli;
        }

        public function getId() { return $this->id; }
        public function getNama() { return $this->nama; }
        public function getHargaAsli() { return $this->hargaAsli; }

        abstract public function hitungTotal();
        abstract public function getJenis();
    }

    class LaukUtama extends MenuPadang {
        private $porsi;

        public function __construct($id, $nama, $hargaAsli, $porsi) {
            parent::__construct($id, $nama, $hargaAsli);
            $this->porsi = $porsi;
        }

        public function hitungTotal() {
            return $this->hargaAsli * $this->porsi;
        }

        public function getJenis() { return "Lauk Utama"; }

        public function cetakDetail() {
            echo $this->nama . " - " . $this->getJenis() . " - " . $this->porsi . " porsi<br>";
        }
    }

    class Sayur extends MenuPadang {
        private $mangkuk;

        public function __construct($id, $nama, $hargaAsli, $mangkuk) {
            parent::__construct($id, $nama, $hargaAsli);
            $this->mangkuk = $mangkuk;
        }

        public function hitungTotal() {
            return $this->hargaAsli * $this->mangkuk;
        }

        public function getJenis() { return "Sayur"; }

        public function cetakDetail() {
            echo $this->nama . " - " . $this->getJenis() . " - " . $this->mangkuk . " mangkuk<br>";
        }
    }

    class Minuman extends MenuPadang {
        private $gelas;

        public function __construct($id, $nama, $hargaAsli, $gelas) {
            parent::__construct($id, $nama, $hargaAsli);
            $this->gelas = $gelas;
        }

        public function hitungTotal() {
            $total = $this->hargaAsli * $this->gelas;
            if ($this->gelas > D) {
                $total = $total - ($total * 0.05); // diskon 5%
            }
            return $total;
        }

        public function getJenis() { return "Minuman"; }

        public function cetakDetail() {
            echo $this->nama . " - " . $this->getJenis() . " - " . $this->gelas . " gelas<br>";
        }
    }
    $menu = array(
        new LaukUtama("R01", "riri", 25000, 2),
        new Sayur("R02", "dims", 8000, 2),
        new Minuman("R03", "aipi", 5000, 4),
        new LaukUtama("R04", "lilis", 20000, 1),
        new Minuman("R05", "nihao", 10000, 2)
    );

    echo "| No | ID | Nama | Jenis | Harga Asli | Total |<br>";
    $no = 1;
    $totalAll = 0;
    foreach ($menu as $m) {
        echo "| " . $no++ . " | " . $m->getId() . " | " . $m->getNama()
            . " | " . $m->getJenis() . " | " . $m->getHargaAsli()
            . " | " . $m->hitungTotal() . " |<br>";
        $totalAll += $m->hitungTotal();
    }
    echo "<br>Total keseluruhan: Rp " . $totalAll . "<br><br>";
    // Bonus
    foreach ($menu as $m) {
        $m->cetakDetail();
    }
    ?>