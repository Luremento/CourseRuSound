<?php
namespace App\Exports;

use App\Models\View;
use App\Models\User;
use App\Models\Albom;
use App\Models\Track;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReportExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        // Получаем самые популярные плейлисты и треки
        $popularAlboms = View::select('albom_id', \DB::raw('count(*) as total_views'))
            ->whereNotNull('albom_id')
            ->groupBy('albom_id')
            ->orderBy('total_views', 'desc')
            ->limit(10)
            ->get();

        $popularTracks = View::select('track_id', \DB::raw('count(*) as total_views'))
            ->whereNotNull('track_id')
            ->groupBy('track_id')
            ->orderBy('total_views', 'desc')
            ->limit(10)
            ->get();

        $data = [];

        // Добавляем данные о плейлистах
        foreach ($popularAlboms as $albom) {
            $albomData = Albom::find($albom->albom_id);
            $data[] = [
                'Тип' => 'Плейлист',
                'Название' => $albomData->name,
                'Кол-во просмотров' => $albom->total_views,
                'Имя автора' => $albomData->user->name,
            ];
        }

        // Добавляем данные о треках
        foreach ($popularTracks as $track) {
            $trackData = Track::find($track->track_id);
            $data[] = [
                'Тип' => 'Трек',
                'Название' => $trackData->name,
                'Кол-во просмотров' => $track->total_views,
                'Имя автора' => $trackData->user->name,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Тип',
            'Название',
            'Кол-во просмотров',
            'Имя автора',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Стили для заголовков
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
            ],
        ]);

        // Стили для всего документа
        $sheet->getStyle('A1:D' . ($sheet->getHighestRow()))->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, // Тип
            'B' => 30, // Название
            'C' => 20, // Кол-во просмотров
            'D' => 20, // Имя автора
        ];
    }
}
