<?php

namespace App\PDF;

use FPDF;

class TemplatePDF extends FPDF
{
    protected $title;
    protected $headers;
    protected $mesReferencia;
    protected $data;

    public function __construct($title, $headers, $mesReferencia, $data)
    {
        parent::__construct();
        $this->title = $title;
        $this->headers = $headers;
        $this->mesReferencia = $mesReferencia;
        $this->data = $data;
    }

    function Header()
    {

        $this->SetFillColor(0, 153, 204);
        $this->Rect(0, 0, 210, 35, 'F');

        $this->SetFillColor(255, 0, 0);
        $this->Rect(7, 7, 25, 25, 'F');
        $logoPath = public_path('assets/images/sts_icon_sem_interlace.png');
        $this->Image($logoPath, 7, 7, 20);

        $this->SetXY(45, 10);
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(100, 7, utf8_decode('Projeto STS'), 0, 1, 'L', false);

        $this->SetXY(45, 17);
        $this->SetFont('Arial', '', 8);
        $this->MultiCell(100, 5, utf8_decode("Endereço da empresa\nCNPJ: 00.000.000/0000-00"), 0, 'L', false);

        $this->SetXY(160, 10);
        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(0);
        $this->Cell(40, 6, utf8_decode('MÊS DE REFERÊNCIA'), 1, 2, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(40, 10, utf8_decode($this->mesReferencia ?? ''), 1, 0, 'C');

        $this->SetDrawColor(0);
        $this->Line(10, 40, 200, 40);

        $this->SetY(45);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(0);
        $this->Cell(0, 10, utf8_decode($this->title ?? 'TÍTULO DO RELATÓRIO'), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(0, 153, 204);
        $this->Cell(95, 10, utf8_decode('Nome da Empresa'), 0, 0, 'L', true);
        $this->Cell(95, 10, utf8_decode('Página ' . $this->PageNo() . '/{nb}'), 0, 0, 'R', true);
    }

    function renderTable($header, $data, $totalItens=null, $totalValor=null)
    {

        $numCols = count($header);
        $pageWidth = 190;
        $colWidth = $pageWidth / $numCols;

        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $col) {
            $this->Cell($colWidth, 10, utf8_decode($col), 1, 0, 'C');
        }
        $this->Ln();

        $this->SetFont('Arial', '', 9);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $x = $this->GetX();
                $y = $this->GetY();
                $this->MultiCell($colWidth, 8, utf8_decode($col), 1, 'C');
                $this->SetXY($x + $colWidth, $y);
            }
            $this->Ln(8);
        }

        if (!is_null($totalItens) && !is_null($totalValor)) {
            $this->Ln(2);
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(230, 230, 230);

            // Mesclar colunas para o texto "Totais"
            $this->Cell($colWidth * ($numCols - 4), 10, utf8_decode('Total de Produtos'), 1, 0, 'R', true);
            $this->Cell($colWidth, 10, $totalItens, 1, 0, 'C', true);

            $this->Cell($colWidth * ($numCols - 4), 10, utf8_decode('Valor Total'), 1, 0, 'R', true);

            $this->Cell($colWidth, 10, 'R$ ' . number_format($totalValor, 2, ',', '.'), 1, 0, 'C', true);
        }
    }
}
