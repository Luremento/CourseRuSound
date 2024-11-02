<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Albom, Track};

class AdminController extends Controller
{
    public function index() {
        // Получаем текущую дату и время
        $now = now();

        // Получаем дату 30 дней назад
        $lastMonth = (clone $now)->subDays(30);

        // Получаем дату 60 дней назад
        $twoMonthsAgo = (clone $now)->subDays(60);

        // Получаем количество пользователей за последний месяц
        $usersLastMonth = User::whereBetween('created_at', [$lastMonth, $now])->count();

        // Получаем количество пользователей за предыдущий месяц
        $usersTwoMonthsAgo = User::whereBetween('created_at', [$twoMonthsAgo, $lastMonth])->count();

        // Рассчитываем процент изменения
        if ($usersTwoMonthsAgo > 0) {
            $percentageChange = (($usersLastMonth - $usersTwoMonthsAgo) / $usersTwoMonthsAgo) * 100;
        } else {
            $percentageChange = $usersLastMonth > 0 ? 100 : 0;
        }

        // Рассчитываем процент "на сколько больше"
        $percentageIncrease = $usersLastMonth - $usersTwoMonthsAgo;

        // Получаем данные для графика пользователей
        $userData = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$lastMonth, $now])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Получаем данные для графика альбомов
        $albumData = Albom::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$lastMonth, $now])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Получаем данные для графика треков
        $trackData = Track::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$lastMonth, $now])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Получаем количество альбомов за последний месяц
        $albumsLastMonth = Albom::whereBetween('created_at', [$lastMonth, $now])->count();

        // Получаем количество альбомов за предыдущий месяц
        $albumsTwoMonthsAgo = Albom::whereBetween('created_at', [$twoMonthsAgo, $lastMonth])->count();
        // Рассчитываем процент изменения для альбомов
        if ($albumsTwoMonthsAgo > 0) {
            $albumsPercentageChange = (($albumsLastMonth - $albumsTwoMonthsAgo) / $albumsTwoMonthsAgo) * 100;
        } else {
            $albumsPercentageChange = $albumsLastMonth > 0 ? 100 : 0;
        }

        // Получаем количество треков за последний месяц
        $tracksLastMonth = Track::whereBetween('created_at', [$lastMonth, $now])->count();

        // Получаем количество треков за предыдущий месяц
        $tracksTwoMonthsAgo = Track::whereBetween('created_at', [$twoMonthsAgo, $lastMonth])->count();

        // Рассчитываем процент изменения для треков
        if ($tracksTwoMonthsAgo > 0) {
            $tracksPercentageChange = (($tracksLastMonth - $tracksTwoMonthsAgo) / $tracksTwoMonthsAgo) * 100;
        } else {
            $tracksPercentageChange = $tracksLastMonth > 0 ? 100 : 0;
        }

        return view('stats', [
            'all_users' => User::get(),
            'users_lastMonth' => $usersLastMonth,
            'percentage_change' => $percentageChange,
            'percentage_increase' => $percentageIncrease,
            'userData' => $userData,
            'albums_lastMonth' => $albumsLastMonth,
            'albums_percentage_change' => $albumsPercentageChange,
            'albumData' => $albumData,
            'tracks_lastMonth' => $tracksLastMonth,
            'tracks_percentage_change' => $tracksPercentageChange,
            'trackData' => $trackData,
        ]);
    }
}
