<?php

namespace App\Exports\Mod_resultado_primario;

use App\Mod_resultado_primario\EmendasComissoes;
use App\Mod_resultado_primario\ViewEmendasValidadas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\NumberFormat;

class ArquivoLoteRp8Export implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $oficioEmendaId;

    public function __construct($oficioEmendaId)
    {
        $this->oficioEmendaId = $oficioEmendaId;
    }

    public function collection()
    {


        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });


        $where = [];
        $where[] = ['oficio_emenda_id', $this->oficioEmendaId];
        $where[] = ['tipo_habilitacao_cnpj_id', 2];
        return ViewEmendasValidadas::select('cod_programa', 'num_emenda', 'txt_cnpj', 'vlr_transferegov')->where($where)->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Arial',
                        'color' => array('rgb' => 'FFFFFF'),
                    ],

                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => '000000',
                        ],
                        'endColor' => [
                            'argb' => '000000',
                        ],
                    ],

                ]);
            },

        ];
    }

    public function headings(): array
    {
        return [
            'Número Programa',
            'Número Emenda Parlamentar',
            'CNPJ Beneficiário',
            'Valor Repasse',
        ];
    }
}
