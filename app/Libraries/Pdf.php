<?php
//use App\libraries\TCPDF\tcpdf;
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
         #$this->CI = &get_instance();
    }
    public function Header() {
        // Logo
        //$image_file = K_PATH_MAIN.'logo_gastos.png';
        //$image_file = base_url('/assets/img/').'logo_gastos.png';
        //$this->Image($image_file, 15, 2, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font

        $this->SetFont('helvetica', 'B', 11);
        // Title
        $this->Ln(10);//Salto de linea
        $this->Cell(0, 5, 'SISTEMA DE GESTIÓN DE TRANSPORTE Y REPARACIONES', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'I', 10);
        $this->Ln();//Salto de linea
        $this->Cell(0, 5, 'Barranquilla - Atlantico', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();//Salto de linea
        $this->Cell(0, 5, 'Tel: (+57)00232154', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();//Salto de linea
        $this->Cell(0, 5, 'E-mail: info@transporte.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number

        $user='@sjimenez';
        $fecha=date('d-m-Y H:i');
        $texto='Fecha de impresión:'.$fecha.' impreso por: '.$user;
        $this->Cell(0, 10, $texto.' Pág. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}//end class
/* application/libraries/Pdf.php */
?>
