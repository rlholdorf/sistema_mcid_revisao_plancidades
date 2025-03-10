<?php

namespace App\Exports\Mod_transferencias_especiais;

use App\Mod_transferencias_especiais\ViewPalavrasSecretarias;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Excel;


class PlanosAcoesExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    private $secretaria;
    private $distribuicao;

    public function __construct($secretaria, $distribuicao)
    {
        $this->secretaria = $secretaria;
        $this->distribuicao = $distribuicao;
    }


    public function collection()
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });

        $where = [];




        if ($this->distribuicao == 1) {
            $where[] = ['view_palavras_secretarias.bln_distribuido', true];
        } else {
            $where[] = ['view_palavras_secretarias.bln_distribuido', false];
        }

        if ($this->secretaria == 11) {
            $where[] = ['view_palavras_secretarias.txt_palavra_sndum', '!=', ''];
        } else if ($this->secretaria == 12) {
            $where[] = ['view_palavras_secretarias.txt_palavra_semob', '!=', ''];
        } else if ($this->secretaria == 13) {
            $where[] = ['view_palavras_secretarias.txt_palavra_snsa', '!=', ''];
        } else if ($this->secretaria == 14) {
            $where[] = ['view_palavras_secretarias.txt_palavra_snh', '!=', ''];
        } else if ($this->secretaria == 15) {
            $where[] = ['view_palavras_secretarias.txt_palavra_snp', '!=', ''];
        } else if ($this->secretaria == 99) {
            $where[] = ['view_palavras_secretarias.txt_palavra_sndum', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_semob', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_snsa', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_snh', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_snp', '=', ''];
        }


        if ($this->distribuicao == 0) {
            $planos = ViewPalavrasSecretarias::where($where)->get();
        } else {
            $planos = ViewPalavrasSecretarias::leftjoin('mcid_transferencia_especiais_novo.tab_planos_acoes', 'tab_planos_acoes.cod_plano_acao', '=', 'view_palavras_secretarias.cod_plano_acao')
                ->leftjoin('mcid_sistema_se.users', 'users.id', '=', 'tab_planos_acoes.user_id')
                ->leftjoin('mcid_sistema_se.opc_secretarias', 'opc_secretarias.id', '=', 'tab_planos_acoes.secretaria_id')
                ->select(
                    'view_palavras_secretarias.*',
                    'users.name',
                    'users.txt_cpf_usuario',
                    'opc_secretarias.txt_sigla_secretaria',
                    'bln_distribuicao_automatica'
                )
                ->where($where)->get();
        }

        $count = 0;

        foreach ($planos as $plano) {
            $planosAcoes[$count]['cod_plano_acao'] = $plano->cod_plano_acao;

            $planosAcoes[$count]['txt_palavra_sndum'] = $plano->txt_palavra_sndum;
            $planosAcoes[$count]['txt_palavra_semob'] = $plano->txt_palavra_semob;
            $planosAcoes[$count]['txt_palavra_snh'] = $plano->txt_palavra_snh;
            $planosAcoes[$count]['txt_palavra_snp'] = $plano->txt_palavra_snp;
            $planosAcoes[$count]['txt_palavra_snsa'] = $plano->txt_palavra_snsa;
            $planosAcoes[$count]['txt_palavra_generico'] = $plano->txt_palavra_generico;
            $planosAcoes[$count]['link_transferegov'] = $plano->link_transferegov;

            if ($plano->bln_distribuido == 1) {
                $planosAcoes[$count]['bln_distribuido'] = 'Sim';
            } else {
                $planosAcoes[$count]['bln_distribuido'] = 'Não';
                $planosAcoes[$count]['name'] = $plano->name;
                $planosAcoes[$count]['txt_cpf_usuario'] = $plano->txt_cpf_usuario;
                $planosAcoes[$count]['txt_sigla_secretaria'] = $plano->txt_sigla_secretaria;
            }
            if ($plano->bln_distribuicao_automatica == 1) {
                $planosAcoes[$count]['bln_distribuicao_automatica'] = 'Sim';
            } else {
                $planosAcoes[$count]['bln_distribuicao_automatica'] = 'Não';
            }





            $count++;
        }

        return collect($planosAcoes);
    }

    public function headings(): array
    {
        return [
            'Código',
            'SNDUM',
            'SEMOB',
            'SNH',
            'SNP',
            'SNSA',
            'Palavras Genéricas',
            'Transferegov',
            'Distribuído',
            'Nome',
            'CPF Responsável',
            'Secretaria Responsável',
            'Distribuição automática',

        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
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

    public function columnFormats(): array
    {
        return [

            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
            'Q' => NumberFormat::FORMAT_NUMBER_00,
            'R' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}